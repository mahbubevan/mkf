<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\Fabric;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FabricController extends Controller
{
    public function list()
    {
        $data['page_title'] = 'Fabrics Records';
        $data['fabrics'] = Fabric::latest()->paginate(5);

        return view('admin.fabric.index', $data);
    }

    public function create()
    {
        $data['page_title'] = 'Create A New Fabrics Records';

        return view('admin.fabric.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
            'yards' => 'required|numeric',
            'amount' => 'required|numeric',
            'rate' => 'required|numeric',
            'expected_pant' => 'required',
        ]);

        $trx = \getTrx(18);

        $company = CompanyAccount::first();
        $company->current_balance -= $request->amount;
        $company->save();

        $fabric = new Fabric();
        $fabric->name = $request->name . '-' . Carbon::now()->format('dmy');
        $fabric->yards = $request->yards;
        $fabric->amount = $request->amount;
        $fabric->rate = $request->rate;
        $fabric->trx_id = $trx;
        $fabric->expected_pant = $request->expected_pant;
        $fabric->save();

        $transaction = new Transaction();
        $transaction->trx_id = $trx;
        $transaction->type = Transaction::EXPENSE;
        $transaction->amount = $request->amount;
        $transaction->post_balance = $company->current_balance;
        $transaction->remarks = "Transaction Created On Fabric Buy";
        $transaction->save();

        return back()->with('success', 'Fabric Records Created');
    }
}
