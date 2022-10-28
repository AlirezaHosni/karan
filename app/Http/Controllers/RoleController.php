<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $roles=Role::all();
        return view('backEnd.role.index')->with(compact('roles'));
    }

    public function create()
    {
        return view('backEnd.role.create');
    }

    public function store(Request $request)
    {
        $role=new Role();
        $role->name=$request->name;
        $role->guard_name=$request->guard_name;
        $role->save();
        session()->flash('success','نقش مورد نظر شما با موفقیت ثبت شد');
        return redirect()->route('role.create');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role=Role::findOrFail($id);
        return view('backEnd.role.edit')->with(compact('role'));
    }


    public function update(Request $request, $id)
    {
        $role=Role::findOrFail($id);
        $role->name=$request->name;
        $role->guard_name=$request->guard_name;
        $role->save();
        session()->flash('update','نقش مورد نظر شما با موفقیت اصلاح شد');
        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
       $role=Role::findOrFail($id);
       Role::destroy($role->id);
       session()->flash('delete','نقش مورد نظر شما با موفقیت حذف شد');
       return redirect()->back();
    }
}
