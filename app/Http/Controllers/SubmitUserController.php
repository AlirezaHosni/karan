<?php

namespace App\Http\Controllers;

use App\User;
use App\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SubmitUserController extends Controller
{
    public function store(Request $request)
    {

        $user=new User();
        $user->name = $request->name;
        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->phoneNumber = $request->phoneNumber;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->userMeta()->create([
            'user_id' => $user->id,
            'identifying_code' => $user->name . rand(1000, 10000)
        ]);

        $role = Role::findByName('دانش‌ آموز');
        $user->assignRole($role->id);

        return redirect()->route('login');
    }
}
