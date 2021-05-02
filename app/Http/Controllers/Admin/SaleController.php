<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\Production;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function list()
    {
        $data['page_title'] = 'Sale Lists';
        $data['sales'] = Sale::latest()->paginate(20);

        return view('admin.sale.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Sale Products';
        $data['stocks'] = Stock::latest()->get();

        return view('admin.sale.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'quantity' => 'required',
            'remarks' => 'nullable',
        ]);
        $trx = \getTrx(18);

        $stock = Stock::with('production')->where('id', $request->stock)->first();
        if ($stock->remaining < $request->quantity) {
            return back()->with('error', 'You do not have available stock');
        }
        $stock->remaining -= $request->quantity;
        $stock->update();

        $sale = new Sale();
        $sale->sell_by = Auth::id();
        $sale->production_code = $stock->production_code;
        $sale->quantity = $request->quantity;
        $sale->amount = $request->total_price;
        $sale->trx_id = $trx;
        $sale->remarks = $request->remarks;
        $sale->save();

        $company = CompanyAccount::first();
        $company->current_balance += $request->total_price;
        $company->update();

        $transaction = new Transaction();
        $transaction->trx_id = $trx;
        $transaction->type = Transaction::INCOME;
        $transaction->amount = $request->total_price;
        $transaction->post_balance = $company->current_balance;
        $transaction->remarks = "Transaction Created On SALE. This Sale occured by - " . Auth::user()?->username ?? "N/A";
        $transaction->save();

        return back()->with('success', 'Sold And Recorded Successfully');
    }
}
