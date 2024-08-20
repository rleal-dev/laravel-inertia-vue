<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\View\Models\UserViewModel;
use Illuminate\Http\RedirectResponse;
use App\View\Models\UserListViewModel;
use App\Http\Requests\UserStoreRequest;

class UserController
{
    public function index(): Response
    {
        return inertia('Users/Index', new UserListViewModel());
    }

    public function create(): Response
    {
        return inertia('Users/Create', [
            'roles' => Role::all(),
        ]);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = User::create($request->only(['name', 'email', 'password']));
        $user->roles()->sync($request->roles);

        return to_route('users.index')
            ->with('success', __('messages.users.create.success'));
    }

    public function show(User $user): Response
    {
        return inertia('Users/Show', new UserViewModel($user));
    }

    public function edit(User $user): Response
    {
        return inertia('Users/Edit', new UserViewModel($user));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'roles' => ['required', 'array'],
        ]);

        $user->update($request->only(['name', 'email']));
        $user->roles()->sync($request->roles);

        return to_route('users.index')
            ->with('success', __('messages.users.edit.success'));
    }

    public function destroy(User $user)
    {
        if (auth()->user()->is($user)) {
            return back()->with('error', __('messages.users.delete.error'));
        }

        $user->delete();
        $user->roles()->detach();

        return back()
            ->with('success', __('messages.users.delete.success'));
    }
}
