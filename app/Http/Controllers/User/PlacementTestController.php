<?php

namespace App\Http\Controllers\User;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\UserExamAnswer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PlacementTestController extends Controller
{
    public function index()
    {
        return view('user.dashboard.exam.placementTest.index');
    }

    public function chooseLesson()
    {
        $user = auth()->user();
        $grade = $user->userMeta->grade;
        $exams = UserExamAnswer::where('user_id', $user->id)->whereHas('exam', function ($query){
            return $query->where('section', 0)->where('questionFormat', 0)->where('type', 0);
        })->latest()->get();

        return view('user.dashboard.exam.placementTest.choose-lesson', compact('grade', 'exams'));
    }

    public function topics(Request $request)
    {
        if ($request->ajax()) {

            $data = auth()->user()->topics;

            if ($request->get('lesson_id')) {
                $lesson = $request->get('lesson_id');
                $data = auth()->user()->topics()->whereHas('book', function ($query) use ($lesson){
                    return $query->where('lesson_id', $lesson);
                })->latest()->get();
            }

            $dataTable =  Datatables::of($data);

            $dataTable
                ->addColumn('id', function($row){
                    return $row->id;
                })
                ->addColumn('topic', function($row){
                    return $row->title;
                });

            return $dataTable->make(true);
        }
    }

    public function findExam(Lesson $lesson)
    {
        $exam = Exam::where('section', 0)->where('questionFormat', 0)->where('type', 0)->where('examable_type', Lesson::class)->where('examable_id', $lesson->id)->get();
        if ($exam->count() > 0)
            return redirect()->route('exam.create', $exam->first());
        else
            return redirect()->route('user.dashboard.exam.placementTest.chooseLesson')->with('error', 'آزمونی برای این درس پیدا نشد');
    }

    public function analyseTest(UserExamAnswer $userExamAnswer)
    {
        return view('user.dashboard.exam.placementTest.analyse-test', compact('userExamAnswer'));
    }
}
