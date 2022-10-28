<?php

namespace App\Http\Controllers;

use App\Grade;
use App\SubscriptionSale;
use Illuminate\Http\Request;

class SubscriptionSaleController extends Controller
{
    public function index()
    {
        $subscriptionSales = SubscriptionSale::all();
        $grades = Grade::all();

        return view('backEnd.store.index', compact('subscriptionSales', 'grades'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        SubscriptionSale::create($data);

        return redirect()->route('store.subscription.index');
    }
}
