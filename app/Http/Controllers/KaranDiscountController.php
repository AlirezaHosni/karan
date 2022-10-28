<?php

namespace App\Http\Controllers;

use App\KaranDiscount;
use Illuminate\Http\Request;

class KaranDiscountController extends Controller
{
    public function index()
    {
        $karanDiscounts = KaranDiscount::all();

        return view('backEnd.karanDiscount.index')->with(compact('karanDiscounts'));
    }

//    public function create()
//    {
//        return view('backEnd.karanDiscount.create');
//    }

    public function store(Request $request)
    {
        $data = $request->all();

        $realTimestampDiscountStartDate = substr($request->discount_start_date, 0, 10);
        $data['discount_start_date'] = date("Y-m-d", (int)$realTimestampDiscountStartDate);

        $realTimestampDiscountEndDate = substr($request->discount_end_date, 0, 10);
        $data['discount_end_date'] = date("Y-m-d", (int)$realTimestampDiscountEndDate);

        $realTimestampUsingPeriodStartDate = substr($request->using_period_start_date, 0, 10);
        $data['using_period_start_date'] = date("Y-m-d", (int)$realTimestampUsingPeriodStartDate);

        $realTimestampUsingPeriodEndDate = substr($request->using_period_end_date, 0, 10);
        $data['using_period_end_date'] = date("Y-m-d", (int)$realTimestampUsingPeriodEndDate);

        $karanDiscount = KaranDiscount::find($data['karanDiscount_id']);
        $karanDiscount->update($data);

        return redirect()->route('discount.karanDiscount.index');
    }


//    public function show(KaranDiscount $karanDiscount)
//    {
//        //
//    }
//
//    public function edit(KaranDiscount $karanDiscount)
//    {
//        return view('backEnd.karanDiscount.edit', compact('karanDiscount'));
//    }
//
//    public function update(Request $request,$karanDiscount)
//    {
//        $data = $request->all();
//        $karanDiscount->update($data);
//
//        return redirect()->route('karanDiscount.index');
//    }
//
//    public function destroy($karanDiscount)
//    {
//        KaranDiscount::destroy($karanDiscount);
//
//        return redirect()->route('karanDiscount.index');
//    }
}
