<?php

namespace App\Http\Controllers;

use App\book;
use App\DescriptiveAnswer;
use App\DescriptiveTest;
use App\Exam;
use App\ExamBook;
use App\Grade;
use App\Lesson;
use App\Topic;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function selectionExamTopicTestIndex()
    {
        $exams = Exam::where('section', 1)->where('examable_type', Topic::class)->where('questionFormat', 0)->get();
        $grades = Grade::all();
        return view('backEnd.education.selectionExam.topic.test.index', compact('exams', 'grades'));
    }

    public function selectionExamTopicTestStore(Request $request)
    {
        $answerSheet = null;
        if($request->hasFile('answerSheet')){
            if ($request->file('answerSheet')->extension() == 'pdf'){
                $file = $request->file('answerSheet');
                $filename = $file->getClientOriginalName();
                $path = 'upload/exam/' . $filename;
                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)).$filename;
                }
                $file->move('upload/exam/', $filename);
                $answerSheet = 'upload/exam/' . $filename;
            }
        }

        $exam = Exam::create([
            'section' => 1, // انتخابی
            'questionFormat' => 0, // تستی
            'level' => $request->level,
            'examable_type' => Topic::class,
            'examable_id' => $request->topic_id,
            'suggestedTime' => $request->suggestedTime,
            'answerSheet' => $answerSheet
        ]);

        for ($i=0; $i<count($request->question); $i++){
            $data = [
                'question' => $request->question[$i],
                'answerOne' => $request->answerOne[$i],
                'answerTwo' => $request->answerTwo[$i],
                'answerThree' => $request->answerThree[$i],
                'answerFour' => $request->answerFour[$i],
                'True' => $request->True[$i],
//                'testable_type' => $request->question[$i],
//                'testable_id' => $request->question[$i],
                'exam_id' => $exam->id,
                'format' => $request->input('testFormat'.$i, 1)
            ];
            $file=$request->file('image.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['image'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerOneImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageOne'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerTwoImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageTwo'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerThreeImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageThree'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerFourImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageFour'] = "upload/exam/" . $image;
            }
            ExamBook::create($data);
        }
        return redirect()->route('education.selectionExam.topic.test.Index');
    }

    public function selectionExamTopicDescriptiveTestIndex()
    {
        $exams = Exam::where('section', 1)->where('examable_type', Topic::class)->where('questionFormat', 1)->get();
        $grades = Grade::all();
        return view('backEnd.education.selectionExam.topic.descriptive.index', compact('exams', 'grades'));
    }

    public function selectionExamTopicDescriptiveTestStore(Request $request)
    {
        $answerSheet = null;
        if($request->hasFile('answerSheet')){
            if ($request->file('answerSheet')->extension() == 'pdf'){
                $file = $request->file('answerSheet');
                $filename = $file->getClientOriginalName();
                $path = 'upload/exam/' . $filename;
                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)).$filename;
                }
                $file->move('upload/exam/', $filename);
                $answerSheet = 'upload/exam/' . $filename;
            }
        }

        $exam = Exam::create([
            'section' => 1, // انتخابی
            'questionFormat' => 1, // تشریحی
            'level' => $request->level,
            'examable_type' => Topic::class,
            'examable_id' => $request->topic_id,
            'suggestedTime' => $request->suggestedTime,
            'answerSheet' => $answerSheet
        ]);

        for ($i=0; $i<count($request->question); $i++){
            $data = [
                'question' => $request->question[$i],
//                'testable_type' => $request->question[$i],
//                'testable_id' => $request->question[$i],
                'exam_id' => $exam->id,
            ];
            $file=$request->file('image.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['image'] = "upload/exam/" . $image;
            }
            $descriptiveTest = DescriptiveTest::create($data);
            for ($j=0;$j<count($request->input("answer_$i"));$j++){
                $file=$request->file("answer_image_$i.".$j);
                if(!empty($file)){
                    $image=$file->getClientOriginalName();
                    $path="upload/exam/".$image;

                    if (file_exists($path)){
                        $image=bin2hex(random_bytes(4)).$image;
                    }

                    $file->move("upload/exam/",$image);
                    $answerImage = "upload/exam/" . $image;
                }
                DescriptiveAnswer::create([
                    'descriptive_test_id' => $descriptiveTest->id,
                    'body' => $request->input("answer_$i")[$j],
                    'number' => $j,
                    'score' => (double)$request->input("score_$i")[$j],
                    'image' => $answerImage
                ]);

            }
        }
        return redirect()->route('education.selectionExam.topic.descriptiveTest.Index');
    }

    public function selectionExamStandardTestIndex()
    {
        $exams = Exam::where('section', 1)->where('examable_type', book::class)->where('questionFormat', 0)->get();
        $grades = Grade::all();

        return view('backEnd.education.selectionExam.standard.test.index', compact('exams', 'grades'));
    }

    public function selectionExamStandardTestStore(Request $request)
    {
        $answerSheet = null;
        if($request->hasFile('answerSheet')){
            if ($request->file('answerSheet')->extension() == 'pdf'){
                $file = $request->file('answerSheet');
                $filename = $file->getClientOriginalName();
                $path = 'upload/exam/' . $filename;
                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)).$filename;
                }
                $file->move('upload/exam/', $filename);
                $answerSheet = 'upload/exam/' . $filename;
            }
        }

        $exam = Exam::create([
            'section' => 1, // انتخابی
            'questionFormat' => 0, // تستی
            'period' => $request->period,
            'number' => $request->number,
            'examable_type' => book::class,
            'examable_id' => $request->session_id,
            'suggestedTime' => $request->suggestedTime,
            'answerSheet' => $answerSheet
        ]);

        for ($i=0; $i<count($request->question); $i++){
            $data = [
                'question' => $request->question[$i],
                'answerOne' => $request->answerOne[$i],
                'answerTwo' => $request->answerTwo[$i],
                'answerThree' => $request->answerThree[$i],
                'answerFour' => $request->answerFour[$i],
                'True' => $request->True[$i],
//                'testable_type' => $request->question[$i],
//                'testable_id' => $request->question[$i],
                'exam_id' => $exam->id,
                'format' => $request->input('testFormat'.$i, 1)
            ];
            $file=$request->file('image.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['image'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerOneImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageOne'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerTwoImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageTwo'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerThreeImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageThree'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerFourImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageFour'] = "upload/exam/" . $image;
            }
            ExamBook::create($data);
        }
        return redirect()->route('education.selectionExam.standard.test.Index');
    }

    public function selectionExamStandardDescriptiveTestIndex()
    {
        $exams = Exam::where('section', 1)->where('examable_type', book::class)->where('questionFormat', 1)->get();
        $grades = Grade::all();

        return view('backEnd.education.selectionExam.standard.descriptive.index', compact('exams', 'grades'));
    }

    public function selectionExamStandardDescriptiveTestStore(Request $request)
    {
        $answerSheet = null;
        if($request->hasFile('answerSheet')){
            if ($request->file('answerSheet')->extension() == 'pdf'){
                $file = $request->file('answerSheet');
                $filename = $file->getClientOriginalName();
                $path = 'upload/exam/' . $filename;
                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)).$filename;
                }
                $file->move('upload/exam/', $filename);
                $answerSheet = 'upload/exam/' . $filename;
            }
        }

        $exam = Exam::create([
            'section' => 1, // انتخابی
            'questionFormat' => 1, // تشریحی
            'period' => $request->period,
            'number' => $request->number,
            'examable_type' => book::class,
            'examable_id' => $request->session_id,
            'suggestedTime' => $request->suggestedTime,
            'answerSheet' => $answerSheet
        ]);

        for ($i=0; $i<count($request->question); $i++){
            $data = [
                'question' => $request->question[$i],
//                'testable_type' => $request->question[$i],
//                'testable_id' => $request->question[$i],
                'exam_id' => $exam->id,
            ];
            $file=$request->file('image.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['image'] = "upload/exam/" . $image;
            }
            $descriptiveTest = DescriptiveTest::create($data);
            for ($j=0;$j<count($request->input("answer_$i"));$j++){
                $file=$request->file("answer_image_$i.".$j);
                if(!empty($file)){
                    $image=$file->getClientOriginalName();
                    $path="upload/exam/".$image;

                    if (file_exists($path)){
                        $image=bin2hex(random_bytes(4)).$image;
                    }

                    $file->move("upload/exam/",$image);
                    $answerImage = "upload/exam/" . $image;
                }
                DescriptiveAnswer::create([
                    'descriptive_test_id' => $descriptiveTest->id,
                    'body' => $request->input("answer_$i")[$j],
                    'number' => $j,
                    'score' => (double)$request->input("score_$i")[$j],
                    'image' => $answerImage
                ]);

            }
        }
        return redirect()->route('education.selectionExam.standard.descriptiveTest.Index');
    }

    public function planExamTestIndex()
    {
        $exams = Exam::where('section', 0)->where('questionFormat', 0)->where('type', '!=', 0)->get();
        $grades = Grade::all();

        return view('backEnd.education.PlanExam.test.index', compact('exams', 'grades'));
    }

    public function planExamTestStore(Request $request)
    {
        $realTimestampStart = substr($request->start_at, 0, 10);
        $start_at = date("Y-m-d H:i:s", (int)$realTimestampStart);

        $answerSheet = null;
        if($request->hasFile('answerSheet')){
            if ($request->file('answerSheet')->extension() == 'pdf'){
                $file = $request->file('answerSheet');
                $filename = $file->getClientOriginalName();
                $path = 'upload/exam/' . $filename;
                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)).$filename;
                }
                $file->move('upload/exam/', $filename);
                $answerSheet = 'upload/exam/' . $filename;
            }
        }

        $exam = Exam::create([
            'section' => 0, // برنامه‌ای
            'questionFormat' => 0, // تستی
            'type' => $request->type,
            'scheduling' => $request->scheduling,
            'number' => $request->number,
            'examable_type' => Topic::class,
            'examable_id' => $request->topic_id,
            'suggestedTime' => $request->suggestedTime,
            'period' => $request->period,
            'start_at' => $start_at,
            'answerSheet' => $answerSheet
        ]);

        for ($i=0; $i<count($request->question); $i++){
            $data = [
                'question' => $request->question[$i],
                'answerOne' => $request->answerOne[$i],
                'answerTwo' => $request->answerTwo[$i],
                'answerThree' => $request->answerThree[$i],
                'answerFour' => $request->answerFour[$i],
                'True' => $request->True[$i],
//                'testable_type' => $request->question[$i],
//                'testable_id' => $request->question[$i],
                'exam_id' => $exam->id,
                'format' => $request->input('testFormat'.$i, 1),
                'level' => $request->question_level[$i],
            ];
            $file=$request->file('image.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['image'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerOneImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageOne'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerTwoImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageTwo'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerThreeImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageThree'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerFourImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageFour'] = "upload/exam/" . $image;
            }

            ExamBook::create($data);
        }
        return redirect()->route('education.planExam.test.Index');
    }

    public function planExamDescriptiveTestIndex()
    {
        $exams = Exam::where('section', 0)->where('questionFormat', 0)->where('type', '!=', 0)->get();
        $grades = Grade::all();

        return view('backEnd.education.PlanExam.descriptive.index', compact('exams', 'grades'));
    }

    public function planExamDescriptiveTestStore(Request $request)
    {
        $realTimestampStart = substr($request->start_at, 0, 10);
        $start_at = date("Y-m-d H:i:s", (int)$realTimestampStart);

        $realTimestampStartEndAt = substr($request->start_at, 0, 10);
        $end_at = date("Y-m-d H:i:s", (int)$realTimestampStartEndAt);

        $answerSheet = null;
        if($request->hasFile('answerSheet')){
            if ($request->file('answerSheet')->extension() == 'pdf'){
                $file = $request->file('answerSheet');
                $filename = $file->getClientOriginalName();
                $path = 'upload/exam/' . $filename;
                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)).$filename;
                }
                $file->move('upload/exam/', $filename);
                $answerSheet = 'upload/exam/' . $filename;
            }
        }

        $exam = Exam::create([
            'section' => 0, // برنامه‌ای
            'questionFormat' => 0, // تستی
            'type' => $request->type,
            'scheduling' => $request->scheduling,
            'number' => $request->number,
            'examable_type' => Topic::class,
            'examable_id' => $request->topic_id,
            'suggestedTime' => $request->suggestedTime,
            'period' => $request->period,
            'start_at' => $start_at,
            'end_at' => $end_at,
            'answerSheet' => $answerSheet
        ]);

        for ($i=0; $i<count($request->question); $i++){
            $data = [
                'question' => $request->question[$i],
//                'testable_type' => $request->question[$i],
//                'testable_id' => $request->question[$i],
                'exam_id' => $exam->id,
            ];
            $file=$request->file('image.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['image'] = "upload/exam/" . $image;
            }
            $descriptiveTest = DescriptiveTest::create($data);
            for ($j=0;$j<count($request->input("answer_$i"));$j++){
                $file=$request->file("answer_image_$i.".$j);
                if(!empty($file)){
                    $image=$file->getClientOriginalName();
                    $path="upload/exam/".$image;

                    if (file_exists($path)){
                        $image=bin2hex(random_bytes(4)).$image;
                    }

                    $file->move("upload/exam/",$image);
                    $answerImage = "upload/exam/" . $image;
                }
                DescriptiveAnswer::create([
                    'descriptive_test_id' => $descriptiveTest->id,
                    'body' => $request->input("answer_$i")[$j],
                    'number' => $j,
                    'score' => (double)$request->input("score_$i")[$j],
                    'image' => $answerImage
                ]);

            }
        }
        return redirect()->route('education.planExam.descriptive.Index');
    }

    public function planExamTestPlacementTestIndex()
    {
        $exams = Exam::where('section', 0)->where('questionFormat', 0)->where('type', 0)->get();
        $grades = Grade::all();

        return view('backEnd.education.PlanExam.placementTest.test.index', compact('exams', 'grades'));
    }

    public function planExamTestPlacementTestStore(Request $request)
    {
        $answerSheet = null;
        if($request->hasFile('answerSheet')){
            if ($request->file('answerSheet')->extension() == 'pdf'){
                $file = $request->file('answerSheet');
                $filename = $file->getClientOriginalName();
                $path = 'upload/exam/' . $filename;
                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)).$filename;
                }
                $file->move('upload/exam/', $filename);
                $answerSheet = 'upload/exam/' . $filename;
            }
        }
        $exam = Exam::where('section', 0)->where('questionFormat', 0)->where('type', 0)->where('examable_type', Lesson::class)->where('examable_id', $request->lesson_id)->get();
        if ($exam->count() > 0)
            $exam = $exam->first();
        else
            $exam = Exam::create([
                'section' => 0, // برنامه‌ای
                'questionFormat' => 0, // تستی
                'type' => 0, // تعیین سطح
                'examable_type' => Lesson::class,
                'examable_id' => $request->lesson_id,
                'suggestedTime' => $request->suggestedTime,
                'answerSheet' => $answerSheet
            ]);

        for ($i=0; $i<count($request->question); $i++){
            $data = [
                'question' => $request->question[$i],
                'answerOne' => $request->answerOne[$i],
                'answerTwo' => $request->answerTwo[$i],
                'answerThree' => $request->answerThree[$i],
                'answerFour' => $request->answerFour[$i],
                'True' => $request->True[$i],
                'testable_type' => Topic::class,
                'testable_id' => $request->topic_id,
                'exam_id' => $exam->id,
                'format' => $request->input('testFormat'.$i, 1),
                'level' => $request->question_level[$i],
            ];
            $file=$request->file('image.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['image'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerOneImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageOne'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerTwoImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageTwo'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerThreeImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageThree'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerFourImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageFour'] = "upload/exam/" . $image;
            }
            ExamBook::create($data);
        }
        return redirect()->route('education.planExam.placementTest.test.index')->with('success', 'آزمون با موفقیت ساخته شد');
    }

    public function planExamDescriptivePlacementTestIndex()
    {
        $exams = Exam::where('section', 0)->where('questionFormat', 1)->where('type', 0)->get();
        $grades = Grade::all();

        return view('backEnd.education.PlanExam.descriptive.test.index', compact('exams', 'grades'));
    }

    public function planExamDescriptivePlacementTestStore(Request $request)
    {
        $answerSheet = null;
        if($request->hasFile('answerSheet')){
            if ($request->file('answerSheet')->extension() == 'pdf'){
                $file = $request->file('answerSheet');
                $filename = $file->getClientOriginalName();
                $path = 'upload/exam/' . $filename;
                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)).$filename;
                }
                $file->move('upload/exam/', $filename);
                $answerSheet = 'upload/exam/' . $filename;
            }
        }

        $exam = Exam::where('section', 0)->where('questionFormat', 1)->where('type', 0)->where('examable_type', Lesson::class)->where('examable_id', $request->lesson_id)->get();
        if ($exam->count() > 0)
            $exam = $exam->first();
        else
            $exam = Exam::create([
                'section' => 0, // برنامه‌ای
                'questionFormat' => 0, // تستی
                'type' => 0, // تعیین سطح
                'examable_type' => Lesson::class,
                'examable_id' => $request->lesson_id,
                'suggestedTime' => $request->suggestedTime,
                'answerSheet' => $answerSheet
            ]);

        for ($i=0; $i<count($request->question); $i++){
            $data = [
                'question' => $request->question[$i],
                'testable_type' => Topic::class,
                'testable_id' => $request->topic_id,
                'exam_id' => $exam->id,
            ];
            $file=$request->file('image.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['image'] = "upload/exam/" . $image;
            }
            $descriptiveTest = DescriptiveTest::create($data);
            for ($j=0;$j<count($request->input("answer_$i"));$j++){
                $file=$request->file("answer_image_$i.".$j);
                if(!empty($file)){
                    $image=$file->getClientOriginalName();
                    $path="upload/exam/".$image;

                    if (file_exists($path)){
                        $image=bin2hex(random_bytes(4)).$image;
                    }

                    $file->move("upload/exam/",$image);
                    $answerImage = "upload/exam/" . $image;
                }
                DescriptiveAnswer::create([
                    'descriptive_test_id' => $descriptiveTest->id,
                    'body' => $request->input("answer_$i")[$j],
                    'number' => $j,
                    'score' => (double)$request->input("score_$i")[$j],
                    'image' => $answerImage
                ]);

            }
        }
        return redirect()->route('education.planExam.placementTest.descriptive.index')->with('success', 'آزمون با موفقیت ساخته شد');
    }

}
