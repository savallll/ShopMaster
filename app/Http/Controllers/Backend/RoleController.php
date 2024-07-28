<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Cache;

class RoleController extends Controller
{
    public function index()
    {
        // Thử lấy dữ liệu từ cache trước
        $roles = Cache::remember('roles', now()->addMinutes(10), function () {
            return Role::all();
        });
        
        return view('Backend.role.index', compact('roles'));
    }

    public function create()
    {
        // Thử lấy dữ liệu từ cache trước
        $permissions = Cache::remember('permissions', now()->addMinutes(10), function () {
            return Permission::all()->groupBy('group');
        });

        return view('Backend.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Xóa cache khi có thay đổi
        Cache::forget('roles');
        
        $request->validate([
            'name' => 'required',
            'permission_ids' => 'required|array'
        ]);

        $dataCreate = $request->all();
        $dataCreate['guard_name'] = 'web';
        $role = Role::create($dataCreate);
        $role->permissions()->sync($dataCreate['permission_ids'] ?? []);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        // Thử lấy dữ liệu từ cache trước
        $role = Cache::remember('role_'.$id, now()->addMinutes(10), function () use ($id) {
            return Role::findOrFail($id);
        });
        
        // Thử lấy dữ liệu từ cache trước
        $permissions = Cache::remember('permissions', now()->addMinutes(10), function () {
            return Permission::all()->groupBy('group');
        });

        return view('Backend.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        // Xóa cache khi có thay đổi
        Cache::forget('roles');
        Cache::forget('role_'.$id);
        
        $request->validate([
            'name' => 'required',
            'permission_ids' => 'required|array'
        ]);

        $role = Role::findOrFail($id);
        $dataUpdate = $request->all();
        $dataUpdate['guard_name'] = 'web';
        $role->update($dataUpdate);
        $role->permissions()->sync($dataUpdate['permission_ids'] ?? []);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role updated successfully.');    
    }

    // Xóa vai trò
    public function delete($id)
    {
        // Xóa cache khi có thay đổi
        Cache::forget('roles');
        Cache::forget('role_'.$id);
        
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('admin.role.index')
            ->with('success', 'Role deleted successfully.');
    }
}

