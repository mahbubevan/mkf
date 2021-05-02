<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\ExternalExpense;
use App\Models\ExternalIncome;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ExternalController extends Controller
{
    public function external_expense_list()
    {
        $data['page_title'] = 'Expense Records';
        $data['expenses'] = ExternalExpense::latest()->paginate(20);

        return view('admin.external.expense_list', $data);
    }

    public function external_expense_create()
    {
        $data['page_title'] = 'Create New Expense Records';

        return view('admin.external.expense_create', $data);
    }

    public function external_expense_store(Request $request)
    {
        $trx = \getTrx();
        $exp = new ExternalExpense();
        $exp->details = $request->details;
        $exp->amount = $request->amount;
        $exp->trx_id = $trx;
        $exp->save();

        $company = CompanyAccount::first();
        $company->current_balance -= $request->amount;
        $company->update();

        $transaction = new Transaction();
        $transaction->trx_id = $trx;
        $transaction->type = Transaction::EXPENSE;
        $transaction->amount = $request->amount;
        $transaction->post_balance = $company->current_balance;
        $transaction->remarks = "External Expense Details - " . $request->details;;
        $transaction->save();

        return back()->with('success', 'External Expense Recorded');
    }

    public function external_income_list()
    {
        $data['page_title'] = 'Incomes Records';
        $data['incomes'] = ExternalIncome::latest()->paginate(20);

        return view('admin.external.income_list', $data);
    }

    public function external_income_create()
    {
        $data['page_title'] = 'Create New Income Records';

        return view('admin.external.income_create', $data);
    }

    public function external_income_store(Request $request)
    {
        $trx = \getTrx();
        $exp = new ExternalIncome();
        $exp->details = $request->details;
        $exp->amount = $request->amount;
        $exp->trx_id = $trx;
        $exp->save();

        $company = CompanyAccount::first();
        $company->current_balance += $request->amount;
        $company->update();

        $transaction = new Transaction();
        $transaction->trx_id = $trx;
        $transaction->type = Transaction::INCOME;
        $transaction->amount = $request->amount;
        $transaction->post_balance = $company->current_balance;
        $transaction->remarks = "External Income Details - " . $request->details;;
        $transaction->save();

        return back()->with('success', 'External Income Recorded');
    }
}
