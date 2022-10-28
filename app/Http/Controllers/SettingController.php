<?php

namespace App\Http\Controllers;

use App\book;
use App\Grade;
use App\KaranCompetition;
use App\KaranCompetitionAnswer;
use App\Lesson;
use App\Schedule;
use App\Setting;
use App\StudentImage;
use App\Teacher;
use App\TeacherSession;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{
    public function logo(Request $request){

        $setting = Setting::latest()->first();

        if ($request->isMethod('POST')){
            $setting->logo_text = $request->logo_text;
            $setting->save();

            return redirect()->route('setting.logo.index')->with('success', 'توضیحات لوگو با موفقیت ویرایش شد.');
        }

        return view('backEnd.setting.logo.index', compact('setting'));
    }

    public function agent(Request $request){

        $setting = Setting::latest()->first();

        if ($request->isMethod('POST')){
            $setting->agent_text = $request->agent_text;
            $file=$request->file('agent_image');
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path = "upload/setting/" . $image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/setting/", $image);
                $setting->agent_image = $path;
            }
            $setting->save();

            return redirect()->route('setting.agent.index')->with('success', 'تنظیمات شخص معرف رشته با موفقیت ویرایش شد.');
        }

        return view('backEnd.setting.agent.index', compact('setting'));
    }

    public function help(Request $request, $type){

        $setting = Setting::latest()->first();

        if ($request->isMethod('POST')){

            $pdfs = $setting->pdfs;
            $videos = $setting->videos;
            $file = $request->file('pdf');
            if(!empty($file)){
                $pdfFile = $file->getClientOriginalName();
                $pdfPath = "upload/setting/" . $pdfFile;

                if (file_exists($pdfPath)){
                    $pdfFile=bin2hex(random_bytes(4)).$pdfFile;
                }

                $file->move("upload/setting/", $pdfFile);
                $pdfs[$type] = $pdfPath;
            }
            $video = $request->file('video');

            if(!empty($video)){
                $videoFile = $video->getClientOriginalName();
                $videoPath = "upload/setting/" . $videoFile;

                if (file_exists($videoPath)){
                    $videoFile = bin2hex(random_bytes(4)) . $videoFile;
                }

                $video->move("upload/setting/", $videoFile);
                $videos[$type] = $videoPath;
            }
            $setting->pdfs = $pdfs;
            $setting->videos = $videos;
            $setting->save();

            return redirect()->route('setting.help.index', $type)->with('success', 'تنظیمات راهنما با موفقیت ویرایش شد.');
        }

        return view('backEnd.setting.help.index', compact('setting', 'type'));
    }

    public function student(Request $request)
    {
        $studentImages = StudentImage::latest()->get();

        if ($request->isMethod('POST')){
            $inputs = $request->all();
            $file = $request->file('image');
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path = "upload/setting/" . $image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/setting/", $image);
                $inputs['image'] = $path;
            }
            StudentImage::create($inputs);

            return redirect()->route('setting.student.index')->with('success', 'تنظیمات تصویر دانش‌آموز با موفقیت ویرایش شد.');
        }

        return view('backEnd.setting.student.index', compact('studentImages'));
    }

    public function studentDestroy(StudentImage $studentImage)
    {
        if (file_exists($studentImage->image))
            unlink($studentImage->image);

        $studentImage->delete();

        return redirect()->route('setting.student.index')->with('success', ' تصویر دانش‌آموز با موفقیت حذف شد.');
    }

    public function karanCompetitionIndex()
    {
        $karanCompetitions = KaranCompetition::latest()->get();
        $grades = Grade::all();

        return view('backEnd.setting.karan.index', compact('karanCompetitions', 'grades'));
    }

    public function karanCompetitionStore(Request $request)
    {
        $inputs = $request->all();
        $file=$request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path = "upload/karanCompetition/" . $image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)).$image;
            }

            $file->move("upload/karanCompetition/", $image);
            $inputs['image'] = $path;
        }
        $karanCompetition = KaranCompetition::create($inputs);

        for ($i=0; $i<count($request->answer); $i++){
            $data = [
                'karan_competition_id' => $karanCompetition->id,
                'answer' => $request->answer[$i],
                'is_true' => $request->true - 1 == $i ? 1 : 0,
            ];
            $file=$request->file('answerImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path = "upload/karanCompetition/" . $image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)) . $image;
                }

                $file->move("upload/karanCompetition/", $image);
                $data['image'] = $path;
            }
            KaranCompetitionAnswer::create($data);
        }
        return redirect()->route('setting.karanCompetition.index')->with('success', 'سوال مسابقه کران با موفقیت ایجاد شد.');
    }

    public function karanCompetitionEdit(KaranCompetition $karanCompetition)
    {
        $karanCompetitions = KaranCompetition::latest()->get();
        $grades = Grade::all();

        return view('backEnd.setting.karan.edit', compact('karanCompetitions', 'grades', 'karanCompetition'));
    }

    public function karanCompetitionUpdate(Request $request, KaranCompetition $karanCompetition)
    {
        $inputs = $request->all();

        $file=$request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path = "upload/karanCompetition/" . $image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)).$image;
            }

            if (file_exists($karanCompetition->image))
                unlink($karanCompetition->image);

            $file->move("upload/karanCompetition/", $image);
            $inputs['image'] = $path;
        }

        $karanCompetition->update($inputs);

        $answers = $request->answer;

        foreach ($answers as $key => $value){
            $answer = KaranCompetitionAnswer::findOrFail($key);
            $data = [
                'answer' => $value,
                'is_true' => $request->true == $key ? 1 : 0
            ];
            $file=$request->file('answerImage.'.$key);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path = "upload/karanCompetition/" . $image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)) . $image;
                }

                $file->move("upload/karanCompetition/", $image);
                $data['image'] = $path;
            }
            $answer->update($data);
        }
        return redirect()->route('setting.karanCompetition.index')->with('success', 'سوال مسابقه کران با موفقیت ویرایش شد.');
    }

    public function karanCompetitionDestroy(KaranCompetition $karanCompetition)
    {
        foreach ($karanCompetition->answers as $answer){
            if (file_exists($answer->image))
                unlink($answer->image);
            $answer->delete();
        }
        if (file_exists($karanCompetition->image))
            unlink($karanCompetition->image);
        $karanCompetition->delete();

        return redirect()->route('setting.karanCompetition.index')->with('success', 'سوال مسابقه کران با موفقیت حذف شد.');

    }

    public function teacherIndex()
    {
        $users = User::whereHas(
            'roles', function($q){
            $q->where('name', '!=', 'دبیر');
        }
        )->get();
        $sessions = book::where('part', null)->latest()->get();
        $grades = Grade::all();

        return view('backEnd.setting.teacher.index', compact( 'sessions', 'users', 'grades'));
    }

    public function teacherList(Request $request)
    {
        if ($request->ajax()) {

            $data = Teacher::with('user')->latest()->get();

            if (!empty($request->get('grade_id'))) {
                $grade = $request->get('grade_id');
                $sessionIds = book::whereHas('lesson', function ($query) use ($grade){
                    return $query->where('grade_id', $grade);
                })->where('part', null)->get()->pluck('id')->toArray();
                $teacherIds = TeacherSession::whereIn('session_id', $sessionIds)->pluck('teacher_id')->toArray();

                $data = Teacher::whereIn('id', $teacherIds)->with('user')->latest()->get();
            }

            if (!empty($request->get('lesson_id'))) {
                $lesson = Lesson::findOrFail($request->get('lesson_id'));
                $sessionIds = $lesson->books()->where('part', null)->get()->pluck('id')->toArray();
                $teacherIds = TeacherSession::whereIn('session_id', $sessionIds)->pluck('teacher_id')->toArray();

                $data = Teacher::whereIn('id', $teacherIds)->with('user')->latest()->get();
            }


            $dataTable = Datatables::of($data);

            $dataTable
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('fullName', function ($row) {
                    return $row->user->fullName;
                })
                ->addColumn('action', function($row){
                    return '<span class="d-flex justify-content-center flex-row">
                                <a href=" ' . route('setting.teacherList.edit', $row->id) . '"
                                   class="btn btn-sm btn-info ml-2">
                                    <i class="fe fa fe-edit"></i>
                                </a>
                                <form action=" ' . route('setting.teacherList.destroy', $row->id) . '" method="post">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">' . '
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        <i class="fe fe-trash"></i>
                                    </button>
                                </form>
                            </span>';
                });

            return $dataTable->make(true);
        }
    }

    public function teacherStore(Request $request)
    {
        $inputs = $request->all();
        $user = User::findOrFail($inputs['user_id']);
        $file = $request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path = "upload/teacher/" . $image;

            if (file_exists($path)){
                $image = bin2hex(random_bytes(4)) . $image;
            }

            $file->move("upload/teacher/", $image);
            $user->image = $path;
            $user->save();
        }

        $user->assignRole('دبیر');
        $teacher = Teacher::create($inputs);
        $teacher->sessions()->attach($inputs['session_id']);

        return redirect()->route('setting.teacherList.index')->with('success', 'کاربر با موفقیت به استاد ارتقا یافت.');
    }

    public function teacherEdit(Teacher $teacher)
    {
        $teachers = Teacher::latest()->get();
        $sessions = book::where('part', null)->latest()->get();
        $grades = Grade::all();

        return view('backEnd.setting.teacher.edit', compact('teachers', 'grades', 'teacher', 'sessions'));
    }

    public function teacherUpdate(Request $request, Teacher $teacher)
    {
        $inputs = $request->all();

        $user = $teacher->user;

        $file = $request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path = "upload/teacher/" . $image;

            if (file_exists($path)){
                $image = bin2hex(random_bytes(4)) . $image;
            }

            $file->move("upload/teacher/", $image);
            $user->image = $path;
            $user->save();
        }

        $teacher->sessions()->detach();
        $teacher = $teacher->fresh('sessions');
        $teacher->sessions()->attach($inputs['session_id']);

        $teacher->update($inputs);

        return redirect()->route('setting.teacherList.index')->with('success', 'استاد با موفقیت ویرایش شد.');
    }

    public function teacherDestroy(Teacher $teacher)
    {
        $teacher->sessions()->delete();
        $teacher->delete();

        return redirect()->route('setting.teacherList.index')->with('success', 'استاد با موفقیت حذف شد.');
    }
}
