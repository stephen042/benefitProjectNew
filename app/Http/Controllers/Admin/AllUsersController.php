<?php

namespace App\Http\Controllers\Admin;

use App\Models\Send;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllUsersController extends Controller
{
    public function index(){
        
        $total_users = User::where("role", 0)->count();

        $total_balance = User::where("role", 0)->sum("balance");

        $total_sub_balance = User::where("role", 0)->sum("sub_balance");

        $total_withdraw = Send::where("status", 3)->sum("amount");

        return view('admin.index', [
            'total_users' => $total_users,
            'total_balance' => $total_balance,
            'total_sub_balance' => $total_sub_balance,
            'total_withdraw' => $total_withdraw
        ]);
    }

    public function editUsers($id){
        // Here you can fetch the user details using the $id
        $user = User::find($id);

        // sum total sends
        $total_sends = Send::where("user_id", $id)->where("status", 3)->sum("amount");
        // sum total receives
        $total_receives = Send::where("user_id", $id)->where("status", 3)->sum("amount");

        if (!$user) {
            return redirect()->route('admin.dashboard')->with('error', 'User not found');
        }
        return view('admin.edit-users', [
            'user' => $user,
            'total_sends' => $total_sends,
            'total_receives' => $total_receives,
        ]);
    }
}
