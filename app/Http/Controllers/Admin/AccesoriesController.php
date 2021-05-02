<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accesories;
use App\Models\AccesoriesList;
use App\Models\CompanyAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AccesoriesController extends Controller
{
    public function list()
    {
        $data['page_title'] = 'Accesories Record';
        $data['accesories'] = Accesories::with('accesories_name')->latest()->paginate(20);
        return view('admin.accesories.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create New Accesories Record';
        $data['accesories'] = AccesoriesList::get();

        return view('admin.accesories.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'accesories_list' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
            'rate' => 'required'
        ]);

        $trx = \getTrx();

        $accesories = new Accesories();
        $accesories->accesories_list = $request->accesories_list;
        $accesories->quantity = $request->quantity;
        $accesories->remaining = $request->quantity;
        $accesories->amount = $request->amount;
        $accesories->rate = $request->rate;
        $accesories->trx_id  = $trx;
        $accesories->save();

        $company = CompanyAccount::first();
        $company->current_balance -= $request->amount;
        $company->update();

        $transactions = new Transaction();
        $transactions->trx_id = $trx;
        $transactions->type = Transaction::EXPENSE;
        $transactions->amount = $request->amount;
        $transactions->post_balance = $company->current_balance;
        $transactions->remarks = "Transaction Creatd On Accesories Buy";
        $transactions->save();

        return back()->with('success', 'Accesories Recorded Successfully');
    }

    public function name()
    {
        $data['page_title'] = 'Accesories Lists';
        $data['accesories'] = AccesoriesList::latest()->paginate(20);

        return view('admin.accesories.name', $data);
    }

    public function name_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $list = new AccesoriesList();
        $list->name = $request->name;
        $list->save();

        return back()->with('success', 'Successfully Added');
    }

    public function name_update(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required'
        ]);

        $list = AccesoriesList::where('id',$request->id)->first();
        $list->name = $request->name;
        $list->update();

        return back()->with('success', 'Successfully Updated');
    }
}
