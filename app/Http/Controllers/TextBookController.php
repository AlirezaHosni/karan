<?php

namespace App\Http\Controllers;

use App\book;
use App\TextBook;
use Illuminate\Http\Request;

class TextBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $textBooks = TextBook::all();
        return view('backEnd.textBook.index', compact('textBooks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = book::all();
        return view('backEnd.textBook.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $file = $request->file('image');
        if(!empty($file)){
            $image=$file->getClientOriginalName();
            $path="upload/textbook/".$image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)).$image;
            }

            $file->move("upload/grade/",$image);
            $data['image'] ="upload/book/".$image;
        };
        TextBook::create($data);
        return redirect()->route('textBook.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TextBook $textBook)
    {
        $books = book::all();
        return view('backEnd.textBook.edit', compact('books', 'textBook'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TextBook $textBook)
    {
        $data = $request->all();
        $file = $request->file('image');
        if(!empty($file)){
            if ($textBook->image) {
                unlink($textBook->image);
                $textBook->image = '';
            }
            $image=$file->getClientOriginalName();
            $path="upload/textbook/".$image;

            if (file_exists($path)){
                $image=bin2hex(random_bytes(4)).$image;
            }

            $file->move("upload/grade/",$image);
            $data['image'] ="upload/book/".$image;
        }
        $textBook->update($data);
        return redirect()->route('textBook.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TextBook $textBook)
    {
        if ($textBook->image)
            unlink($textBook->image);
        $textBook->delete();
        return redirect()->route('textBook.index');
    }
}
