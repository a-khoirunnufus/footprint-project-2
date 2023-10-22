<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $employee = null;

        if (Auth::guard('admin')->check()) {
            $employee = Auth::guard('admin')->user();
        }
        elseif (Auth::guard('employee')->check()) {
            $employee = Auth::guard('employee')->user();
        }

        return view('profile', ['employee' => $employee]);
    }
}
