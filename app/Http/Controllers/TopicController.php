<?php

namespace App\Http\Controllers;

use App\book;
use App\Grade;
use App\Topic;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TopicController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        $topics = Topic::latest()->paginate(20);

        return view('backEnd.book.topic-index', compact( 'grades', 'topics'));
    }

    public function ajaxTopics(Request $request)
    {
        if ($request->ajax()) {

            $data = Topic::with('book', 'book.lesson', 'book.lesson.grade')->get();

            if ($request->get('grade_id')) {
                $grade = $request->get('grade_id');
                $data = $data->where('book.lesson.grade_id', $grade);
            }

            if ($request->get('lesson_id')) {
                $lesson = $request->get('lesson_id');
                $data = $data->where('book.lesson_id', $lesson);
            }

            if ($request->get('session_id')) {
                $session = $request->get('session_id');
                $data = $data->filter(function($d) use ($session) {
                    return strstr($d->book_id, $session) ||
                        strstr($d->book->session, book::findOrFail($session)->session);
                });
            }

            if ($request->get('part_id')) {
                $part = $request->get('part_id');
                $data = $data->where('book_id', $part);
            }

            $dataTable =  Datatables::of($data);

            $dataTable
                ->addColumn('id', function($row){
                    return $row->id;
                })
                ->addColumn('topic', function($row){
                    return $row->title;
                })
                ->addColumn('part', function($row){
                    return $row->book->part;
                })
                ->addColumn('session', function($row){
                    return $row->book->session;
                })
                ->addColumn('lesson', function($row){
                    return $row->book->lesson->title;
                })
                ->addColumn('grade', function($row){
                    return $row->book->lesson->grade->title;
                })
                ->addColumn('action', function($row){
                    return '<span class="d-flex justify-content-center flex-row">
                                                    <a href=" ' . route('topic.edit', $row->id) . '"
                                                       class="btn btn-sm btn-info ml-2">
                                                        <i class="fe fa fe-edit"></i>
                                                    </a>
                                                    <form action=" ' . route('topic.destroy', $row->id) . '" method="post">
                                                    <input type="hidden" name="_method" value="delete">
                                                    <input type="hidden" name="_token" value="' . csrf_token() . '">' . '
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <i class="fe fe-trash"></i>
                                                        </button>
                                                    </form>
                                                </span>';
                })
                ->rawColumns(['action']);

            return $dataTable->make(true);

//                ->filter(function ($instance) use ($request) {
//
//                    if ($request->get('grade_id')) {
//                        $instance->where('book.lesson.grade.title', Grade::findOrFail($request->get('grade_id'))->title);
//                    }

//                    if ($request->get('lesson_id')) {
//
//                        $instance->filter(function ($value, $key) use ($request) {
//                            return $value->book->lesson_id == $request->get('lesson_id');
//                        });
//                    }
//
//                    if ($request->get('session_id')) {
//
//                        $instance->filter(function ($value, $key) use ($request) {
//                            return $value->book->session == book::findOrFail($request->get('session_id'))->session or $value->book_id == $request->get('session_id');
//                        });
//                    }
//
//                    if ($request->get('part_id')) {
//
//                        $instance->filter(function ($value, $key) use ($request) {
//                            return $value->book_id == $request->get('part_id');
//                        });
//                    }
//                })



        }
    }


    public function store(Request $request)
    {
        if ($request->part_id)
            $book = book::findOrFail($request->part_id);
        else
            $book = book::findOrFail($request->session_id);

            for ($i = 0; $i < count($request->topic); $i++) {
                Topic::create([
                    'title' => $request->topic[$i],
                    'book_id' => $book->id
                ]);
            }
            return redirect()->route('topic.index');
    }

    public function edit(Topic $topic)
    {
        $grades = Grade::all();
        $topics = Topic::latest()->paginate(20);

        return view('backEnd.book.topic-edit')->with(compact('topic', 'grades', 'topics'));
    }

    public function update(Request $request, Topic $topic)
    {
        if ($request->part_id)
            $book = book::findOrFail($request->part_id);
        else
            $book = book::findOrFail($request->session_id);

            $topic->update([
                'title' => $request->topic,
                'book_id' => $book->id
            ]);

        return  redirect()->route('topic.index');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('topic.index');
    }
}
