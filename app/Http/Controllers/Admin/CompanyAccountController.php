<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use Illuminate\Http\Request;

class CompanyAccountController extends Controller
{
    public function company_account()
    {
        $data['page_title'] = 'Company Account Information';
        $data['account'] = CompanyAccount::first();

        return view('admin.company-account.index', $data);
    }

    public function company_account_add(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);

        $acc = CompanyAccount::first();
        $acc->current_balance += $request->amount;
        $acc->update();

        return back()->with('success', 'Balance Added');
    }

    public function company_account_sub(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);

        $acc = CompanyAccount::first();
        $acc->current_balance -= $request->amount;
        $acc->update();

        return back()->with('error', 'Balance Substracted');
    }
}
