<?php

namespace App\Http\Controllers;

use App\book;
use App\Grade;
use App\Lesson;
use App\Services\abrarvan\Actions;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookController extends Controller
{

    public function index()
    {
        $books = book::whereNull('part')->get();
        $grades = Grade::all();
        $lesson = Lesson::all();
        return view('backEnd.book.index')->with(compact('books', 'grades', 'lesson'));
    }

    public function indexPart()
    {
        $grades = Grade::all();

        return view('backEnd.book.index-part')->with(compact( 'grades'));
    }

    public function ajaxParts(Request $request)
    {
        if ($request->ajax()) {

            $data = book::with('lesson', 'lesson.grade')->whereNotNull('part')->get();

            if ($request->get('grade_id')) {
                $grade = $request->get('grade_id');
                $data = $data->where('lesson.grade_id', $grade);
            }

            if ($request->get('lesson_id')) {
                $lesson = $request->get('lesson_id');
                $data = $data->where('lesson_id', $lesson);
            }

            if ($request->get('session_id')) {
                $session = $request->get('session_id');
                $sessionObj = book::findOrFail($session);
                $data = $data->where('session', $sessionObj->session)
                    ->where('lesson_id', $sessionObj->lesson_id)
                    ->whereNotNull('part');
            }

            $dataTable =  Datatables::of($data);

            $dataTable
                ->addColumn('id', function($row){
                    return $row->id;
                })
                ->addColumn('part', function($row){
                    return $row->part;
                })
                ->addColumn('session', function($row){
                    return $row->session;
                })
//                ->addColumn('lesson', function($row){
//                    return $row->lesson->title;
//                })
                ->addColumn('grade', function($row){
                    return $row->lesson->grade->title;
                })
                ->addColumn('action', function($row){
                    return '<span class="d-flex justify-content-center flex-row">
                                                    <a href=" ' . route('book-part.edit', $row->id) . '"
                                                       class="btn btn-sm btn-info ml-2">
                                                        <i class="fe fa fe-edit"></i>
                                                    </a>
                                                    <form action=" ' . route('book-part.destroy', $row->id) . '" method="post">
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
        }
    }

    public function create()
    {
        $grades=Grade::all();

        return view('backEnd.book.create')->with(compact('grades'));
    }

    public function store(Request $request)
    {
        $book=new book();
        $book->session=$request->session;
        $book->part=$request->part;
        $book->lesson_id=$request->lesson_id;
        $file=$request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path="upload/book/".$image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)).$image;
        }

        $file->move("upload/book/",$image);
        $book->image ="upload/book/".$image;
        }
        $book->save();
        return  redirect()->route('book.index');
    }

    public function storePart(Request $request)
    {
        if ($request->part){
            $book=new book();
            $sessionBook = book::findOrFail($request->session);
            $book->session = $sessionBook->session;
            $book->part=$request->part;
            $book->lesson_id=$request->lesson_id;
            $book->save();
        }

        return  redirect()->route('book-part.index');
    }


    public function show($book)
    {
        $books=book::findOrFail($book);
        $exam=book::findOrFail($book)->examBooks()->get();
        return view('backEnd.book.showExam')->with(compact('exam','books'));

    }

    public function edit(book $book)
    {
        $lesson = Lesson::all();
        $grades = Grade::all();
        $books = book::where('part', null)->get();

        return view('backEnd.book.edit')->with(compact('lesson', 'book', 'grades', 'books'));
    }

    public function editPart(book $part)
    {
        $grades = Grade::all();

        return view('backEnd.book.edit-part')->with(compact( 'grades', 'part'));

    }

    public function update(Request $request, book $book)
    {
        $books = book::where('session', 'like', "%$book->session%")->get();
        foreach($books as $item){
            $item->session = $request->session;
            $item->save();
        }
        $book->session=$request->session;
        $book->part=$request->part;
        $book->lesson_id=$request->lesson_id;
        $file=$request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path="upload/book/".$image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)).$image;
            }

            if ($book->image)
                unlink($book->image);

            $file->move("upload/book/",$image);
            $book->image ="upload/book/".$image;
        }
        $book->save();
        return  redirect()->route('book.index');
    }

    public function updatePart(Request $request, book $part)
    {
        $sessionBook = book::findOrFail($request->session);
        $part->session = $sessionBook->session;
        $part->part = $request->part;
        $part->lesson_id = $request->lesson_id;
        $part->save();

        return  redirect()->route('book-part.index');
    }

    public function destroy(book $book)
    {
        foreach ($book->topics as $topic){
            $topic->delete();
        }
        $book->delete();
        return redirect()->route('book.index');
    }

    public function destroyPart(book $part)
    {
        $part->delete();

        return redirect()->route('book-part.index');
    }

    public function search(Request $request){

          $lesson=Grade::findOrFail($request->id)->lessons()->get();
          return view('backEnd.book.create')->with(compact('lesson'));

    }
}
