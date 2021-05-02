<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Production;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function list()
    {
        $data['page_title'] = 'Stock Records';
        $data['stocks'] = Stock::with('production')->latest()->paginate(25);

        return view('admin.stock.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New Stock Records';
        $data['productions'] = Production::get();

        return view('admin.stock.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required',
            'amount' => 'required',
            'image' => 'required',
        ]);
        $stock = new Stock();
        $stock->quantity = $request->quantity;
        $stock->amount = $request->amount;
        $stock->remaining = $request->quantity;
        $stock->image = \uploadImage($request->image, 'img/production/');
        $stock->save();

        return back()->with('success', 'Stock Recorded Successfully');
    }
}
