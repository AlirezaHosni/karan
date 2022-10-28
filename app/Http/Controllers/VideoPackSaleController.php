<?php

namespace App\Http\Controllers;

use App\Grade;
use App\VideoPackSale;
use Illuminate\Http\Request;

class VideoPackSaleController extends Controller
{
    public function index()
    {
        $videoPackSales = VideoPackSale::all();
        $grades = Grade::all();

        return view('backEnd.store.videoPack.index', compact('videoPackSales', 'grades'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($data['grade_id'] != null)
            VideoPackSale::create($data);

        return redirect()->route('store.videoPack.index');
    }
}
