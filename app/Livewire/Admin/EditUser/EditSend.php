<?php

namespace App\Livewire\Admin\EditUser;

use App\Models\Send;
use App\Mail\AppMail;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class EditSend extends Component
{
    public $user;

    public function deleteWithdraw($id)
    {
        $withdraw = Send::find($id);
        $withdraw->delete();

        $this->dispatch('notify', 'Transaction Deleted Successfully', 'success');
        return redirect()->route('admin.user.edit', $this->user->id);
    }

    public function approveWithdraw($id)
    {
        $withdraw = Send::find($id);
        $withdraw->status = 3;
        $withdraw->save();

        // update user balance
        $user = $this->user;
        $user->balance -= $withdraw->amount;
        $user->save();

        // send email 
        $amount = $withdraw->amount;
        $userEmail = $user->email;
        $full_name = $user->name;
        $subject = "Send Approval Notification";

        $bodyUser = [
            "name" => $full_name,
            "title" => "Send Approval",
            "message" => "Your Send request of $$amount was approved successfully."
        ];
        $bodyAdmin = [
            "name" => "Admin",
            "title" => "Customer Send Approval",
            "message" => "A user named $full_name Send request of $$amount on have been approved on" . date('Y-M-d H:i') . "."
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

    public function denyWithdraw($id)
    {
        $withdraw = Send::find($id);
        $withdraw->status = 2;
        $withdraw->save();
        $user = $this->user;

        // Add back the withdrawn amount to user's balance
        $user->balance += $withdraw->amount;
        $user->save();

        // send email 
        $amount = $withdraw->amount;
        $userEmail = $user->email;
        $full_name = $user->name;
        $subject = "Send Rejection Notification";

        $bodyUser = [
            "name" => $full_name,
            "title" => "Send Rejection",
            "message" => "Your Send request of $$amount was Rejection. Please contact support for more information."
        ];
        $bodyAdmin = [
            "name" => "Admin",
            "title" => "Customer Send Rejection",
            "message" => "A user named $full_name Send request of $$amount on have been Rejection on" . date('Y-M-d H:i') . "."
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
        $withdraws =  $this->user->sends()->orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.edit-user.edit-send', [
            'withdraws' => $withdraws,
        ]);
    }
}
