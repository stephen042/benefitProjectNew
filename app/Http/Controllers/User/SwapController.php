<?php

namespace App\Http\Controllers\User;

use App\Models\AdminWallets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SwapController extends Controller
{
    public function showSwap()
    {
        $userData = Auth::user();
        $user = $userData->accounts;

        $balances = [
            'BTC' => $user->bitcoin_balance ?? 0,
            'ETH' => $user->ethereum_balance ?? 0,
            'SOL' => $user->solana_balance ?? 0,
            'USDT' => $usdt_balance ?? 0,
            'MATIC' => $user->polygon_balance ?? 0,
            'XRP' => $user->ripple_balance ?? 0,
        ];

        // xrp wallet address
       $admin_wallets = AdminWallets::where('id',1)->first();
        return view('user.swap', [
            'balances' => $balances,
            'xrpWalletAddress' => $admin_wallets->ripple_address,
        ]);
    }
}
