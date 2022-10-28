<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index()
    {
        $permission=Permission::all();
        return view('backEnd.permission.index')->with(compact('permission'));
    }

    public function create()
    {
        $roles=Role::all();
        return view('backEnd.permission.create')->with(compact('roles'));
    }

    public function store(Request $request)
    {
        $permission=new Permission();
        $permission->name=$request->name;
        $permission->guard_name=$request->guard_name;
        $permission->save();
        $role= Role::find($request->roles);
        $permission->syncRoles($role);
        session()->flash('success','وظیفه مورد نظر شما با موفقیت ثبت شد');
        return redirect()->route('permission.create');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $roles=Role::all();
        $permission=Permission::findOrFail($id);
        return view('backEnd.permission.edit')->with(compact('permission','roles'));
    }

    public function update(Request $request, $id)
    {
        $permission=Permission::findOrFail($id);
        $permission->name=$request->name;
        $permission->guard_name=$request->guard_name;
        $permission->save();
        $role= Role::find($request->roles);
        $permission->syncRoles($role);
        session()->flash('update','وظیفه مورد نظر شما با موفقیت اصلاح شد');
        return redirect()->route('permission.index');
    }

    public function destroy($id)
    {
        $permission=Permission::findOrFail($id);
        Permission::destroy($permission->id);
        session()->flash('delete','وظیفه مورد نظر شما با موفقیت حذف شد');
        return redirect()->back();

    }
}
