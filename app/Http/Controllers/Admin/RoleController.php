<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleStoreRequest;
use App\Models\Role;
use App\View\Models\RoleListViewModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class RoleController
{
    use AuthorizesRequests;

    public function index(): Response
    {
        $this->authorize('roles_index');

        return inertia('Roles/Index', new RoleListViewModel());
    }

    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $this->authorize('roles_create');

        Role::create($request->validated());

        return to_route('roles.index')
            ->with('success', __('messages.roles.create.success'));
    }

    public function update(Request $request, Role $role)
    {
        $this->authorize('roles_edit');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $role->update($data);

        return to_route('roles.index')
            ->with('success', __('messages.roles.edit.success'));
    }

    public function destroy(Role $role)
    {
        $this->authorize('roles_destroy');

        $role->delete();
        $role->users()->detach();

        return back()->with('success', __('messages.roles.delete.success'));
    }
}
