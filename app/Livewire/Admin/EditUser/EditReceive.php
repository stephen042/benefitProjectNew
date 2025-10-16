<?php

namespace App\Livewire\Admin\EditUser;

use App\Mail\AppMail;
use App\Models\Receive;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class EditReceive extends Component
{
    public $user;

    public function deleteDeposit($id)
    {
        $deposit = Receive::find($id);
        $deposit->delete();

        $this->dispatch('notify', 'Transaction Deleted Successfully', 'success');
        return redirect()->route('admin.user.edit', $this->user->id);
    }

    public function approveDeposit($id)
    {
        $deposit = Receive::find($id);
        $deposit->status = 3;
        $deposit->save();

        if ($deposit->receiving_for == 1) {
            // update user balance
            $user = $this->user;
            $user->balance += $deposit->amount;
            $user->save();
        }elseif ($deposit->receiving_for == 2) {
            // update user Sub balance
            $user = $this->user;
            $user->sub_balance += $deposit->amount;
            $user->save();
        }


        // send email 
        $amount = $deposit->amount;
        $userEmail = $user->email;
        $full_name = $user->name;
        $subject = "Receive Approval Notification";

        $bodyUser = [
            "name" => $full_name,
            "title" => "Receive Approval",
            "message" => "Your receive request of $$amount was approved successfully."
        ];
        $bodyAdmin = [
            "name" => "Admin",
            "title" => "Customer Receive Approval",
            "message" => "A user named $full_name receive request of $$amount on have been approved on" . date('Y-M-d H:i') . "."
        ];

        try {
            // Send email
            Mail::to($userEmail)->send(new AppMail($subject, $bodyUser));
            Mail::to(config('app.Admin_email'))->send(new AppMail($subject, $bodyAdmin));

            $this->dispatch('notify', 'Transaction Approved Successfully', 'success');
            redirect()->route('admin.user.edit', $this->user->id);
        } catch (\Throwable $th) {
            $this->dispatch('notify', 'Email sending failed. Try again.', 'error');
        }
    }

    public function denyDeposit($id)
    {
        $deposit = Receive::find($id);
        $deposit->status = 2;
        $deposit->save();
        $user = $this->user;

        // send email 
        $amount = $deposit->amount;
        $userEmail = $user->email;
        $full_name = $user->name;
        $subject = "Receive Rejection Notification";

        $bodyUser = [
            "name" => $full_name,
            "title" => "Receive Rejection",
            "message" => "Your receive request of $$amount was Rejection. Please contact support for more information."
        ];
        $bodyAdmin = [
            "name" => "Admin",
            "title" => "Customer Receive Rejection",
            "message" => "A user named $full_name receive request of $$amount on have been Rejection on" . date('Y-M-d H:i') . "."
        ];

        try {
            // Send email
            Mail::to($userEmail)->send(new AppMail($subject, $bodyUser));
            Mail::to(config('app.Admin_email'))->send(new AppMail($subject, $bodyAdmin));

            $this->dispatch('notify', 'Transaction Denied Successfully', 'success');
            redirect()->route('admin.user.edit', $this->user->id);
        } catch (\Throwable $th) {
            $this->dispatch('notify', 'Email sending failed. Try again.', 'error');
        }
    }
    public function render()
    {
        $deposits = $this->user->receives()->orderByDesc('created_at')->paginate(10);

        return view('livewire.admin.edit-user.edit-receive', [
            'deposits' => $deposits,
        ]);
    }
}
