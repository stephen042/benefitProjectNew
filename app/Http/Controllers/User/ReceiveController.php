<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminWallets;
use Illuminate\Support\Facades\Auth;

class ReceiveController extends Controller
{
    public function receive()
    {   
        $admin_wallets = AdminWallets::where('id',1)->first();
        return view('user.receive', [
            'admin_wallets' => $admin_wallets
        ]);
    }

    public function receiveHistory()
    {
        // Fetch the receive history from the database or any other source
        $deposits = User::find(Auth::user()->id)->receives()->latest()->paginate(10);
        return view('user.receive-history',[
            'deposits' => $deposits,
        ]);
    }
}
