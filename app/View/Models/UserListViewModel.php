<?php

namespace App\View\Models;

use App\Models\Role;
use Spatie\ViewModels\ViewModel;
use App\Queries\User\GetUserList;

class UserListViewModel extends ViewModel
{
    public function users(GetUserList $userList)
    {
        return $userList->handle();
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
