<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\View\Models\UserListViewModel;
use App\View\Models\UserViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Response;

class UserController
{
    public function index(): Response
    {
        return inertia('Users/Index', new UserListViewModel());
    }

    public function create(): Response
    {
        return inertia('Users/Create');
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        User::create($request->validated());

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
        $data = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($data);

        return to_route('users.index')
            ->with('success', __('messages.users.edit.success'));
    }

    public function destroy(User $user)
    {
        if (auth()->user()->is($user)) {
            return back()->with('error', __('messages.users.delete.error'));
        }

        $user->delete();

        return back()
            ->with('success', __('messages.users.delete.success'));
    }
}
