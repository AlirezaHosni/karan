<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Teacher;
use App\UserFile;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    public function file($type, $format=null){
        switch ($type){
            case 'sentFile':
                $files = UserFile::where('type', 0)->get();
                break;
            case 'criticism':
                $files = UserFile::where('type', 1)->get();
                break;
            case 'suggestion':
                $files = UserFile::where('type', 2)->get();
                break;
            case 'question':
                $files = UserFile::where('type', 3)->get();
                break;
            default:
                $files = [];
                $type = 'sentFile';
        }

        if (count($files) > 0)
        switch ($format){
            case null;
                break;
            case 'audio':
                $files = $files->where('type', 0);
                break;
            case 'text':
                $files = $files->where('type', 1);
                break;
            case 'image':
                $files = $files->where('type', 2);
                break;
            default:
                $files = [];
        }

        return view("backEnd.contact.file.index", compact('files', 'type', 'format'));

    }

    public function teacherRate()
    {
        $grades = Grade::all();

        return view('backEnd.contact.teacherRate.index', compact('grades'));
    }

    public function listTeacher(Request $request)
    {
        if ($request->ajax()) {

            $data = Teacher::with('user', 'user.user_meta')->get();

            if ($request->get('grade_id')) {
                $grade = $request->get('grade_id');
                $data = $data->where('user.user_meta.grade_id', $grade);
            }

            $dataTable =  Datatables::of($data);

            $dataTable
                ->addColumn('id', function($row){
                    return $row->id;
                })
                ->addColumn('fullName', function($row){
                    return $row->user->fullName;
                })
                ->addColumn('grade', function($row){
                    return empty($row->user->user_meta->grade) ? '' : $row->user->user_meta->grade->title;
                })
                ->addColumn('rate', function($row){
                    return $row->rate;
                });

            return $dataTable->make(true);
        }
    }

}
