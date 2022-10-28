<?php

namespace App\Http\Controllers;

use App\book;
use App\Grade;
use App\News;
use App\Teacher;
use App\TeacherSession;
use App\User;
use App\GradeDescription;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    public function index()
    {
        $grades = Grade::all();

        return view('backEnd.grade.index')->with(compact('grades'));
    }


    public function indexDescription()
    {
        $gradeDescriptions = GradeDescription::all();

        return view('backEnd.grade.index-description', compact('gradeDescriptions'));
    }

    public function createDescription()
    {
        $gradeDescriptionGradeIds = GradeDescription::all()->pluck('grade_id')->toArray();
        $grades = Grade::whereNotIn('id', $gradeDescriptionGradeIds)->get();

        return view('backEnd.grade.create-description', compact('grades'));
    }

    public function storeDescription(Request $request)
    {
        $inputs = $request->all();

        $file = $request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path="upload/grade/".$image;

            if (file_exists($path))
                $image=bin2hex(random_bytes(4)) . $image;

            $file->move("upload/grade/", $image);
            $inputs['image'] = "upload/grade/" . $image;
        };

        GradeDescription::create($inputs);

        return redirect()->route('grade.index');
    }

    public function editDescription(GradeDescription $gradeDescription)
    {
        return view('backEnd.grade.edit-description', compact( 'gradeDescription'));
    }

    public function updateDescription(GradeDescription $gradeDescription, Request $request)
    {
        $inputs = $request->all();

        $file=$request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path="upload/grade/".$image;

            if (file_exists($path))
                $image=bin2hex(random_bytes(4)) . $image;

            if (file_exists($gradeDescription->image))
                unlink($gradeDescription->image);

            $file->move("upload/grade/", $image);
            $inputs['image'] = "upload/grade/" . $image;
        }

        $gradeDescription->update($inputs);

        return redirect()->route('grade.index');
    }

    public function destroyDescription(GradeDescription $gradeDescription)
    {
        $gradeDescription->delete();

        return redirect()->back();
    }

    public function karanBala(Grade $grade)
    {
        $sessionIds = book::whereHas('lesson', function ($query) use ($grade){
            return $query->where('grade_id', $grade->id);
        })->where('part', null)->get()->pluck('id')->toArray();
        $teacherIds = TeacherSession::whereIn('session_id', $sessionIds)->pluck('teacher_id')->toArray();
        $teachers = Teacher::whereIn('id', $teacherIds)->with('user')->latest()->limit(3)->get();

        $news = News::latest()->limit(5)->get();

        return view('frontEnd.grade.karanbala', compact('grade', 'teachers', 'news'));
    }


    public function create()
    {
        $grades = Grade::all();

        return view('backEnd.grade.create', compact('grades'));
    }

    public function store(Request $request)
    {
        $grade=new Grade();
        $grade->title=$request->title;
        $grade->last_year_id=$request->last_year_id;
        $grade->save();

        return redirect()->route('grade.index');
    }


    public function show(Grade $grade)
    {
        //
    }

    public function edit($grade)
    {
       $grades = Grade::all()->except($grade);
       $grade = Grade::findOrFail($grade);

       return view('backEnd.grade.edit')->with(compact('grade', 'grades'));
    }

    public function update(Request $request,$grade)
    {
        $grade = Grade::findOrFail($grade);
        $grade->title = $request->title;
        $grade->last_year_id = $request->last_year_id;
        $grade->save();

        return redirect()->route('grade.index');
    }

    public function destroy($grade)
    {
        Grade::destroy($grade);
        return redirect()->route('grade.index');

    }
}
