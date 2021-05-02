<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function list()
    {
        $data['page_title'] = 'Inventory Records';
        $data['inventories'] = Inventory::latest()->paginate(5);

        return view('admin.inventory.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New Inventory Records';

        return view('admin.inventory.create', $data);
    }

    public function store(Request $request)
    {
        $trx = \getTrx();
        $inventory = new Inventory();
        $inventory->name = $request->name;
        $inventory->quantity = $request->quantity;
        $inventory->amount = $request->amount;
        $inventory->trx_id = $trx;
        $inventory->details = $request->details;
        $inventory->save();

        $company = CompanyAccount::first();
        $company->current_balance -= $request->amount;
        $company->update();

        $transaction = new Transaction();
        $transaction->trx_id = $trx;
        $transaction->type = Transaction::EXPENSE;
        $transaction->amount = $request->amount;
        $transaction->post_balance = $company->current_balance;
        $transaction->remarks = "Inventory Purchase";
        $transaction->save();

        return back()->with('success', 'Inventory Recorded');
    }
}
