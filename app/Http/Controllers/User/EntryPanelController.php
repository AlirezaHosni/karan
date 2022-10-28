<?php

namespace App\Http\Controllers\User;

use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateInformationRequest;
use App\User;
use Illuminate\Http\Request;

class EntryPanelController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $grades = Grade::all();

        return view('user.dashboard.entryPanel.index', compact('user', 'grades'));
    }

    public function update(UpdateInformationRequest $request, User $user)
    {
        $inputs = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $file->getClientOriginalName();
            $path="upload/user/" . $image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)).$image;
            }

            $file->move("upload/user/", $image);
            $inputs['image'] = $path;
        }

        $user->update($inputs);
        $user->userMeta->update($inputs);

        return redirect()->route('user.dashboard.entryPanel.index', $user)->with('success', 'ویرایش اطلاعات با موفقیت انجام پذیرفت.');
    }
}
