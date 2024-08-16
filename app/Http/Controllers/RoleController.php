<?php

namespace App\Http\Controllers;

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

        return to_route('roles.index')->with('success', 'Role created.');
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $role->update($data);

        return to_route('roles.index')->with('success', 'Role updated.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->back()->with('success', 'Role deleted.');
    }
}
