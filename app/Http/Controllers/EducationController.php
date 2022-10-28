<?php

namespace App\Http\Controllers;

use App\Appendices;
use App\book;
use App\BooksExercise;
use App\DescriptiveTestAttachment;
use App\Document;
use App\ExamBook;
use App\ExamBookAttachment;
use App\ExamQuestionSample;
use App\Grade;
use App\IntroduceBook;
use App\KaranBala;
use App\Lesson;
use App\TextBook;
use App\Topic;
use App\Video;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function textBookAttachmentsIndex()
    {
        $videos = Video::where('videoable_type', TextBook::class)->get();
        $documents = Document::where('documentable_type', TextBook::class)->get();
        $grades = Grade::all();
        return view('backEnd.education.attachments.textBook.index', compact('videos', 'documents', 'grades'));

    }

    public function textBookAttachmentsStore(Request $request)
    {
        $topic = Topic::findOrFail($request->topic_id);
        for ($i=0;$i<count($request->file('attachments'));$i++){
            $textBook = TextBook::create([
                'topic_id' => $topic->id,
                'title' => $topic->title
            ]);
            if ($request->file('attachments.'.$i)->extension() == 'pdf'){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                Document::create([
                    'documentable_type' => TextBook::class,
                    'documentable_id' => $textBook->id,
                    'title' => $topic->title,
                    'document' => $path
                ]);
            }elseif(in_array(strtoupper($request->file('attachments.'.$i)->extension()), ['MP4', 'MOV', 'AVI', 'FLV', 'MKV', 'MKV', 'WMV', 'AVCHD', 'WEBM'])){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                Video::create([
                    'videoable_type' => TextBook::class,
                    'videoable_id' => $textBook->id,
                    'title' => $topic->title,
                    'video' => $path
                ]);
            }
        }
        return redirect()->route('education.textBookAttachmentsIndex')->with('success', 'ایجاد فایل با موفقیت انجام شد');
    }

    public function textBookAttachmentsEdit(TextBook $textBook)
    {
        $videos = Video::where('videoable_type', TextBook::class)->get();
        $documents = Document::where('documentable_type', TextBook::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.textBook.edit', compact('videos', 'documents', 'grades', 'textBook'));
    }

    public function textBookAttachmentsUpdate(Request $request, TextBook $textBook)
    {
        $topic = Topic::findOrFail($request->topic_id);
        $textBook->update([
            'title' => $topic->title,
            'topic_id' => $topic->id
        ]);
        if ($request->hasFile('attachments')){
            if ($request->file('attachments')->extension() == 'pdf'){
                $document = Document::where('documentable_type', TextBook::class)->where('documentable_id', $textBook->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                if (count($document) > 0){
                    if (file_exists($document->document))
                        unlink($document->document);

                    $document->update([
                        'title' => $topic->title,
                        'document' => $path
                    ]);
                }else{
                    if (file_exists($textBook->video->video))
                        unlink($textBook->video->video);
                    $textBook->video()->delete();

                    Document::create([
                        'documentable_type' => TextBook::class,
                        'documentable_id' => $textBook->id,
                        'title' => $topic->title,
                        'document' => $path
                    ]);
                }
            }else{
                $video = Video::where('videoable_type', TextBook::class)->where('videoable_id', $textBook->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                if (count($video) > 0){
                    if (file_exists($video->video))
                        unlink($video->video);

                    $video->update([
                        'title' => $topic->title,
                        'video' => $path
                    ]);
                }else{
                    if (file_exists($textBook->document->document))
                        unlink($textBook->document->document);
                    $textBook->document()->delete();

                    Video::create([
                        'videoable_type' => TextBook::class,
                        'videoable_id' => $textBook->id,
                        'title' => $topic->title,
                        'video' => $path
                    ]);
                }
            }
        }
        return redirect()->route('education.textBookAttachmentsIndex')->with('success', 'ویرایش فایل با موفقیت انجام شد');
    }

    public function textBookAttachmentsDestroy(TextBook $textBook)
    {
        if ($textBook->video){
            if (file_exists($textBook->video->video))
                unlink($textBook->video->video);
            $textBook->video()->delete();
        }
        if ($textBook->document){
            if (file_exists($textBook->document->document))
                unlink($textBook->document->document);
            $textBook->document()->delete();
        }

        $textBook->delete();

        return redirect()->route('education.textBookAttachmentsIndex')->with('success', 'حذف فایل با موفقیت انجام شد');
    }

    public function karanBalaAttachmentsIndex()
    {
        $videos = Video::where('videoable_type', KaranBala::class)->get();
        $documents = Document::where('documentable_type', KaranBala::class)->get();
        $grades = Grade::all();
        return view('backEnd.education.attachments.karanbala.index', compact('videos', 'documents', 'grades'));

    }

    public function karanBalaAttachmentsStore(Request $request)
    {
        $topic = Topic::findOrFail($request->topic_id);
        for ($i=0;$i<count($request->file('attachments'));$i++){
            $karanBala = KaranBala::create([
                'topic_id' => $topic->id,
                'title' => $topic->title
            ]);
            if ($request->file('attachments.'.$i)->extension() == 'pdf'){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                Document::create([
                    'documentable_type' => KaranBala::class,
                    'documentable_id' => $karanBala->id,
                    'title' => $topic->title,
                    'document' => $path
                ]);
            }elseif(in_array(strtoupper($request->file('attachments.'.$i)->extension()), ['MP4', 'MOV', 'AVI', 'FLV', 'MKV', 'MKV', 'WMV', 'AVCHD', 'WEBM'])){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                Video::create([
                    'videoable_type' => KaranBala::class,
                    'videoable_id' => $karanBala->id,
                    'title' => $topic->title,
                    'video' => $path
                ]);
            }
        }
        return redirect()->route('education.karanBalaAttachmentsIndex')->with('success', 'ایجاد فایل با موفقیت انجام شد');
    }

    public function karanBalaAttachmentsEdit(KaranBala $karanBala)
    {
        $videos = Video::where('videoable_type', KaranBala::class)->get();
        $documents = Document::where('documentable_type', KaranBala::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.karanbala.edit', compact('videos', 'documents', 'grades', 'karanBala'));
    }

    public function karanBalaAttachmentsUpdate(Request $request, KaranBala $karanBala)
    {
        $topic = Topic::findOrFail($request->topic_id);
        $karanBala->update([
            'title' => $topic->title,
            'topic_id' => $topic->id
        ]);
        if ($request->hasFile('attachments')){
            if ($request->file('attachments')->extension() == 'pdf'){
                $document = Document::where('documentable_type', KaranBala::class)->where('documentable_id', $karanBala->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                if (count($document) > 0){
                    if (file_exists($document->document))
                        unlink($document->document);

                    $document->update([
                        'title' => $topic->title,
                        'document' => $path
                    ]);
                }else{
                    if (file_exists($karanBala->video->video))
                        unlink($karanBala->video->video);
                    $karanBala->video()->delete();

                    Document::create([
                        'documentable_type' => KaranBala::class,
                        'documentable_id' => $karanBala->id,
                        'title' => $topic->title,
                        'document' => $path
                    ]);
                }
            }else{
                $video = Video::where('videoable_type', KaranBala::class)->where('videoable_id', $karanBala->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                if (count($video) > 0){
                    if (file_exists($video->video))
                        unlink($video->video);

                    $video->update([
                        'title' => $topic->title,
                        'video' => $path
                    ]);
                }else{
                    if (file_exists($karanBala->document->document))
                        unlink($karanBala->document->document);
                    $karanBala->document()->delete();

                    Video::create([
                        'videoable_type' => KaranBala::class,
                        'videoable_id' => $karanBala->id,
                        'title' => $topic->title,
                        'video' => $path
                    ]);
                }
            }
        }
        return redirect()->route('education.karanBalaAttachmentsIndex')->with('success', 'ویرایش فایل با موفقیت انجام شد');
    }

    public function karanBalaAttachmentsDestroy(KaranBala $karanBala)
    {
        if ($karanBala->video){
            if (file_exists($karanBala->video->video))
                unlink($karanBala->video->video);
            $karanBala->video()->delete();
        }
        if ($karanBala->document){
            if (file_exists($karanBala->document->document))
                unlink($karanBala->document->document);
            $karanBala->document()->delete();
        }

        $karanBala->delete();

        return redirect()->route('education.karanBalaAttachmentsIndex')->with('success', 'حذف فایل با موفقیت انجام شد');
    }

    public function examBookAttachmentsIndex()
    {
        $videos = Video::where('videoable_type', ExamBookAttachment::class)->get();
        $documents = Document::where('documentable_type', ExamBookAttachment::class)->get();
        $grades = Grade::all();
        return view('backEnd.education.attachments.examBook.index', compact('videos', 'documents', 'grades'));
    }

    public function examBookAttachmentsStore(Request $request)
    {
        $topic = Topic::findOrFail($request->topic_id);
        for ($i=0;$i<count($request->file('attachments'));$i++){
            $examBook = ExamBookAttachment::create([
                'topic_id' => $topic->id,
                'title' => $topic->title
            ]);
            if ($request->file('attachments.'.$i)->extension() == 'pdf'){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                Document::create([
                    'documentable_type' => ExamBookAttachment::class,
                    'documentable_id' => $examBook->id,
                    'title' => $topic->title,
                    'document' => $path
                ]);
            }elseif(in_array(strtoupper($request->file('attachments.'.$i)->extension()), ['MP4', 'MOV', 'AVI', 'FLV', 'MKV', 'MKV', 'WMV', 'AVCHD', 'WEBM'])){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                Video::create([
                    'videoable_type' => ExamBookAttachment::class,
                    'videoable_id' => $examBook->id,
                    'title' => $topic->title,
                    'video' => $path
                ]);
            }
        }
        return redirect()->route('education.examBookAttachmentsIndex')->with('success', 'ایجاد فایل با موفقیت انجام شد');
    }

    public function examBookAttachmentsEdit(ExamBookAttachment $examBook)
    {
        $videos = Video::where('videoable_type', ExamBookAttachment::class)->get();
        $documents = Document::where('documentable_type', ExamBookAttachment::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.examBook.edit', compact('videos', 'documents', 'grades', 'examBook'));
    }

    public function examBookAttachmentsUpdate(Request $request, ExamBookAttachment $examBook)
    {
        $topic = Topic::findOrFail($request->topic_id);
        $examBook->update([
            'title' => $topic->title,
            'topic_id' => $topic->id
        ]);
        if ($request->hasFile('attachments')){
            if ($request->file('attachments')->extension() == 'pdf'){
                $document = Document::where('documentable_type', ExamBookAttachment::class)->where('documentable_id', $examBook->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                if (count($document) > 0){
                    if (file_exists($document->document))
                        unlink($document->document);

                    $document->update([
                        'title' => $topic->title,
                        'document' => $path
                    ]);
                }else{
                    if (file_exists($examBook->video->video))
                        unlink($examBook->video->video);
                    $examBook->video()->delete();

                    Document::create([
                        'documentable_type' => ExamBookAttachment::class,
                        'documentable_id' => $examBook->id,
                        'title' => $topic->title,
                        'document' => $path
                    ]);
                }
            }else{
                $video = Video::where('videoable_type', ExamBookAttachment::class)->where('videoable_id', $examBook->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                if (count($video) > 0){
                    if (file_exists($video->video))
                        unlink($video->video);

                    $video->update([
                        'title' => $topic->title,
                        'video' => $path
                    ]);
                }else{
                    if (file_exists($examBook->document->document))
                        unlink($examBook->document->document);
                    $examBook->document()->delete();

                    Video::create([
                        'videoable_type' => ExamBookAttachment::class,
                        'videoable_id' => $examBook->id,
                        'title' => $topic->title,
                        'video' => $path
                    ]);
                }
            }
        }
        return redirect()->route('education.examBookAttachmentsIndex')->with('success', 'ویرایش فایل با موفقیت انجام شد');
    }

    public function examBookAttachmentsDestroy(ExamBookAttachment $examBook)
    {
        if ($examBook->video){
            if (file_exists($examBook->video->video))
                unlink($examBook->video->video);
            $examBook->video()->delete();
        }
        if ($examBook->document){
            if (file_exists($examBook->document->document))
                unlink($examBook->document->document);
            $examBook->document()->delete();
        }

        $examBook->delete();

        return redirect()->route('education.examBookAttachmentsIndex')->with('success', 'حذف فایل با موفقیت انجام شد');
    }

    public function descriptiveTestAttachmentsIndex()
    {
        $videos = Video::where('videoable_type', DescriptiveTestAttachment::class)->get();
        $documents = Document::where('documentable_type', DescriptiveTestAttachment::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.descriptiveTest.index', compact('videos', 'documents', 'grades'));
    }

    public function descriptiveTestAttachmentsStore(Request $request)
    {
        $topic = Topic::findOrFail($request->topic_id);
        for ($i=0;$i<count($request->file('attachments'));$i++){
            $descriptiveTest = DescriptiveTestAttachment::create([
                'topic_id' => $topic->id,
                'title' => $topic->title
            ]);
            if ($request->file('attachments.'.$i)->extension() == 'pdf'){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                Document::create([
                    'documentable_type' => DescriptiveTestAttachment::class,
                    'documentable_id' => $descriptiveTest->id,
                    'title' => $topic->title,
                    'document' => $path
                ]);
            }elseif(in_array(strtoupper($request->file('attachments.'.$i)->extension()), ['MP4', 'MOV', 'AVI', 'FLV', 'MKV', 'MKV', 'WMV', 'AVCHD', 'WEBM'])){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                Video::create([
                    'videoable_type' => DescriptiveTestAttachment::class,
                    'videoable_id' => $descriptiveTest->id,
                    'title' => $topic->title,
                    'video' => $path
                ]);
            }
        }
        return redirect()->route('education.descriptiveTestAttachmentsIndex')->with('success', 'ایجاد فایل با موفقیت انجام شد');
    }

    public function descriptiveTestAttachmentsEdit(DescriptiveTestAttachment $descriptiveTest)
    {
        $videos = Video::where('videoable_type', DescriptiveTestAttachment::class)->get();
        $documents = Document::where('documentable_type', DescriptiveTestAttachment::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.descriptiveTest.edit', compact('videos', 'documents', 'grades', 'descriptiveTest'));
    }

    public function descriptiveTestAttachmentsUpdate(Request $request, DescriptiveTestAttachment $descriptiveTest)
    {
        $topic = Topic::findOrFail($request->topic_id);
        $descriptiveTest->update([
            'title' => $topic->title,
            'topic_id' => $topic->id
        ]);
        if ($request->hasFile('attachments')){
            if ($request->file('attachments')->extension() == 'pdf'){
                $document = Document::where('documentable_type', DescriptiveTestAttachment::class)->where('documentable_id', $descriptiveTest->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                if (count($document) > 0){
                    if (file_exists($document->document))
                        unlink($document->document);

                    $document->update([
                        'title' => $topic->title,
                        'document' => $path
                    ]);
                }else{
                    if (file_exists($descriptiveTest->video->video))
                        unlink($descriptiveTest->video->video);
                    $descriptiveTest->video()->delete();

                    Document::create([
                        'documentable_type' => DescriptiveTestAttachment::class,
                        'documentable_id' => $descriptiveTest->id,
                        'title' => $topic->title,
                        'document' => $path
                    ]);
                }
            }else{
                $video = Video::where('videoable_type', DescriptiveTestAttachment::class)->where('videoable_id', $descriptiveTest->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                if (count($video) > 0){
                    if (file_exists($video->video))
                        unlink($video->video);

                    $video->update([
                        'title' => $topic->title,
                        'video' => $path
                    ]);
                }else{
                    if (file_exists($descriptiveTest->document->document))
                        unlink($descriptiveTest->document->document);
                    $descriptiveTest->document()->delete();

                    Video::create([
                        'videoable_type' => DescriptiveTestAttachment::class,
                        'videoable_id' => $descriptiveTest->id,
                        'title' => $topic->title,
                        'video' => $path
                    ]);
                }
            }
        }
        return redirect()->route('education.descriptiveTestAttachmentsIndex')->with('success', 'ویرایش فایل با موفقیت انجام شد');
    }

    public function descriptiveTestAttachmentsDestroy(DescriptiveTestAttachment $descriptiveTest)
    {
        if ($descriptiveTest->video){
            if (file_exists($descriptiveTest->video->video))
                unlink($descriptiveTest->video->video);
            $descriptiveTest->video()->delete();
        }
        if ($descriptiveTest->document){
            if (file_exists($descriptiveTest->document->document))
                unlink($descriptiveTest->document->document);
            $descriptiveTest->document()->delete();
        }

        $descriptiveTest->delete();

        return redirect()->route('education.descriptiveTestAttachmentsIndex')->with('success', 'حذف فایل با موفقیت انجام شد');
    }

    public function IntroduceBookAttachmentsIndex()
    {
        $videos = Video::where('videoable_type', IntroduceBook::class)->get();
        $documents = Document::where('documentable_type', IntroduceBook::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.lesson.index', compact('videos', 'documents', 'grades'));
    }

    public function IntroduceBookAttachmentsStore(Request $request)
    {
        $lesson = Lesson::findOrFail($request->lesson_id);
        for ($i=0;$i<count($request->file('attachments'));$i++){
            $introduceBook = IntroduceBook::create([
                'lesson_id' => $lesson->id,
                'type' => $request->type
            ]);
            if ($request->file('attachments.'.$i)->extension() == 'pdf'){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)) . $filename;
                }

                $file->move('upload/document/', $filename);

                Document::create([
                    'documentable_type' => IntroduceBook::class,
                    'documentable_id' => $introduceBook->id,
                    'title' => $lesson->title,
                    'document' => $path
                ]);
            }elseif(in_array(strtoupper($request->file('attachments.'.$i)->extension()), ['MP4', 'MOV', 'AVI', 'FLV', 'MKV', 'MKV', 'WMV', 'AVCHD', 'WEBM'])){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)) . $filename;
                }

                $file->move('upload/video/', $filename);

                Video::create([
                    'videoable_type' => IntroduceBook::class,
                    'videoable_id' => $introduceBook->id,
                    'title' => $lesson->title,
                    'video' => $path
                ]);
            }
        }
        return redirect()->route('education.IntroduceBookAttachmentsIndex')->with('success', 'ایجاد فایل با موفقیت انجام شد');
    }

    public function IntroduceBookAttachmentsEdit(IntroduceBook $introduceBook)
    {
        $videos = Video::where('videoable_type', IntroduceBook::class)->get();
        $documents = Document::where('documentable_type', IntroduceBook::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.lesson.edit', compact('videos', 'documents', 'grades', 'introduceBook'));
    }

    public function IntroduceBookAttachmentsUpdate(Request $request, IntroduceBook $introduceBook)
    {
        $lesson = Lesson::findOrFail($request->lesson_id);
            $introduceBook->update([
                'lesson_id' => $lesson->id,
                'type' => $request->type
            ]);
            if ($request->hasFile('attachments')){
                if ($request->file('attachments')->extension() == 'pdf'){
                    $document = Document::where('documentable_type', IntroduceBook::class)->where('documentable_id', $introduceBook->id)->get();
                    $file = $request->file('attachments');
                    $filename = $file->getClientOriginalName();
                    $path = 'upload/document/' . $filename;

                    if (file_exists($path)){
                        $filename = bin2hex(random_bytes(4)) . $filename;
                    }

                    $file->move('upload/document/', $filename);
                    if (count($document) > 0){
                        if (file_exists($document->document))
                            unlink($document->document);

                        $document->update([
                            'title' => $lesson->title,
                            'document' => $path
                        ]);
                    }else{
                        if (file_exists($introduceBook->video->video))
                            unlink($introduceBook->video->video);
                        $introduceBook->video()->delete();

                        Document::create([
                            'documentable_type' => IntroduceBook::class,
                            'documentable_id' => $introduceBook->id,
                            'title' => $lesson->title,
                            'document' => $path
                        ]);
                    }
                }elseif(in_array(strtoupper($request->file('attachments')->extension()), ['MP4', 'MOV', 'AVI', 'FLV', 'MKV', 'MKV', 'WMV', 'AVCHD', 'WEBM'])){
                    $video = Video::where('videoable_type', IntroduceBook::class)->where('videoable_id', $introduceBook->id)->get();
                    $file = $request->file('attachments');
                    $filename = $file->getClientOriginalName();
                    $path = 'upload/video/' . $filename;

                    if (file_exists($path)){
                        $filename = bin2hex(random_bytes(4)) . $filename;
                    }

                    $file->move('upload/video/', $filename);

                    if (count($video) > 0){
                        if (file_exists($video->video))
                            unlink($video->video);

                        $video->update([
                            'title' => $lesson->title,
                            'video' => $path
                        ]);
                    }else{
                        if (file_exists($introduceBook->document->document))
                            unlink($introduceBook->document->document);
                        $introduceBook->document()->delete();

                        Video::create([
                            'videoable_type' => IntroduceBook::class,
                            'videoable_id' => $introduceBook->id,
                            'title' => $lesson->title,
                            'video' => $path
                        ]);
                    }
                }

            }
            return redirect()->route('education.IntroduceBookAttachmentsIndex')->with('success', 'ویرایش فایل با موفقیت انجام شد');
    }


    public function IntroduceBookAttachmentsDestroy(IntroduceBook $introduceBook)
    {
        if ($introduceBook->video){
            if (file_exists($introduceBook->video->video))
                unlink($introduceBook->video->video);
            $introduceBook->video()->delete();
        }
        if ($introduceBook->document){
            if (file_exists($introduceBook->document->document))
                unlink($introduceBook->document->document);
            $introduceBook->document()->delete();
        }

        $introduceBook->delete();

        return redirect()->route('education.IntroduceBookAttachmentsIndex')->with('success', 'حذف فایل با موفقیت انجام شد');
    }

    public function booksExerciseAttachmentsIndex()
    {
        $videos = Video::where('videoable_type', BooksExercise::class)->get();
        $documents = Document::where('documentable_type', BooksExercise::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.booksExercise.index', compact('videos', 'documents', 'grades'));
    }

    public function booksExerciseAttachmentsStore(Request $request)
    {
        $session = book::findOrFail($request->session_id);
        for ($i=0;$i<count($request->file('attachments'));$i++){
            $booksExercise = BooksExercise::create([
                'book_id' => $session->id,
                'title' => $session->session,
            ]);
            if ($request->file('attachments.'.$i)->extension() == 'pdf'){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                Document::create([
                    'documentable_type' => BooksExercise::class,
                    'documentable_id' => $booksExercise->id,
                    'title' => $session->session,
                    'document' => $path
                ]);
            }elseif(in_array(strtoupper($request->file('attachments.'.$i)->extension()), ['MP4', 'MOV', 'AVI', 'FLV', 'MKV', 'MKV', 'WMV', 'AVCHD', 'WEBM'])){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                Video::create([
                    'videoable_type' => BooksExercise::class,
                    'videoable_id' => $booksExercise->id,
                    'title' => $session->session,
                    'video' => $path
                ]);
            }
        }
        return redirect()->route('education.booksExercisesAttachmentsIndex')->with('success', 'ایجاد فایل با موفقیت انجام شد');
    }

    public function booksExerciseAttachmentsEdit(BooksExercise $booksExercise)
    {
        $videos = Video::where('videoable_type', BooksExercise::class)->get();
        $documents = Document::where('documentable_type', BooksExercise::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.booksExercise.edit', compact('videos', 'documents', 'grades', 'booksExercise'));
    }

    public function booksExerciseAttachmentsUpdate(Request $request, BooksExercise $booksExercise)
    {
        $session = book::findOrFail($request->session_id);
        $booksExercise->update([
            'title' => $session->session,
            'book_id' => $session->id,
        ]);
        if ($request->hasFile('attachments')){
            if ($request->file('attachments')->extension() == 'pdf'){
                $document = Document::where('documentable_type', BooksExercise::class)->where('documentable_id', $booksExercise->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                if (count($document) > 0){
                    if (file_exists($document->document))
                        unlink($document->document);

                    $document->update([
                        'title' => $session->session,
                        'document' => $path
                    ]);
                }else{
                    if (file_exists($booksExercise->video->video))
                        unlink($booksExercise->video->video);
                    $booksExercise->video()->delete();

                    Document::create([
                        'documentable_type' => BooksExercise::class,
                        'documentable_id' => $booksExercise->id,
                        'title' => $session->session,
                        'document' => $path
                    ]);
                }
            }else{
                $video = Video::where('videoable_type', BooksExercise::class)->where('videoable_id', $booksExercise->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                if (count($video) > 0){
                    if (file_exists($video->video))
                        unlink($video->video);

                    $video->update([
                        'title' => $session->session,
                        'video' => $path
                    ]);
                }else{
                    if (file_exists($booksExercise->document->document))
                        unlink($booksExercise->document->document);
                    $booksExercise->document()->delete();

                    Video::create([
                        'videoable_type' => BooksExercise::class,
                        'videoable_id' => $booksExercise->id,
                        'title' => $session->session,
                        'video' => $path
                    ]);
                }
            }
        }
        return redirect()->route('education.booksExercisesAttachmentsIndex')->with('success', 'ویرایش فایل با موفقیت انجام شد');
    }

    public function booksExerciseAttachmentsDestroy(BooksExercise $booksExercise)
    {
        if ($booksExercise->video){
            if (file_exists($booksExercise->video->video))
                unlink($booksExercise->video->video);
            $booksExercise->video()->delete();
        }
        if ($booksExercise->document){
            if (file_exists($booksExercise->document->document))
                unlink($booksExercise->document->document);
            $booksExercise->document()->delete();
        }

        $booksExercise->delete();

        return redirect()->route('education.booksExercisesAttachmentsIndex')->with('success', 'حذف فایل با موفقیت انجام شد');
    }

    public function ExamQuestionSampleAttachmentsIndex()
    {
        $videos = Video::where('videoable_type', ExamQuestionSample::class)->get();
        $documents = Document::where('documentable_type', ExamQuestionSample::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.examQuestionSample.index', compact('videos', 'documents', 'grades'));
    }

    public function examQuestionSampleAttachmentsStore(Request $request)
    {
        if ($request->session_id)
            $session = book::findOrFail($request->session_id);
        else
            $lesson = Lesson::findOrFail($request->lesson_id);

        for ($i=0;$i<count($request->file('attachments'));$i++){
            $examQuestionSample = ExamQuestionSample::create([
                'exam_question_sampleable_type' => isset($session) ? book::class : Lesson::class,
                'exam_question_sampleable_id' => isset($session) ? $session->id : $lesson->id,
                'title' => isset($session) ? $session->session : $lesson->title,
                'type' => $request->type,
                'period' => isset($session) ? null : $request->period,
            ]);
            if ($request->file('attachments.'.$i)->extension() == 'pdf'){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                Document::create([
                    'documentable_type' => ExamQuestionSample::class,
                    'documentable_id' => $examQuestionSample->id,
                    'title' => isset($session) ? $session->session : $lesson->title,
                    'document' => $path
                ]);
            }elseif(in_array(strtoupper($request->file('attachments.'.$i)->extension()), ['MP4', 'MOV', 'AVI', 'FLV', 'MKV', 'MKV', 'WMV', 'AVCHD', 'WEBM'])){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                Video::create([
                    'videoable_type' => ExamQuestionSample::class,
                    'videoable_id' => $examQuestionSample->id,
                    'title' => isset($session) ? $session->session : $lesson->title,
                    'video' => $path
                ]);
            }
        }
        return redirect()->route('education.ExamQuestionSampleAttachmentsIndex')->with('success', 'ایجاد فایل با موفقیت انجام شد');
    }

    public function examQuestionSampleAttachmentsEdit(ExamQuestionSample $examQuestionSample)
    {
        $videos = Video::where('videoable_type', ExamQuestionSample::class)->get();
        $documents = Document::where('documentable_type', ExamQuestionSample::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.examQuestionSample.edit', compact('videos', 'documents', 'grades', 'examQuestionSample'));
    }

    public function examQuestionSampleAttachmentsUpdate(Request $request, ExamQuestionSample $examQuestionSample)
    {
        if ($request->session_id)
            $session = book::findOrFail($request->session_id);
        else
            $lesson = Lesson::findOrFail($request->lesson_id);

        $examQuestionSample->update([
            'exam_question_sampleable_type' => isset($session) ? book::class : Lesson::class,
            'exam_question_sampleable_id' => isset($session) ? $session->id : $lesson->id,
            'title' => isset($session) ? $session->session : $lesson->title,
            'type' => $request->type,
            'period' => isset($session) ? null : $request->period,
        ]);
        if ($request->hasFile('attachments')){
            if ($request->file('attachments')->extension() == 'pdf'){
                $document = Document::where('documentable_type', ExamQuestionSample::class)->where('documentable_id', $examQuestionSample->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                if (count($document) > 0){
                    if (file_exists($document->document))
                        unlink($document->document);

                    $document->update([
                        'title' => isset($session) ? $session->session : $lesson->title,
                        'document' => $path
                    ]);
                }else{
                    if (file_exists($examQuestionSample->video->video))
                        unlink($examQuestionSample->video->video);
                    $examQuestionSample->video()->delete();

                    Document::create([
                        'documentable_type' => ExamQuestionSample::class,
                        'documentable_id' => $examQuestionSample->id,
                        'title' => isset($session) ? $session->session : $lesson->title,
                        'document' => $path
                    ]);
                }
            }else{
                $video = Video::where('videoable_type', ExamQuestionSample::class)->where('videoable_id', $examQuestionSample->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                if (count($video) > 0){
                    if (file_exists($video->video))
                        unlink($video->video);

                    $video->update([
                        'title' => isset($session) ? $session->session : $lesson->title,
                        'video' => $path
                    ]);
                }else{
                    if (file_exists($examQuestionSample->document->document))
                        unlink($examQuestionSample->document->document);
                    $examQuestionSample->document()->delete();

                    Video::create([
                        'videoable_type' => ExamQuestionSample::class,
                        'videoable_id' => $examQuestionSample->id,
                        'title' => isset($session) ? $session->session : $lesson->title,
                        'video' => $path
                    ]);
                }
            }
        }
        return redirect()->route('education.ExamQuestionSampleAttachmentsIndex')->with('success', 'ویرایش فایل با موفقیت انجام شد');
    }

    public function examQuestionSampleAttachmentsDestroy(ExamQuestionSample $examQuestionSample)
    {
        if ($examQuestionSample->video){
            if (file_exists($examQuestionSample->video->video))
                unlink($examQuestionSample->video->video);
            $examQuestionSample->video()->delete();
        }
        if ($examQuestionSample->document){
            if (file_exists($examQuestionSample->document->document))
                unlink($examQuestionSample->document->document);
            $examQuestionSample->document()->delete();
        }

        $examQuestionSample->delete();

        return redirect()->route('education.ExamQuestionSampleAttachmentsIndex')->with('success', 'حذف فایل با موفقیت انجام شد');
    }

    public function generalExamBookIndex()
    {
        $generalTests = ExamBook::where('exam_id', null)->get();
        $grades = Grade::all();

        return view('backEnd.education.examBook.index', compact('generalTests', 'grades'));
    }

    public function generalExamBookStore(Request $request)
    {
        for ($i=0;$i<count($request->question);$i++){
            $data = [
                'question'=>$request->question[$i],
                'answerOne'=>$request->answerOne[$i],
                'answerTwo'=>$request->answerTwo[$i],
                'answerThree'=>$request->answerThree[$i],
                'answerFour'=>$request->answerFour[$i],
                'True'=>$request->True[$i],
                'testable_type'=>book::class,
                'testable_id'=>$request->session_id,
            ];
            if($request->hasFile('audio.'.$i)){
                $file = $request->file('audio.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/audio/' . $filename;
                if (file_exists($path)){
                    $filename = bin2hex(random_bytes(4)).$filename;
                }
                $file->move('upload/audio/examBook/', $filename);
                $data['audio'] = 'upload/audio/examBook/' .  $filename;
            }
            $file=$request->file('answerOneImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageOne'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerTwoImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageTwo'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerThreeImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageThree'] = "upload/exam/" . $image;
            }
            $file=$request->file('answerFourImage.'.$i);
            if(!empty($file)){
                $image=$file->getClientOriginalName();
                $path="upload/exam/".$image;

                if (file_exists($path)){
                    $image=bin2hex(random_bytes(4)).$image;
                }

                $file->move("upload/exam/",$image);
                $data['imageFour'] = "upload/exam/" . $image;
            }
            $parentExamBook = ExamBook::create($data);

            for ($j=0;$j<count($request->input("question_$i"));$j++){
                if (isset($request->input("question_$i")[$j])){
                    $childData = [
                        'question'=>$request->input("question_$i")[$j],
                        'answerOne'=>$request->input("answerOne_$i")[$j],
                        'answerTwo'=>$request->input("answerTwo_$i")[$j],
                        'answerThree'=>$request->input("answerThree_$i")[$j],
                        'answerFour'=>$request->input("answerFour_$i")[$j],
                        'True'=>$request->input("True_$i")[$j],
                        'testable_type'=>book::class,
                        'testable_id'=>$request->session_id,
                        'parent_id' => $parentExamBook->id
                    ];
                    $file=$request->file("image_$i.".$j);
                    if(!empty($file)){
                        $image=$file->getClientOriginalName();
                        $path="upload/exam/".$image;

                        if (file_exists($path)){
                            $image=bin2hex(random_bytes(4)).$image;
                        }

                        $file->move("upload/exam/",$image);
                        $childData['image'] = "upload/exam/" . $image;
                    }
                    $file=$request->file("answerOneImage_$i.".$j);
                    if(!empty($file)){
                        $image=$file->getClientOriginalName();
                        $path="upload/exam/".$image;

                        if (file_exists($path)){
                            $image=bin2hex(random_bytes(4)).$image;
                        }

                        $file->move("upload/exam/",$image);
                        $childData['imageOne'] = "upload/exam/" . $image;
                    }
                    $file=$request->file("answerTwoImage_$i.".$j);
                    if(!empty($file)){
                        $image=$file->getClientOriginalName();
                        $path="upload/exam/".$image;

                        if (file_exists($path)){
                            $image=bin2hex(random_bytes(4)).$image;
                        }

                        $file->move("upload/exam/",$image);
                        $childData['imageTwo'] = "upload/exam/" . $image;
                    }
                    $file=$request->file("answerThreeImage_$i.".$j);
                    if(!empty($file)){
                        $image=$file->getClientOriginalName();
                        $path="upload/exam/".$image;

                        if (file_exists($path)){
                            $image=bin2hex(random_bytes(4)).$image;
                        }

                        $file->move("upload/exam/",$image);
                        $childData['imageThree'] = "upload/exam/" . $image;
                    }
                    $file=$request->file("answerFourImage_$i.".$j);
                    if(!empty($file)){
                        $image=$file->getClientOriginalName();
                        $path="upload/exam/".$image;

                        if (file_exists($path)){
                            $image=bin2hex(random_bytes(4)).$image;
                        }

                        $file->move("upload/exam/",$image);
                        $childData['imageFour'] = "upload/exam/" . $image;
                    }
                    ExamBook::create($childData);
                }
            }
        }

        return redirect()->route('education.generalExamBookIndex');
    }

    public function appendicesAttachmentsIndex($type=null)
    {
        if ($type != null){
            $videos = Video::whereHasMorph('videoable', Appendices::class, function ($query) use ($type) {
                $query->where('type', $type);
            })->get();
            $documents = Document::whereHasMorph('documentable', Appendices::class, function ($query) use ($type) {
                $query->where('type', $type);
            })->get();
        }
        else{
            $videos = Video::where('videoable_type', Appendices::class)->get();
            $documents = Document::where('documentable_type', Appendices::class)->get();
        }
        $grades = Grade::all();

        return view('backEnd.education.attachments.appendices.index', compact('videos', 'documents', 'grades', 'type'));
    }

    public function appendicesAttachmentsStore(Request $request)
    {
        $session = book::findOrFail($request->session_id);
        for ($i=0;$i<count($request->file('attachments'));$i++){
            $appendices = Appendices::create([
                'book_id' => $session->id,
                'title' => $session->session,
                'type' => $request->input("type$i")
            ]);
            if ($request->file('attachments.'.$i)->extension() == 'pdf'){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                Document::create([
                    'documentable_type' => Appendices::class,
                    'documentable_id' => $appendices->id,
                    'title' => $session->session,
                    'document' => $path
                ]);
            }elseif(in_array(strtoupper($request->file('attachments.'.$i)->extension()), ['MP4', 'MOV', 'AVI', 'FLV', 'MKV', 'MKV', 'WMV', 'AVCHD', 'WEBM'])){
                $file = $request->file('attachments.'.$i);
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                Video::create([
                    'videoable_type' => Appendices::class,
                    'videoable_id' => $appendices->id,
                    'title' => $session->session,
                    'video' => $path
                ]);
            }
        }
        return redirect()->route('education.AppendicesAttachmentsIndex')->with('success', 'ایجاد فایل با موفقیت انجام شد');
    }

    public function appendicesAttachmentsEdit(Appendices $appendices)
    {
        $videos = Video::where('videoable_type', Appendices::class)->get();
        $documents = Document::where('documentable_type', Appendices::class)->get();
        $grades = Grade::all();

        return view('backEnd.education.attachments.appendices.edit', compact('videos', 'documents', 'grades', 'appendices'));
    }

    public function appendicesAttachmentsUpdate(Request $request, Appendices $appendices)
    {
        $session = book::findOrFail($request->session_id);
        $appendices->update([
            'title' => $session->session,
            'book_id' => $session->id,
            'type' => $request->type
        ]);
        if ($request->hasFile('attachments')){
            if ($request->file('attachments')->extension() == 'pdf'){
                $document = Document::where('documentable_type', Appendices::class)->where('documentable_id', $appendices->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/document/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/document/', $filename);

                if (count($document) > 0){
                    if (file_exists($document->document))
                        unlink($document->document);

                    $document->update([
                        'title' => $session->session,
                        'document' => $path
                    ]);
                }else{
                    if (file_exists($appendices->video->video))
                        unlink($appendices->video->video);
                    $appendices->video()->delete();

                    Document::create([
                        'documentable_type' => Appendices::class,
                        'documentable_id' => $appendices->id,
                        'title' => $session->session,
                        'document' => $path
                    ]);
                }
            }else{
                $video = Video::where('videoable_type', Appendices::class)->where('videoable_id', $appendices->id)->get();
                $file = $request->file('attachments');
                $filename = $file->getClientOriginalName();
                $path = 'upload/video/' . $filename;

                if (file_exists($path))
                    $filename = bin2hex(random_bytes(4)) . $filename;

                $file->move('upload/video/', $filename);

                if (count($video) > 0){
                    if (file_exists($video->video))
                        unlink($video->video);

                    $video->update([
                        'title' => $session->session,
                        'video' => $path
                    ]);
                }else{
                    if (file_exists($appendices->document->document))
                        unlink($appendices->document->document);
                    $appendices->document()->delete();

                    Video::create([
                        'videoable_type' => Appendices::class,
                        'videoable_id' => $appendices->id,
                        'title' => $session->session,
                        'video' => $path
                    ]);
                }
            }
        }
        return redirect()->route('education.AppendicesAttachmentsIndex')->with('success', 'ویرایش فایل با موفقیت انجام شد');
    }

    public function appendicesAttachmentsDestroy(Appendices $appendices)
    {
        if ($appendices->video){
            if (file_exists($appendices->video->video))
                unlink($appendices->video->video);
            $appendices->video()->delete();
        }
        if ($appendices->document){
            if (file_exists($appendices->document->document))
                unlink($appendices->document->document);
            $appendices->document()->delete();
        }

        $appendices->delete();

        return redirect()->route('education.AppendicesAttachmentsIndex')->with('success', 'حذف فایل با موفقیت انجام شد');
    }
}
