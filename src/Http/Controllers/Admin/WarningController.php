<?php

namespace Fourum\Warning\Http\Controllers\Admin;

use Fourum\Http\Controllers\AdminController;
use Fourum\Warning\Model\Warning;

class WarningController extends AdminController
{
    public function index()
    {
        $warnings = Warning::all()->all();

        $data['warnings'] = $warnings;

        return view('warning::admin.index', $data);
    }
}
