<?php

namespace App\Http\Controllers\SuperAdmin\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Display a listing of the roles
    public function index()
    {
        $roles = Role::all();

        // Group permissions by model name (like 'bookings', 'payments')
        $groupedPermissions = Permission::all()->groupBy('model');

        return view('superadmin.role.role_management', compact('roles', 'groupedPermissions'));
    }
    public function create()
    {
        $permissions = Permission::all();

        // Group permissions by page (or 'model' if you're using that)
        $groupedPermissions = $permissions->groupBy(function ($permission) {
            // Use page or model field (whatever you're storing module name in)
            return explode('_', $permission->name)[1]; // Example: view_rooms → rooms
        });

        return view('superadmin.role.add_role_management', compact('groupedPermissions'));
    }

    // Store a new role with assigned permissions
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name|max:255',
            'description' => 'nullable|string|max:1000',
            'permissions' => 'array|nullable',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        // Attach selected permissions to the role
        if (!empty($validatedData['permissions'])) {
            $role->permissions()->sync($validatedData['permissions']);
        }

        // Create default user (optional)
        User::create([
            'name' => $role->name . ' User',
            'email' => strtolower($role->name) . '@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'staff_role_id' => $role->id,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('roles.index')->with('success', 'Role and default user created with permissions!');
    }
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        // Get all permissions and group by model/page
        $permissions = Permission::all();
        $groupedPermissions = $permissions->groupBy('page');

        return view('superadmin.role.edit_role_management', compact('role', 'groupedPermissions'));
    }
    // Update existing role
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:roles,name,' . $id,
            'description' => 'nullable|string|max:1000',
            'permissions' => 'array|nullable',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        // Update permissions
        $role->permissions()->sync($validatedData['permissions'] ?? []);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }

    // Delete role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->detach();
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
