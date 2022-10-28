<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();

        return view('backEnd.news.index', compact('news'));
    }

    public function create()
    {
        return view('backEnd.news.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        News::create($inputs);

        return redirect()->route('news.index')->with('success', 'ایجاد خبر با موفقیت انجام شد');
    }


    public function show(News $news)
    {
        //
    }

    public function edit($id)
    {
        $specifiedNews = News::findOrFail($id);
        $news = News::latest()->get();

        return view('backEnd.news.edit', compact('news', 'specifiedNews'));
    }

    public function update(Request $request,$id)
    {
        $inputs = $request->all();
        $news = News::findOrFail($id);
        $news->update($inputs);

        return redirect()->route('news.index')->with('success', 'ویرایش خبر با موفقیت انجام شد');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'حذف خبر با موفقیت انجام شد');
    }
}
