<?php

namespace Fourum\Warning\Requests;

use Fourum\Http\Requests\Request;
use Fourum\Permission\Checker\CheckerInterface;
use Fourum\Permission\Eloquent\GroupPermissionRepository;
use Illuminate\Contracts\Auth\Guard;

class CreateWarningRequest extends Request
{
    /**
     * @param CheckerInterface $permission
     * @param Guard $auth
     * @return bool
     */
    public function authorize(CheckerInterface $permission, Guard $auth)
    {
        return $permission->check(GroupPermissionRepository::CAN_MODERATE, $auth->user());
    }
}