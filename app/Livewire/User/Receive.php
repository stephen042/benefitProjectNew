<?php

namespace App\Livewire\User;

use App\Mail\AppMail;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Receive as ModelReceive;

class Receive extends Component
{
    use WithFileUploads;

    public $amount;

    protected $rules = [
        'amount' => ['required', 'numeric', 'min:100'],
    ];
    protected $messages = [
        'amount.required' => 'Please input amount',
        'amount.min' => 'Amount should be at least $100',
    ];

    public $receivingFor = 2;

    #[Validate('image|max:2024')] // 2MB Max
    public $proof;


    public function updated($amount)
    {
        $this->validateOnly($amount);
    }

    public function receive()
    {
        $this->validate();
    
        $user_id = Auth::user()->id;
        $full_name = Auth::user()->name;
    
        $proofPath = $this->proof->store('proof', 'public');
    
        $store = ModelReceive::create([
            'user_id' => $user_id,
            'amount' => $this->amount,
            'receiving_for' => $this->receivingFor,
            'proof' => $proofPath,
            'status' => 1,
        ]);
    
        if ($store) {
            $amount = $this->amount;
            $userEmail = Auth::user()->email;
            $subject = "Receive Request Notification";
    
            $bodyUser = [
                "name" => $full_name,
                "title" => "Receive Request",
                "message" => "Your receive request of $$amount was submitted successfully."
            ];
            $bodyAdmin = [
                "name" => "Admin",
                "title" => "Customer Receive Request",
                "message" => "A user named $full_name made a receive request of $$amount on " . date('Y-M-d H:i') . "."
            ];
    
            try {
                // Send email
                Mail::to($userEmail)->send(new AppMail($subject, $bodyUser));
                Mail::to(config('app.Admin_email'))->send(new AppMail($subject, $bodyAdmin));
    
                // Dispatch an event that Livewire listens to
                $this->dispatch('receive-submitted');
            } catch (\Throwable $th) {
                $this->dispatch('receive-error');
            }
    
            return $this->reset();
        }
    }
    


    public function render()
    {
        return view('livewire.user.receive');
    }
}
