<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    public function index()
    {
        $lesson=Lesson::all();
        $grades=Grade::all();
        return view('backEnd.lesson.index')->with(compact('lesson', 'grades'));
    }

    public function create()
    {
        $grades=Grade::all();
        return view('backEnd.lesson.create')->with(compact('grades'));
    }

    public function store(Request $request)
    {
        $lesson=new Lesson();
        $description=strip_tags($request->description);
        $file=$request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path="upload/lesson/".$image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)).$image;
            }

            $file->move("upload/lesson/",$image);
            $lesson->image =$image;
        }
        $lesson->title=$request->title;
        $lesson->grade_id=$request->grade_id;
        $lesson->description=$description;
        $lesson->save();
        return redirect()->route('lesson.index');
    }


    public function show(Lesson $lesson)
    {
        //
    }

    public function edit(Lesson $lesson)
    {
        $lessons=Lesson::all();
        $grades=Grade::all();
        return view('backEnd.lesson.edit')->with(compact('lessons', 'grades', 'lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $description=strip_tags($request->description);
        $file=$request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path="upload/lesson/".$image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)).$image;
            }

            $file->move("upload/lesson/",$image);
            if ($lesson->image)
                unlink("upload/lesson/".$lesson->image);
            $lesson->image =$image;
        }
        $lesson->title=$request->title;
        $lesson->grade_id=$request->grade_id;
        $lesson->description=$description;
        $lesson->save();
        return redirect()->route('lesson.index');
    }

    public function destroy($lesson)
    {
        $data=Lesson::findOrFail($lesson);
        $imageOld=$data->image;
        if($imageOld){
        $pathOld="upload/lesson/".$imageOld ;
        if (file_exists($pathOld))
            unlink($pathOld);

        }
        Lesson::destroy($data->id);
        return redirect()->route('lesson.index');
    }
}
