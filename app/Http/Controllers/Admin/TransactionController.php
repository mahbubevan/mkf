<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction_list()
    {
        $data['page_title'] = "All Transactions";
        $data['transactions'] = Transaction::latest()->paginate(25);

        return view('admin.transaction.list',$data);
    }
}
