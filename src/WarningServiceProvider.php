<?php

namespace Fourum\Warning;

use Fourum\Menu\Item\LinkItem;
use Fourum\Menu\Item\TabItem;
use Fourum\Permission\Eloquent\GroupPermissionRepository;
use Fourum\Support\ServiceProvider;
use Fourum\Warning\Model\Warning;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class WarningServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->checkPackageEnabled()) {
            return;
        }

        $this->loadViewsFrom(__DIR__.'/../views', 'warning');

        if (! Schema::hasTable('warnings')) {
            Schema::create('warnings', function($table) {
                $table->engine = "InnoDb";

                $table->increments('id')->unsigned();
                $table->integer('user_id')->unsigned()->index();
                $table->integer('from_user_id')->unsigned()->index();
                $table->integer('rule_id')->unsigned();
                $table->integer('post_id')->unsigned();
                $table->integer('points')->unsigned();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        $this->setupRepository('warning', 'warning_id', 'Fourum\Warning\Model\Warning');
        $this->setupNotifications('Fourum\Warning\Notification\WarningNotification');

        $this->registerEvents();
        $this->registerRoutes();
        $this->registerSettings();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * The human readable name of the package.
     *
     * @return string
     */
    public function getPackageName()
    {
        return 'Fourum - Warnings';
    }

    /**
     * @return bool
     */
    public function isPackage()
    {
        return true;
    }

    /**
     * The human readable description of the package.
     *
     * @return string
     */
    public function getPackageDescription()
    {
        return 'A warning system for Fourum.';
    }

    protected function registerSettings()
    {
        $fileRepo = $this->app->make('Fourum\Setting\Filesystem\SettingRepository');
        $fileRepo->addPath(__DIR__ . "/../config/settings");
    }

    protected function registerEvents()
    {
        Event::listen('post.menu.created', function($menu, $user, $post) {
            $permission = $this->app->make('Fourum\Permission\Checker\CheckerInterface');

            if ($permission->checkHard(GroupPermissionRepository::CAN_MODERATE, $user)) {
                $menu->addItem(
                    new LinkItem("warn", "/warn/{$post->getAuthor()->getId()}/{$post->getId()}")
                );
            }
        });

        Event::listen('admin.menu.top.created', function($menu) {
            $menu->addItem(
                new LinkItem("warnings", "/admin/warnings")
            );
        });

        Event::listen('admin.user.manage.menu', function($menu, $user) {
            $item = new TabItem("warnings", "#warnings", "warning::admin.user.report", [
                'warnings' => Warning::where('user_id', $user->getId())->get(),
                'points' => Warning::where('user_id', $user->getId())->sum('points')
            ]);
            $menu->addItem($item);
        });

        Event::listen('admin.settings.sidebar.created', function($menu) {
            $menu->addItem(
                new LinkItem('warnings', '/admin/settings/warnings')
            );
        });
    }

    protected function registerRoutes()
    {
        Route::get('/warn/{userId}/{postId}', 'Fourum\Warning\Http\Controllers\Front\WarningController@create');
        Route::post('/warning/create', 'Fourum\Warning\Http\Controllers\Front\WarningController@postCreate');

        Route::get('/admin/warnings', 'Fourum\Warning\Http\Controllers\Admin\WarningController@index');
        Route::get('/admin/settings/warnings', 'Fourum\Warning\Http\Controllers\Admin\WarningController@settings');
    }
}