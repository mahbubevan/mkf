<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\Employee;
use App\Models\Production;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Transaction;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $data['page_title'] = 'Admin Dashboard';
        $data['company_account'] = CompanyAccount::first();
        $data['total_income'] = Transaction::where('type', Transaction::INCOME)->sum('amount');
        $data['total_expense'] = Transaction::where('type', Transaction::EXPENSE)->sum('amount');
        $data['total_profit'] = $data['total_income'] - $data['total_expense'];

        $data['employee_count'] = Employee::where('status', Employee::ACTIVE)->count();
        $data['total_stock'] = Stock::sum('remaining');
        $data['running_production'] = Production::where('status', '!=', Production::COMPLETED)->sum('pant_quantity');

        $data['current_month_sale'] = Sale::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        $data['last_month_sale'] = Sale::whereMonth('created_at', Carbon::now()->subMonths(1)->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        return view('admin.dashboard', $data);
    }
}
