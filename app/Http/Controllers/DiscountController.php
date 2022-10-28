<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Exam;
use App\Grade;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::latest()->get();
        $users = User::all();

        return view('backEnd.discount.index')->with(compact('discounts', 'users'));
    }


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

        $data['type'] = $request->discount_type ?? 0;

        if ($data['type'] != 2) {
            $data['identifier_id'] = null;
            $data['discount_code'] = Str::random(8);
        }else{
            $identifier = User::findOrFail($data['identifier_id']);
            $data['discount_code'] = $identifier->userMeta->identifying_code;
        }


        Discount::create($data);

        return redirect()->route('discount.index');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('discount.index');
    }
}
