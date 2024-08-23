<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleStoreRequest;
use App\Models\Role;
use App\View\Models\RoleListViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class RoleController
{
    public function index(): Response
    {
        return inertia('Roles/Index', new RoleListViewModel());
    }

    public function store(RoleStoreRequest $request): RedirectResponse
    {
        Role::create($request->validated());

        return to_route('roles.index')
            ->with('success', __('messages.roles.create.success'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $role->update($data);

        return to_route('roles.index')
            ->with('success', __('messages.roles.edit.success'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        $role->users()->detach();

        return back()->with('success', __('messages.roles.delete.success'));
    }
}
