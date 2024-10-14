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
}
