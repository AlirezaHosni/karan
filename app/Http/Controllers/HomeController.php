<?php

namespace App\Http\Controllers;

use App\book;
use App\Exports\UsersExport;
use App\Grade;
use App\Lesson;
use App\Report;
use App\Services\abrarvan\Actions;
use App\Topic;
use App\User;
use App\UserDescriptiveTestAnswer;
use App\UserExamAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $grades = Grade::all();
        $allUsers = User::all()->count();
        $todayRegisteredUser = User::whereDate('created_at', Carbon::today())->get()->count();
        $yesterdayRegisteredUser = User::whereDate('created_at', Carbon::today()->subDay())->get()->count();
        $allActives = Report::whereDate('created_at', Carbon::today()->subMonth())->distinct('user_id')->get()->count();
        $todayActives = Report::whereDate('created_at', Carbon::today())->distinct('user_id')->get()->count();
        $yesterdayActives = Report::whereDate('created_at', Carbon::today()->subDay())->distinct('user_id')->get()->count();

        return view('backEnd.home',
            compact(
                'grades', 'allUsers', 'todayRegisteredUser', 'yesterdayRegisteredUser',
                'allActives', 'todayActives', 'yesterdayActives'
            ));
    }

    public function listUsers(Request $request)
    {
        if ($request->ajax()) {

            $data = User::with('userMeta', 'userMeta.grade', 'userMeta.identifier.user')->latest()->get();
            session()->put('homeUsers', $data);

            if (!empty($request->get('grade_id'))) {
                $grade = $request->get('grade_id');
                $data = $data->where('userMeta.grade_id', $grade);
                session()->put('homeUsers', $data);
            }

            $dataTable = Datatables::of($data);

            $dataTable
                ->addColumn('id', function ($row) {
                    return $row->id;
                })
                ->addColumn('created_at', function ($row) {
                    return jalaliDate($row->created_at, "%Y / %m / %d");
                })
                ->addColumn('fullName', function ($row) {
                    return $row->fullName;
                })
                ->addColumn('identifier', function ($row) {
                    return empty($row->userMeta->identifier) ? '' : $row->userMeta->identifier->fullName;
                })
                ->addColumn('national_code', function ($row) {
                    return $row->national_code;
                })
                ->addColumn('phoneNumber', function ($row) {
                    return $row->phoneNumber;
                })
                ->addColumn('parent_phoneNumber', function ($row) {
                    return $row->userMeta->parent_phoneNumber;
                })
                ->addColumn('province', function ($row) {
                    return $row->userMeta->province;
                })
                ->addColumn('city', function ($row) {
                    return $row->userMeta->city;
                })
                ->addColumn('status', function ($row) {
//                    if ($row->gender == 0)
//                        return  '<i class="fa fa-close text-danger fs-1"></i>
//                                   <span class="label text-muted d-flex"></span>
//                                 ';
//                    else
//                        return
//                            '<i class="fa fa-check"></i>
//                               <span class="label text-muted d-flex"></span>
//                            ';
                    if ($row->gender == 0)
                        return  'غیر فعال';
                    else
                        return 'فعال';
                })
                ->addColumn('action', function($row){
                    return '<span class="d-flex justify-content-center flex-row">
                                                    <a href=" ' . route('userManagement.edit', $row->id) . '"
                                                       class="btn btn-sm btn-info ml-2">
                                                        <i class="fe fa fe-edit"></i>
                                                    </a>
                                                    <form action=" ' . route('userManagement.destroy', $row->id) . '" method="post">
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


    public function searchLessons(Request $request)
    {
        if (!empty($request->grade_id))
            return response()->json(Lesson::where('grade_id', $request->grade_id)->get());
    }

    public function searchSessions(Request $request)
    {
        if (!empty($request->lesson_id))
            return response()->json(book::where('lesson_id', $request->lesson_id)->where('part', null)->get());
    }

    public function searchParts(Request $request)
    {
        if (!empty($request->session_id)){
            $session = book::find($request->session_id);
            return response()->json(book::where('session', 'like', "%$session->session%")->where('lesson_id', $session->lesson_id)->whereNotNull('part')->get());
        }
    }

    public function searchTopics(Request $request)
    {
        if (!empty($request->part_id))
            return response()->json(Topic::where('book_id', $request->part_id)->get());
    }

    public function excel()
    {
        return Excel::download(new UsersExport('backEnd.tables.home-table', session()->get('homeUsers')), 'users.xlsx');
    }
}
