<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        $data['users'] = User::latest()->paginate(5);

        return view('admin.user.list', $data);
    }
}
