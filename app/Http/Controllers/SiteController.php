<?php

namespace App\Http\Controllers;

use App\Appendices;
use App\book;
use App\BooksExercise;
use App\DescriptiveTestAttachment;
use App\Document;
use App\Exam;
use App\ExamBook;
use App\ExamBookAttachment;
use App\ExamQuestionSample;
use App\Grade;
use App\KaranBala;
use App\Lesson;
use App\StudentTopic;
use App\TextBook;
use App\Topic;
use App\User;
use App\UserDescriptiveTestAnswer;
use App\UserExamAnswer;
use App\UserTestAnswer;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function grades()
    {
        $grades = Grade::all();

        return view('site.grade', compact('grades'));
    }

    public function lessons($gradeId)
    {
        $lessons = Lesson::where('grade_id', '=', $gradeId)->get();

        return view('site.lesson', compact('lessons'));
    }

    public function chooseLessonItem(Lesson $lesson)
    {
        return view('site.choose-lesson-item', compact('lesson'));
    }

    public function chooseSelectionExamItem(Lesson $lesson)
    {
        return view('site.choose-selection-exam-item', compact('lesson'));
    }

    public function chooseSelectionExamStandardSession(Lesson $lesson)
    {
        $books = book::where('lesson_id', $lesson->id)->where('part', null)->get();

        return view('site.choose-selection-exam-standard-session', compact('books'));
    }

    public function chooseSelectionExamStandard(book $book)
    {
        $exams = Exam::where('section', 1)->where('examable_id', $book->id)->get();

        return view('site.choose-selection-exam-standard', compact('exams'));
    }

    public function chooseAppendicesItem(book $book)
    {
        return view('site.choose-appendices-item', compact('book'));
    }

    public function chooseExamQuestionSampleSession(Lesson $lesson)
    {
        $books = book::where('lesson_id', $lesson->id)->where('part', null)->orderBy('id', 'asc')->get();

        return view('site.choose-exam-question-sample-session', ['books' => $books, 'lesson_id' => $lesson->id]);
    }

    public function sessionBook($lessonId, $operation)
    {
        if ($operation){
            Session::put('operation', $operation);
        }

        $books = book::where('lesson_id', '=', $lessonId)->where('part', null)->orderBy('priority', 'asc')->get();

        return view('site.session-book', compact('books'));
    }

    public function book(book $book)
    {
        $books = book::where('session', 'like', "%$book->session%")->whereNotNull('part')->where('lesson_id', $book->lesson_id)->orderby('id', 'asc')->get();
        $withoutPartTopics = Topic::where('book_id', $book->id)->get();

        return view('site.book', compact('books', 'withoutPartTopics'));
    }

    public function introduceBook(book $book)
    {
        return view('site.introduce-book', compact('book'));
    }


    public function overviewBook(Lesson $lesson)
    {
        $videos = Video::whereHasMorph('videoable', Lesson::class, function ($query) use ($lesson){
            return $query->where('id', $lesson->id);
        })->get();
        $documents = Document::whereHasMorph('documentable', Lesson::class, function ($query) use ($lesson){
            return $query->where('id', $lesson->id);
        })->get();
        $operation = 'lesson';
        $item = $lesson;

        return view('site.overview', compact('item', 'videos', 'documents', 'operation'));
    }

    public function textBook(Topic $topic)
    {
        $videos = Video::whereHasMorph('videoable', TextBook::class, function ($query) use ($topic){
            return $query->where('topic_id', $topic->id);
        })->get();
        $documents = Document::whereHasMorph('documentable', TextBook::class, function ($query) use ($topic){
            return $query->where('topic_id', $topic->id);
        })->get();
        $operation = 'textBook';
        $item = $topic;

        return view('site.overview', compact('item', 'videos', 'documents', 'operation'));

    }

    public function descriptive(Topic $topic)
    {
        $videos = Video::whereHasMorph('videoable', DescriptiveTestAttachment::class, function ($query) use ($topic){
            return $query->where('topic_id', $topic->id);
        })->get();
        $documents = Document::whereHasMorph('documentable', DescriptiveTestAttachment::class, function ($query) use ($topic){
            return $query->where('topic_id', $topic->id);
        })->get();
        $operation = 'descriptive';
        $item = $topic;

        return view('site.overview', compact('item', 'videos', 'documents', 'operation'));
    }

    public function examBook(Topic $topic)
    {
        $videos = Video::whereHasMorph('videoable', ExamBookAttachment::class, function ($query) use ($topic){
            return $query->where('topic_id', $topic->id);
        })->get();
        $documents = Document::whereHasMorph('documentable', ExamBookAttachment::class, function ($query) use ($topic){
            return $query->where('topic_id', $topic->id);
        })->get();
        $operation = 'examBook';
        $item = $topic;

        return view('site.overview', compact('item', 'videos', 'documents', 'operation'));
    }

    public function karanBala(Topic $topic)
    {
        $videos = Video::whereHasMorph('videoable', KaranBala::class, function ($query) use ($topic){
            return $query->where('topic_id', $topic->id);
        })->get();
        $documents = Document::whereHasMorph('documentable', KaranBala::class, function ($query) use ($topic){
            return $query->where('topic_id', $topic->id);
        })->get();
        $operation = 'karanBala';
        $item = $topic;

        return view('site.overview', compact('item', 'videos', 'documents', 'operation'));
    }

    public function appendices(book $book, $type)
    {
        $videos = Video::whereHasMorph('videoable', Appendices::class, function ($query) use ($book, $type){
            return $query->where('book_id', $book->id)->where('type', $type);
        })->get();
        $documents = Document::whereHasMorph('documentable', Appendices::class, function ($query) use ($book, $type){
            return $query->where('book_id', $book->id)->where('type', $type);
        })->get();
        $operation = 'appendices';
        $item = $book;

        return view('site.overview', compact('item', 'videos', 'documents', 'operation'));
    }

//    public function test(book $book)
//    {
//        $videos = Video::where('type', 1)->where('book_id', $book->id)->get();
//        $documents = Document::where('type', 1)->where('book_id', $book->id)->get();
//
//                return view('site.overview', compact('book', 'videos', 'documents', 'operation'));

//    }

    public function bookExercises(book $book)
    {
        $videos = Video::whereHasMorph('videoable', BooksExercise::class, function ($query) use ($book){
            return $query->where('book_id', $book->id);
        })->get();
        $documents = Document::whereHasMorph('documentable', BooksExercise::class, function ($query) use ($book){
            return $query->where('book_id', $book->id);
        })->get();
        $operation = 'bookExercises';
        $item = $book;

        return view('site.overview', compact('item', 'videos', 'documents', 'operation'));

    }

    public function examQuestionSample($item, $period=null)
    {
        $videos = Video::whereHasMorph('videoable', ExamQuestionSample::class, function ($query) use ($item, $period){
            if (empty($period))
                return $query->where('book_id', $item);
            else
                return $query->where('period', $period-1)->whereHas('book', function ($q) use ($item){
                    return $q->where('lesson_id', $item);
                });
        })->get();
        $documents = Document::whereHasMorph('documentable', ExamQuestionSample::class, function ($query) use ($item, $period){
            if (empty($period))
                return $query->where('book_id', $item);
            else
                return $query->where('period', $period-1)->whereHas('book', function ($q) use ($item){
                    return $q->where('lesson_id', $item);
                });
        })->get();
        $operation = 'examQuestionSample';
        $item = empty($period) ? book::findOrFail($item) : Lesson::findOrFail($item);

        return view('site.overview', compact('item', 'videos', 'documents', 'operation'));
    }

    public function generalTest(book $book)
    {
        $generalTests = ExamBook::where('exam_id', null)->where('testable_type', book::class)->where('testable_id', $book->id)->where('parent_id', null)->get();
        $operation = 'generalTest';
        $item = $book;

        return view('site.general-test', compact('item',  'operation', 'generalTests'));
    }

    public function onlineContact()
    {
        return 'online contact view';
    }

    public function aboutUs()
    {
        return 'about us view';
    }

    public function exam(Topic $item)
    {
        return view('site.exam', compact('item'));
    }

    public function selectExam(Topic $item, Request $request)
    {
        if($request->type == 'test')
            $questionFormat = 0;
        elseif($request->type == 'descriptive')
            $questionFormat = 1;

        $exams = Exam::where('examable_type', Topic::class)->where('examable_id', $item->id)->where('level', $request->level)->where('section', 1)->where('questionFormat', $questionFormat)->get();
        $level = $request->level;

        return view('site.exam', compact('item', 'exams', 'level'));
    }

    public function createExam(Exam $exam)
    {
        $user = auth()->user();

        $userExamAnswer = UserExamAnswer::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
        ]);

        return redirect()->route('exam.view', $userExamAnswer);
    }

    public function examView(UserExamAnswer $userExamAnswer)
    {
        return view('site.exam', ['item' => $userExamAnswer->exam->examable, 'userExamAnswer' => $userExamAnswer]);

//        if ($request->type == 'tashrih') {
//            $exams = Exam::where('examable_type', Topic::class)->whereIn('examable_id', $book->topics->pluck('id')->toArray())->where('level', '=', $request->level)->where('section', 1)->where('questionFormat', 1)->get();
//            $level = $request->level;
//
//            return view('site.exam', compact('book', 'user', 'level'));
//        }
    }

    public function submitExam(UserExamAnswer $userExamAnswer, Request $request)
    {
        $suggestedTime = explode(':', $userExamAnswer->exam->suggestedTime);
        if (Carbon::parse($userExamAnswer->created_at)->addHours($suggestedTime[0])->addMinutes($suggestedTime[1]) > Carbon::now() ){
            if ($userExamAnswer->exam->questionFormat == 0){
                $score = 0;
                if ($userExamAnswer->exam->type === 0)
                    foreach ($request->test as $key => $value){
                        $test = ExamBook::findOrFail($key);
                        if ($request->test[$key] == $test->True)
                            $score += 1;
                        else
                            StudentTopic::create([
                                'student_id' => auth()->id(),
                                'topic_id' => $test->testable_id
                            ]);
                        UserTestAnswer::create([
                            'user_exam_answer_id' => $userExamAnswer->id,
                            'test_id' => $key,
                            'answer' => $value
                        ]);
                    }
                else
                    foreach ($request->test as $key => $value){
                        if ($request->test[$key] == ExamBook::findOrFail($key)->True)
                            $score += 1;
                        UserTestAnswer::create([
                            'user_exam_answer_id' => $userExamAnswer->id,
                            'test_id' => $key,
                            'answer' => $value
                        ]);
                    }
                $userExamAnswer->update(['score' => $score]);

                return redirect()->route('user.dashboard.exam.placementTest.analyseTest', $userExamAnswer);
            }
            elseif ($userExamAnswer->exam->questionFormat == 1){
                foreach ($request->descriptiveTest as $key => $value){
                    UserDescriptiveTestAnswer::create([
                        'user_exam_answer_id' => $userExamAnswer->id,
                        'test_id' => $key,
                        'answer' => $value
                    ]);
                }
            }

        }else {
            return redirect()->back()->with('error', 'زمان آزمون به پایان رسیده است');
        }
    }

    public function submitGeneralTests(Request $request)
    {
        $user = User::first();

        foreach ($request->test as $key => $value){
            UserTestAnswer::create([
                'user_id' => $user->id,
                'test_id' => $key,
                'answer' => $value
            ]);
        }

        return redirect()->route('grades');
    }

    public function examResult(UserExamAnswer $userExamAnswer)
    {
        return view('site.test-exam-result', ['item' => $userExamAnswer->exam->examable, 'userTestAnswers' => $userExamAnswer->userTestAnswers, 'userExamAnswer' => $userExamAnswer]);
    }

    public function chooseExamType()
    {
        return view('user.dashboard.exam.placementTest.choose-exam-type');
    }
}
