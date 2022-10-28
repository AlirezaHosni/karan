<?php

namespace App\Http\Controllers\User;

use App\book;
use App\GradeDescription;
use App\Http\Controllers\Controller;
use App\Lesson;
use App\News;
use App\Rate;
use App\Report;
use App\Schedule;
use App\StudentImage;
use App\TeacherSession;
use App\UserExamAnswer;
use App\UserFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class DesktopController extends Controller
{
    public function index()
    {
        return view('user.dashboard.desktop.index');
    }

    public function contactUsIndex()
    {
        $user = auth()->user();

        $userFiles = UserFile::where('user_id', $user->id)->where('section', 0)->latest()->get();

        return view('user.dashboard.desktop.contactUs.index', compact('userFiles'));
    }

    public function contactUsStore(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();

        $file = $request->file('file');
        if(!empty($file)){
            $image = $file->getClientOriginalName();

            if(in_array(strtoupper($file->extension()), ['MP3', 'PCM', 'WAV', 'AIFF', 'AAC', 'WMA ']))
                $data['format'] = 0;
            elseif ($file->extension() == 'pdf')
                $data['format'] = 1;
            elseif(in_array(strtoupper($file->extension()), ['PNG ', 'JPG', 'JPEG', 'GIF']))
                $data['format'] = 2;

            $path = "upload/contactUs/" . $image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)) . $image;
            }

            $file->move("upload/contactUs/", $image);
            $data['file'] = $path;
            $data['user_id'] = $user->id;
            $data['section'] = 0;

            UserFile::create($data);

            return redirect()->route('user.dashboard.contactUs.index')->with('success', 'عملیات با موفقیت انجام شد');
        }
        return redirect()->route('user.dashboard.contactUs.index')->with('error', 'عملیات انجام نشد');
    }

    public function contactUsDestroy(UserFile $userFile)
    {
        if (file_exists($userFile->file))
            unlink($userFile->file);

        $userFile->delete();

        return redirect()->route('user.dashboard.contactUs.index')->with('success', 'حذف با موفقیت انجام شد');
    }

    public function rateTeachersIndex()
    {
        $teacherSessions = TeacherSession::all();

        return view('user.dashboard.desktop.rateTeacher.index', compact('teacherSessions'));
    }

    public function rateTeachersStore(Request $request)
    {
        $user = auth()->user();
        foreach ($request->expert as $key => $value){
            $teacherSession = TeacherSession::findOrFail($key);
            $total = 0;
            $number = 0;
            $expert = $request->expert[$key] ?? null;
            if ($expert){
                $total += $expert;
                $number += 1;
            }
            $teaching_method = $request->teaching_method[$key] ?? null;
            if ($teaching_method){
                $total += $teaching_method;
                $number += 1;
            }
            $complete_teaching = $request->complete_teaching[$key] ?? null;
            if ($complete_teaching){
                $total += $complete_teaching;
                $number += 1;
            }
            $question_answering_method = $request->question_answering_method[$key] ?? null;
            if ($question_answering_method){
                $total += $question_answering_method;
                $number += 1;
            }
            $visual_communication = $request->visual_communication[$key] ?? null;
            if ($visual_communication){
                $total += $visual_communication;
                $number += 1;
            }

            $average = $number == 0 ? null : ($total/$number);

            Rate::create([
                'user_id' => $user->id,
                'teacher_id' => $teacherSession->teacher->id,
                'session_id' => $teacherSession->session->id,
                'expert' => $expert,
                'teaching_method' => $teaching_method,
                'complete_teaching' => $complete_teaching,
                'question_answering_method' => $question_answering_method,
                'visual_communication' => $visual_communication,
                'average' => $average
            ]);
        }

        return redirect()->route('user.dashboard.rateTeacher.index')->with('success', 'امتیاز با موفقیت ثبت شد');
    }

    public function speakToStudent()
    {
        $studentImages = StudentImage::latest()->get();

        return view('user.dashboard.desktop.speakToStudent.index', compact('studentImages'));
    }

    public function examReportIndex()
    {
        $user = auth()->user();
        $examReports = UserExamAnswer::where('user_id', $user->id)->latest()->get();

        return view('user.dashboard.desktop.examReport.index', compact('examReports'));
    }

    public function UserFileIndex()
    {
        $user = auth()->user();
        $userFiles = UserFile::where('user_id', $user->id)->where('section', 1)->latest()->get();

        return view('user.dashboard.desktop.userFile.index', compact('userFiles'));
    }

    public function UserFileStore(Request $request)
    {
        $data = $request->all();

        $file = $request->file('file');
        if(!empty($file)){
            $image = $file->getClientOriginalName();

            if(in_array(strtoupper($file->extension()), ['MP3', 'PCM', 'WAV', 'AIFF', 'AAC', 'WMA']))
                $data['format'] = 0;
            elseif ($file->extension() == 'pdf')
                $data['format'] = 1;
            elseif(in_array(strtoupper($file->extension()), ['PNG ', 'JPG', 'JPEG', 'GIF']))
                $data['format'] = 2;

            $path = "upload/contactUs/" . $image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)) . $image;
            }

            $file->move("upload/contactUs/", $image);
            $data['file'] = $path;
            $data['section'] = 1;
            $data['user_id'] = auth()->id();
            UserFile::create($data);

            return redirect()->route('user.dashboard.UserFile.index')->with('success', 'ذخیره فایل ذخیره شده با موفقیت انجام شد');
        }

        return redirect()->route('user.dashboard.UserFile.index')->with('error', 'ذخیره فایل ذخیره شده با موفقیت انجام نشد');
    }

    public function UserFileEdit(UserFile $userFile)
    {
        $user = auth()->user();
        $userFiles = UserFile::where('user_id', $user->id)->where('section', 1)->latest()->get();

        return view('user.dashboard.desktop.userFile.edit', compact('userFile', 'userFiles'));
    }

    public function UserFileUpdate(Request $request, UserFile $userFile)
    {
        $data = $request->all();

        $file = $request->file('file');
        if(!empty($file)){
            $image = $file->getClientOriginalName();

            if(in_array(strtoupper($file->extension()), ['MP3', 'PCM', 'WAV', 'AIFF', 'AAC', 'WMA']))
                $data['format'] = 0;
            elseif ($file->extension() == 'pdf')
                $data['format'] = 1;
            elseif(in_array(strtoupper($file->extension()), ['PNG ', 'JPG', 'JPEG', 'GIF']))
                $data['format'] = 2;

            $path = "upload/contactUs/" . $image;

            if (file_exists($path)){
                $image = bin2hex(random_bytes(4)) . $image;
            }

            if (file_exists($userFile->file))
                unlink($userFile->file);

            $file->move("upload/contactUs/", $image);
            $data['file'] = $path;
        }
        $userFile->update($data);

        return redirect()->route('user.dashboard.UserFile.index')->with('success', 'ویرایش فایل ذخیره شده با موفقیت انجام شد');
    }

    public function UserFileDestroy(UserFile $userFile)
    {
        if (file_exists($userFile->file))
            unlink($userFile->file);

        $userFile->delete();

        return redirect()->route('user.dashboard.UserFile.index')->with('success', 'حذف فایل ذخیره شده با موفقیت انجام شد');
    }

    public function news()
    {
        $news = News::orderBy('updated_at', 'desc')->get();

        return view('user.dashboard.desktop.news.index', compact('news'));
    }

    public function scheduleIndex($type = 'month', Lesson $lesson = null)
    {
        $user = auth()->user();
        if ($user->userMeta->grade_id == null)
            return redirect()->route('user.dashboard.entryPanel.index')->with('error', 'لطفا برای ادامه فرآیند پایه خود را انتخاب بفرمایید');

        if ($type == 'month'){
            $firstOfMonth = Jalalian::now()->getFirstDayOfMonth();
            $endOfMonth = $firstOfMonth->addMonths()->getFirstDayOfMonth();
            $firstOfMonth = $firstOfMonth->subHours($firstOfMonth->getHour())->subMinutes($firstOfMonth->getMinute())->subSeconds($firstOfMonth->getSecond());
            $endOfMonth = $endOfMonth->subHours($endOfMonth->getHour())->subMinutes($endOfMonth->getMinute())->subSeconds($endOfMonth->getSecond())->subSeconds();

            $schedules = Schedule::where('user_id', $user->id)->whereBetween('start_time', [$firstOfMonth->toCarbon(), $endOfMonth->toCarbon()])->orderBy('start_time', 'asc')->get()->groupBy(function($data) {
                return jalaliDate($data->start_time, '%d %B');
            });
        }elseif ($type == 'week'){
            $firstOfWeek = Jalalian::now()->getFirstDayOfWeek();
            $endOfWeek = $firstOfWeek->addDays(7)->getFirstDayOfWeek();
            $firstOfWeek = $firstOfWeek->subHours($firstOfWeek->getHour())->subMinutes($firstOfWeek->getMinute())->subSeconds($firstOfWeek->getSecond());
            $endOfWeek = $endOfWeek->subHours($endOfWeek->getHour())->subMinutes($endOfWeek->getMinute())->subSeconds($endOfWeek->getSecond())->subSeconds();

            $schedules = Schedule::where('user_id', $user->id)->whereBetween('start_time', [$firstOfWeek->toCarbon(), $endOfWeek->toCarbon()])->orderBy('start_time', 'asc')->get()->groupBy(function($data) {
                return jalaliDate($data->start_time, '%d %B');
            });
        }elseif ($type == 'lesson'){
            $schedules = Schedule::where('user_id', $user->id)->whereHas('topic', function ($query) use ($lesson){
                return $query->whereHas('book', function ($q) use ($lesson){
                    return $q->where('lesson_id', $lesson->id);
                });
            })->orderBy('start_time', 'asc')->get()->groupBy(function($data) {
                return jalaliDate($data->start_time, '%d %B');
            });
        }

        $lessons = Lesson::where('grade_id', $user->userMeta->grade_id)->get();

        return view('user.dashboard.desktop.schedule.index', compact('schedules', 'lessons', 'type'));
    }

    public function scheduleStore(Request $request)
    {
        $user = auth()->user();
        $inputs = $request->all();
        $inputs['user_id'] = $user->id;
        $inputs['startTime'] = explode(':', $inputs['startTime']);
        $inputs['endTime'] = explode(':', $inputs['endTime']);
        $realTimestamp = substr($request->date, 0, 10);
        $selectedDate = Jalalian::forge($realTimestamp);
        $selectedDate = $selectedDate->subHours($selectedDate->getHour())->subMinutes($selectedDate->getMinute())->subSeconds($selectedDate->getSecond());
        $startAt = $selectedDate->addHours($inputs['startTime'][0])->addMinutes($inputs['startTime'][1]);
        $endAt = $selectedDate->addHours($inputs['endTime'][0])->addMinutes($inputs['endTime'][1]);
        $inputs['start_time'] = $startAt->toCarbon()->format("Y-m-d H:i:s");
        $inputs['end_time'] = $endAt->toCarbon()->format("Y-m-d H:i:s");
        Schedule::create($inputs);

        return redirect()->route('user.dashboard.schedule.index')->with('success', 'عملیات با موفقیت انجام شد');
    }

    public function scheduleEdit(Schedule $schedule, $type = 'month', Lesson $lesson = null)
    {
        $user = auth()->user();
        if ($user->userMeta->grade_id == null)
            return redirect()->route('user.dashboard.entryPanel.index')->with('error', 'لطفا برای ادامه فرآیند پایه خود را انتخاب بفرمایید');

        if ($type == 'month'){
            $firstOfMonth = Jalalian::now()->getFirstDayOfMonth();
            $endOfMonth = $firstOfMonth->addMonths()->getFirstDayOfMonth();
            $firstOfMonth = $firstOfMonth->subHours($firstOfMonth->getHour())->subMinutes($firstOfMonth->getMinute())->subSeconds($firstOfMonth->getSecond());
            $endOfMonth = $endOfMonth->subHours($endOfMonth->getHour())->subMinutes($endOfMonth->getMinute())->subSeconds($endOfMonth->getSecond())->subSeconds();

            $schedules = Schedule::where('user_id', $user->id)->whereBetween('start_time', [$firstOfMonth->toCarbon(), $endOfMonth->toCarbon()])->orderBy('start_time', 'asc')->get()->groupBy(function($data) {
                return jalaliDate($data->start_time, '%d %B');
            });
        }elseif ($type == 'week'){
            $firstOfWeek = Jalalian::now()->getFirstDayOfWeek();
            $endOfWeek = $firstOfWeek->addDays(7)->getFirstDayOfWeek();
            $firstOfWeek = $firstOfWeek->subHours($firstOfWeek->getHour())->subMinutes($firstOfWeek->getMinute())->subSeconds($firstOfWeek->getSecond());
            $endOfWeek = $endOfWeek->subHours($endOfWeek->getHour())->subMinutes($endOfWeek->getMinute())->subSeconds($endOfWeek->getSecond())->subSeconds();

            $schedules = Schedule::where('user_id', $user->id)->whereBetween('start_time', [$firstOfWeek->toCarbon(), $endOfWeek->toCarbon()])->orderBy('start_time', 'asc')->get()->groupBy(function($data) {
                return jalaliDate($data->start_time, '%d %B');
            });
        }elseif ($type == 'lesson'){
            $schedules = Schedule::where('user_id', $user->id)->whereHas('topic', function ($query) use ($lesson){
                return $query->whereHas('book', function ($q) use ($lesson){
                    return $q->where('lesson_id', $lesson->id);
                });
            })->orderBy('start_time', 'asc')->get()->groupBy(function($data) {
                return jalaliDate($data->start_time, '%d %B');
            });
        }

        $lessons = Lesson::where('grade_id', $user->userMeta->grade_id)->get();

        return view('user.dashboard.desktop.schedule.edit', compact('schedules', 'lessons', 'type', 'schedule'));
    }

    public function scheduleUpdate(Request $request, Schedule $schedule)
    {
        $inputs = $request->all();
        $inputs['startTime'] = explode(':', $inputs['startTime']);
        $inputs['endTime'] = explode(':', $inputs['endTime']);
        $realTimestamp = substr($request->date, 0, 10);
        $selectedDate = Jalalian::forge($realTimestamp);
        $selectedDate = $selectedDate->subHours($selectedDate->getHour())->subMinutes($selectedDate->getMinute())->subSeconds($selectedDate->getSecond());
        $startAt = $selectedDate->addHours($inputs['startTime'][0])->addMinutes($inputs['startTime'][1]);
        $endAt = $selectedDate->addHours($inputs['endTime'][0])->addMinutes($inputs['endTime'][1]);
        $inputs['start_time'] = $startAt->toCarbon()->format("Y-m-d H:i:s");
        $inputs['end_time'] = $endAt->toCarbon()->format("Y-m-d H:i:s");
        $schedule->update($inputs);

        return redirect()->route('user.dashboard.schedule.index')->with('success', 'عملیات با موفقیت انجام شد');
    }

    public function scheduleDestroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('user.dashboard.schedule.index')->with('success', 'عملیات با موفقیت انجام شد');
    }

    public function studyProcess($period = 'day')
    {
        $user = auth()->user();

        if ($period == 'day'){
            $firstOfDay = Jalalian::now();
            $endOfDay = $firstOfDay->addDays();
            $firstOfDay = $firstOfDay->subHours($firstOfDay->getHour())->subMinutes($firstOfDay->getMinute())->subSeconds($firstOfDay->getSecond());
            $endOfDay = $endOfDay->subHours($endOfDay->getHour())->subMinutes($endOfDay->getMinute())->subSeconds($endOfDay->getSecond())->subSeconds();

            $reports = Report::where('user_id', $user->id)->whereBetween('created_at', [$firstOfDay->toCarbon(), $endOfDay->toCarbon()])->get();
        }elseif ($period == 'week'){
            $firstOfWeek = Jalalian::now()->getFirstDayOfWeek();
            $endOfWeek = $firstOfWeek->addDays(7)->getFirstDayOfWeek();
            $firstOfWeek = $firstOfWeek->subHours($firstOfWeek->getHour())->subMinutes($firstOfWeek->getMinute())->subSeconds($firstOfWeek->getSecond());
            $endOfWeek = $endOfWeek->subHours($endOfWeek->getHour())->subMinutes($endOfWeek->getMinute())->subSeconds($endOfWeek->getSecond())->subSeconds();

            $reports = Report::where('user_id', $user->id)->whereBetween('created_at', [$firstOfWeek->toCarbon(), $endOfWeek->toCarbon()])->get();
        }elseif ($period == 'month'){
            $firstOfMonth = Jalalian::now()->getFirstDayOfMonth();
            $endOfMonth = $firstOfMonth->addMonths()->getFirstDayOfMonth();
            $firstOfMonth = $firstOfMonth->subHours($firstOfMonth->getHour())->subMinutes($firstOfMonth->getMinute())->subSeconds($firstOfMonth->getSecond());
            $endOfMonth = $endOfMonth->subHours($endOfMonth->getHour())->subMinutes($endOfMonth->getMinute())->subSeconds($endOfMonth->getSecond())->subSeconds();

            $reports = Report::where('user_id', $user->id)->whereBetween('created_at', [$firstOfMonth->toCarbon(), $endOfMonth->toCarbon()])->get();
        }elseif ($period == 'year'){
            $firstOfYear = Jalalian::now()->getFirstDayOfYear();
            $endOfYear = $firstOfYear->addYears()->getFirstDayOfYear();
            $firstOfYear = $firstOfYear->subHours($firstOfYear->getHour())->subMinutes($firstOfYear->getMinute())->subSeconds($firstOfYear->getSecond());
            $endOfYear = $endOfYear->subHours($endOfYear->getHour())->subMinutes($endOfYear->getMinute())->subSeconds($endOfYear->getSecond())->subSeconds();

            $reports = Report::where('user_id', $user->id)->whereBetween('created_at', [$firstOfYear->toCarbon(), $endOfYear->toCarbon()])->get();
        }
        $morningInterval = $reports->filter(function ($item) {
                $hour = Carbon::parse($item->created_at)->hour;
                return  $hour >= 6 and $hour < 12;
            })->sum('interval') / 60;
        $afternoonInterval = $reports->filter(function ($item) {
                $hour = Carbon::parse($item->created_at)->hour;
                return  $hour >= 12 and $hour < 18;
            })->sum('interval') / 60;
        $nightInterval = $reports->filter(function ($item) {
                $hour = Carbon::parse($item->created_at)->hour;
                return  $hour >= 18 and $hour < 24;
            })->sum('interval') / 60;

        $morningInterval = [$morningInterval];
        $afternoonInterval = [$afternoonInterval];
        $nightInterval = [$nightInterval];

        return view('user.dashboard.desktop.studyProcess.index', compact('morningInterval', 'afternoonInterval', 'nightInterval'));
    }

}
