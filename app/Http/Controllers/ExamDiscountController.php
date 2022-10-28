<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Exam;
use App\ExamBook;
use App\ExamDiscount;
use App\Grade;
use App\Topic;
use Illuminate\Http\Request;

class ExamDiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::where('type', 3)->latest()->get();
        $grades = Grade::all();

        return view('backEnd.discount.planExam.index')->with(compact('discounts', 'grades'));
    }

    public function getGradePlanExams(Request $request)
    {
        $grade = Grade::find($request->grade_id);
        $exams = Exam::where(function ($query) use ($grade){
            return $query->whereHasMorph('examable', Topic::class, function ($qry) use ($grade){
                return $qry->whereHas('book', function ($qr) use ($grade){
                    return $qr->whereHas('lesson', function ($q) use ($grade){
                        return $q->where('grade_id', $grade->id);
                    });
                });
            });
        })->where('section', 0)->get();

        return response()->json($exams);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $realTimestampDiscountStartDate = substr($request->discount_start_date, 0, 10);
        $data['discount_start_date'] = date("Y-m-d", (int)$realTimestampDiscountStartDate);

        $realTimestampDiscountEndDate = substr($request->discount_end_date, 0, 10);
        $data['discount_end_date'] = date("Y-m-d", (int)$realTimestampDiscountEndDate);

        ExamDiscount::create($data);

        return redirect()->route('discount.examDiscount.index');
    }
}
