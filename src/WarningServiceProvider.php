<?php

namespace Fourum\Warning;

use Fourum\Support\ServiceProvider;

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
        return 'fourum/warning';
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
}