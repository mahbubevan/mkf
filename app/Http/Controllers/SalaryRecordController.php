<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaryRecordController extends Controller
{
    public function index()
    {
        return view('admin.salary.index');
    }
}
