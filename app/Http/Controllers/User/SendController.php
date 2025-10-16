<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SendController extends Controller
{
    public function send()
    {
        return view('user.send');
    }

    public function sendHistory()
    {
        // Fetch the send history from the database or any other source
        $withdraws = User::find(Auth::user()->id)->sends()->latest()->paginate(10);
        return view('user.send-history',[
            'withdraws' => $withdraws,
        ]);
    }
}
