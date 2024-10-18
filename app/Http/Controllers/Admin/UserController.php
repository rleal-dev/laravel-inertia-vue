<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserStoreRequest;
use App\Models\Role;
use App\Models\User;
use App\View\Models\UserListViewModel;
use App\View\Models\UserViewModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Response;

class UserController
{
    use AuthorizesRequests;

    public function index(): Response
    {
        $this->authorize('users_index');

        return inertia('Users/Index', new UserListViewModel());
    }

    public function create(): Response
    {
        $this->authorize('users_create');

        return inertia('Users/Create', [
            'roles' => Role::all(),
        ]);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->authorize('users_create');

        $user = User::create($request->only(['name', 'email', 'password', 'status']));
        $user->roles()->sync($request->roles);

        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->store('avatars', 'public');

            $user->avatar = $imagePath;
            $user->save();
        }

        return to_route('users.index')
            ->with('success', __('messages.users.create.success'));
    }

    public function show(User $user): Response
    {
        $this->authorize('users_show');

        return inertia('Users/Show', new UserViewModel($user));
    }

    public function edit(User $user): Response
    {
        $this->authorize('users_edit');

        return inertia('Users/Edit', new UserViewModel($user));
    }

    public function update(Request $request, User $user)
    {
        sleep(5);
        $this->authorize('users_edit');

        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'roles' => ['required', 'array'],
            'avatar' => ['nullable'],
            'status' => ['required'],
        ]);

        $user->update($request->only(['name', 'email', 'status']));
        $user->roles()->sync($request->roles);

        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->store('avatars', 'public');

            $user->avatar = $imagePath;
            $user->save();
        }

        return to_route('users.index')
            ->with('success', __('messages.users.edit.success'));
    }

    public function destroy(User $user)
    {
        $this->authorize('users_destroy');

        if (auth()->user()->is($user)) {
            return back()->with('error', __('messages.users.delete.error'));
        }

        $user->delete();
        $user->roles()->detach();

        return back()
            ->with('success', __('messages.users.delete.success'));
    }
}
