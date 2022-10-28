<?php

namespace App\Http\Controllers;

use App\book;
use App\DescriptiveTest;
use App\ExamBook;
use Illuminate\Http\Request;

class ExamBookController extends Controller
{

    public function index()
    {       $DescriptiveTest=DescriptiveTest::all();
            $data=ExamBook::all();
            $exam=book::all();
            return view('backEnd.book.indexExam')->with(compact('exam','data','DescriptiveTest'));
    }
    // Modriyat Soalate Testi //

    public function create()
    {

        $book=book::all();
       return  view('backEnd.book.examMultiple')->with(compact('book'));
    }


    public function store(Request $request)
    {
         for ($i=0;$i<count($request->question);$i++){

            $data = [
                'question'=>$request->question[$i],
                'answerOne'=>$request->answerOne[$i],
                'answerTwo'=>$request->answerTwo[$i],
                'answerThree'=>$request->answerThree[$i],
                'answerFour'=>$request->answerFour[$i],
                'True'=>$request->True[$i],
                'book_id'=>$request->book_id,
                'level'=>$request->level,
            ];
             $file = $request->file('image.' . $i);
             if(!empty($file)){
                 $image=$file->getClientOriginalName();
                 $path="upload/examBook/".$image;

                 if (file_exists($path)){
                     $image=bin2hex(random_bytes(4)).$image;
                 }

                 $file->move("upload/examBook/",$image);
                 $data['image'] ="upload/examBook/".$image;
             }
             ExamBook::create($data);
         }
         return redirect()->route('examBook.index');
    }


    public function show(ExamBook $examBook)
    {
        //
    }

    public function edit(ExamBook $examBook)
    {
        //
    }

    public function update(Request $request, ExamBook $examBook)
    {
        //
    }

    public function destroy($examBook)
    {
        $data=book::findOrFAil($examBook)->examBooks()->get();
        foreach ($data as $item){
            ExamBook::destroy($item->id);
        }

        return redirect()->back();
    }
    public function DescriptiveTest(){
        $books=book::all();
        return view('backEnd.book.examDescriptive')->with(compact('books'));
    }
    // Payan Modriyat Soalate Testi //

    // Modriyat Soalate Tashrihi  //
    public function DescriptiveTestStore(Request $request){
        $data=new DescriptiveTest();
        $file=$request->file('document');
        $document=$file->getClientOriginalName();
        $path="upload/Descriptivetest/".$document;
        if (file_exists($path)){
            $document=bin2hex(random_bytes(4)).$document;
        }
        $file->move("upload/Descriptivetest/",$document);
        $data->document=$document;
        $data->title=$request->title;
        $data->level=$request->level;
        $data->book_id=$request->book_id;
        $data->save();
        return redirect()->route('examBook.index');

    }
    public function DescriptiveTestDelete($id){
        $data=book::findOrFAil($id)->DescriptiveTests()->get();
        if (!empty($data)){
            foreach ($data as $item){
                $file=$item->document;
                if (!empty($file)){
                    $path="upload/Descriptivetest/".$file;
                    unlink($path);
                }
                DescriptiveTest::destroy($item->id);


            }
        }
        return redirect()->back();
    }
    // Payan Modriyat Soalate Tashrihi  //
}
