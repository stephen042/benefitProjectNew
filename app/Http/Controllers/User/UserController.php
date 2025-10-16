<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $crypto_accounts = $user->accounts;
        return view('user.index',[
            'crypto_accounts' => $crypto_accounts,
        ]);
    }
}
