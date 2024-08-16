<?php

namespace App\View\Models;

use App\Queries\Role\GetRoleList;
use Spatie\ViewModels\ViewModel;

class RoleListViewModel extends ViewModel
{
    public function roles(GetRoleList $roleList)
    {
        return $roleList->handle();
    }

    public function filters()
    {
        return request()->only(['search']);
    }

    public function permissions()
    {
        return [
            'edit' => true,
        ];
    }
}
