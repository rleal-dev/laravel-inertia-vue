<?php

namespace App\View\Models;

use App\Queries\User\GetUserList;
use Spatie\ViewModels\ViewModel;

class UserListViewModel extends ViewModel
{
    public function users()
    {
        return (new GetUserList())->handle();
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
