<?php

namespace App\Http\Controllers;

use App\book;
use App\DescriptiveTest;
use App\ExamBook;
use App\TextBook;
use App\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $documents = Document::where('type', $type)->get();
        return view('backEnd.document.index', compact('documents', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        if($type == 1)
            $resources = book::all();
        elseif($type == 2)
            $resources = DescriptiveTest::all();
        elseif($type == 3)
            $resources = ExamBook::all();
        else
            $resources = TextBook::all();
        return view('backEnd.document.create', compact('resources', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type)
    {
        $data['title'] = $request->title;
        $data['documentable_id'] = $request->resource_id;
        $data['type'] = $type;
        if($type == 1)
            $data['documentable_type'] = book::class;
        elseif($type == 2)
            $data['documentable_type'] = DescriptiveTest::class;
        elseif($type == 3)
            $data['documentable_type'] = ExamBook::class;
        else
            $data['documentable_type'] = TextBook::class;

        if($request->hasFile('document')){

            $file = $request->file('document');
            $filename = $file->getClientOriginalName();
            $path = 'upload/document/' . $filename;
            if (file_exists($path)){
                $filename = bin2hex(random_bytes(4)).$filename;
            }
            $file->move('upload/document/', $filename);
            $data['document'] = $path;
        }

        Document::create($data);
        return \redirect()->route('document.index', $type);
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
    public function edit(Document $document)
    {
        if($document->type == 1)
            $resources = book::all();
        elseif($document->type == 2)
            $resources = DescriptiveTest::all();
        elseif($document->type == 3)
            $resources = ExamBook::all();
        else
            $resources = TextBook::all();
        $type = $document->type;

        return view('backEnd.document.edit', compact('resources', 'type', 'document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $data['title'] = $request->title;
        $data['documentable_id'] = $request->resource_id;
        $data['type'] = $type = $document->type;
        if($type == 1)
            $data['documentable_type'] = book::class;
        elseif($type == 2)
            $data['documentable_type'] = DescriptiveTest::class;
        elseif($type == 3)
            $data['documentable_type'] = ExamBook::class;
        else
            $data['documentable_type'] = TextBook::class;

        if($request->hasFile('document')){

            $file = $request->file('document');
            $filename = $file->getClientOriginalName();
            $path = 'upload/document/' . $filename;
            if (file_exists($path)){
                $filename = bin2hex(random_bytes(4)).$filename;
            }
            $file->move('upload/document/', $filename);
            $data['document'] = $path;
        }

        $document->create($data);
        return \redirect()->route('document.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        if (file_exists($document->document))
        {
            unlink($document->document);
        }

        $document->delete();

        return \redirect()->back();
    }

    public function downloadDocument(Document $document)
    {
        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($document->document, 'filename.pdf', $headers);
    }
}
