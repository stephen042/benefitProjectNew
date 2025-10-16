<?php

namespace App\Livewire\User;

use App\Mail\AppMail;
use Livewire\Component;
use App\Models\Send as ModelSend;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Send extends Component
{
    #[Validate('required')]
    public $currency;

    public $amount;

    protected $rules = [
        'amount' => ['required', 'numeric', 'min:100'],
    ];
    protected $messages = [
        'amount.required' => 'Please input amount',
        'amount.min' => 'Amount should be at least $100',
    ];

    #[Validate('required')]
    public $wallet_address;

    public function updated($amount)
    {
        $this->validateOnly($amount);
    }

    public function StoreSend()
    {
        $this->validate();

        $user_id = Auth::user()->id;
        $account_balance = Auth::user()->balance;
        $full_name = Auth::user()->name;

        if ($this->amount > $account_balance) {
            $this->dispatch('send_insufficient_balance');
            return;
        }

        $store = ModelSend::create([
            'user_id' => $user_id,
            'crypto_currency' => $this->currency,
            'amount' => $this->amount,
            'wallet_address' => $this->wallet_address,
            'status' => 1,
        ]);

        if ($store) {
            // Update user account balance
            $user = Auth::user();
            $user->balance -= $this->amount;
            $user->save();

            // Send email notification
            $amount = $this->amount;
            $userEmail = Auth::user()->email;
            $subject = "Send Request Notification";

            $bodyUser = [
                "name" => $full_name,
                "title" => "Send Request",
                "message" => "Your Send request of $$amount was submitted successfully."
            ];
            $bodyAdmin = [
                "name" => "Admin",
                "title" => "Customer Send Request",
                "message" => "A user named $full_name made a Send request of $$amount on " . date('Y-M-d H:i') . "."
            ];

            try {
                // Send email
                Mail::to($userEmail)->send(new AppMail($subject, $bodyUser));
                Mail::to(config('app.Admin_email'))->send(new AppMail($subject, $bodyAdmin));

                // Dispatch an event that Livewire listens to
                $this->dispatch('send-submitted');
            } catch (\Throwable $th) {
                $this->dispatch('send-error');
            }

            return $this->reset();
        }
    }
    public function render()
    {
        return view('livewire.user.send');
    }
}
