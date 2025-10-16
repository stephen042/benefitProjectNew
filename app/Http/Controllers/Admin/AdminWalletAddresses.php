<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminWalletAddresses extends Controller
{
    
    public function index(){
        return view('admin.admin-wallet-addresses');
    }
}
