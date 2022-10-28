<?php

namespace App\Http\Controllers;

use App\TextBook;
use App\Video;
use App\book;
use App\ExamBook;
use App\DescriptiveTest;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $videos = Video::where('type', $type)->get();
        return view('backEnd.video.index', compact('videos', 'type'));
    }


    public function selectType()
    {
        return view('backEnd.video.video-type');
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
        return view('backEnd.video.create', compact('resources', 'type'));
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
        $data['videoable_id'] = $request->resource_id;
        $data['type'] = $type;
        if($type == 1)
            $data['videoable_type'] = book::class;
        elseif($type == 2)
            $data['videoable_type'] = DescriptiveTest::class;
        elseif($type == 3)
            $data['videoable_type'] = ExamBook::class;
        else
            $data['videoable_type'] = TextBook::class;

        if($request->hasFile('video')){

            $file = $request->file('video');
            $filename = $file->getClientOriginalName();
            $path = 'upload/video/' . $filename;
            if (file_exists($path)){
                $filename = bin2hex(random_bytes(4)).$filename;
            }
            $file->move('upload/video/', $filename);
            $data['video'] = $path;
        }

        Video::create($data);
        return \redirect()->route('video.index', $type);
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
    public function edit(Video $video, Request $request)
    {
        if($video->type == 1)
            $resources = book::all();
        elseif($video->type == 2)
            $resources = DescriptiveTest::all();
        elseif($video->type == 3)
            $resources = ExamBook::all();
        else
            $resources = TextBook::all();
        $type = $video->type;

        return view('backEnd.video.edit', compact('resources', 'type', 'video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $data['title'] = $request->title;
        $data['videoable_id'] = $request->resource_id;
        $data['type'] = $type = $video->type;
        if($type == 1)
            $data['videoable_type'] = book::class;
        elseif($type == 2)
            $data['videoable_type'] = DescriptiveTest::class;
        elseif($type == 3)
            $data['videoable_type'] = ExamBook::class;
        else
            $data['videoable_type'] = TextBook::class;

        if($request->hasFile('video')){

            $file = $request->file('video');
            $filename = $file->getClientOriginalName();
            $path = 'upload/video/' . $filename;
            if (file_exists($path)){
                $filename = bin2hex(random_bytes(4)).$filename;
            }
            $file->move('upload/video/', $filename);
            $data['video'] = $path;
        }

        $video->create($data);
        return \redirect()->route('video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        if (file_exists($video->video))
        {
            unlink($video->video);
        }
        $video->delete();

        return \redirect()->back();
    }
}
