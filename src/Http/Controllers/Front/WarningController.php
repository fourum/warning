<?php

namespace Fourum\Warning\Http\Controllers\Front;

use Fourum\Http\Controllers\FrontController;
use Fourum\Notification\NotificationRepositoryInterface;
use Fourum\Post\PostRepositoryInterface;
use Fourum\Rule\RuleRepositoryInterface;
use Fourum\User\UserRepositoryInterface;
use Fourum\Warning\Model\Warning;
use Fourum\Warning\Notification\WarningNotification;
use Fourum\Warning\Requests\CreateWarningRequest;

class WarningController extends FrontController
{
    public function create(CreateWarningRequest $request, UserRepositoryInterface $users, PostRepositoryInterface $posts, RuleRepositoryInterface $rules, $userId, $postId)
    {
        $user = $users->get($userId);
        $post = $posts->get($postId);
        $rules = $rules->getAll();
        $data['rules'] = [];

        foreach ($rules as $rule) {
            $data['rules'][$rule->getId()] = $rule->getRule();
        }

        $data['user'] = $user;
        $data['post'] = $post;

        return $this->render('warning::new', $data);
    }

    public function postCreate(CreateWarningRequest $request, UserRepositoryInterface $users, PostRepositoryInterface $posts, NotificationRepositoryInterface $notifications)
    {
        $userId = $request->get('userId');
        $postId = $request->get('postId');
        $ruleId = $request->get('ruleId');
        $points = $request->get('points');

        $user = $users->get($userId);
        $post = $posts->get($postId);

        Warning::create(array(
            'user_id' => $userId,
            'from_user_id' => $this->getUser()->getId(),
            'rule_id' => $ruleId,
            'post_id' => $postId,
            'points' => $points
        ));

        $notification = new WarningNotification($post, $user);
        $notifications->createAndSave($notification);

        return redirect($post->getUrl());
    }
}
