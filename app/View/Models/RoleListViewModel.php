<?php

namespace App\View\Models;

use App\Queries\Role\GetRoleList;
use Spatie\ViewModels\ViewModel;

class RoleListViewModel extends ViewModel
{
    public function roles()
    {
        return (new GetRoleList())->handle();
    }

    public function filters()
    {
        return request()->only(['search']);
    }

    public function permissions()
    {
        return [
            'create' => request()->user()->can('roles.create'),
            'edit' => request()->user()->can('roles.edit'),
            'destroy' => request()->user()->can('roles.edit'),
        ];
    }
}
