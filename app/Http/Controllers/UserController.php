<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Requests\User\UpdateInformationRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('backEnd.usermanagement.index')->with(compact('users'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {



    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $grades = Grade::all();

        return view('backEnd.usermanagement.edit', compact('user', 'grades'));

    }

    public function update(UpdateInformationRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $inputs = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $file->getClientOriginalName();
            $path="upload/user/" . $image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)) . $image;
            }

            $file->move("upload/user/", $image);
            $inputs['image'] = $path;
        }

        if ($request->password)
            $inputs['password'] = bcrypt($request->password);

        $user->update($inputs);
        $user->userMeta->update($inputs);

        return redirect()->route('userManagement.edit', $user->id)->with('success', 'ویرایش اطلاعات با موفقیت انجام پذیرفت.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $image = $user->image;
        if (!empty($image) and file_exists($image)){
            unlink($image);
        }
        User::destroy($user->id);

        return redirect()->back();
    }

    public function UploadImage(Request $request,$id){
       $user=User::findOrFail($id);
        $file=$request->file('image');
        if (empty($file)){
            $image=$user->image;
            $user->image=$image;
        }else{
            $oldImage=$user->image;
            if (!empty($oldImage)){
                $oldPath="upload/user/".$oldImage;
                unlink($oldPath);
            }
            $image=$file->getClientOriginalName();
            $path="upload/user/".$image;
            if (file_exists($path)){
                $image=bin2hex(random_bytes(5)).$image;
            }
            $file->move("upload/user/",$image);
            $user->image=$image;
        }
        $user->save();
        return redirect()->back();
    }
}
