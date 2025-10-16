<?php

namespace App\Livewire\Admin\EditUser;

use Livewire\Component;

class AccountTopUp extends Component
{
    public $user;

    public $free_margin;
    public $earnings;

    public $credit_bal_amount;
    public $credit_sub_bal_amount;
    
    public $debit_bal_amount;
    public $debit_sub_bal_amount;

    public $network_fee_amount;

    public function mount($user)
    {
        $this->user = $user;
        $this->free_margin = $user->user_trade_free_margin;
        $this->earnings = $user->user_trade_equity;
        $this->network_fee_amount = $user->network_fee ?? 0;
    }

    public function credit_balance(){
        $this->validate([
            'credit_bal_amount' => 'required|numeric|min:0',
        ]);

        $this->user->balance += $this->credit_bal_amount;
        $this->user->save();

        $this->dispatch('notify', 'User balance has been credited', 'success');
        return redirect()->route('admin.user.edit', $this->user->id);
    }

    public function credit_sub_balance(){
        $this->validate([
            'credit_sub_bal_amount' => 'required|numeric|min:0',
        ]);

        $this->user->sub_balance += $this->credit_sub_bal_amount;
        $this->user->save();

        $this->dispatch('notify', 'User sub balance has been credited', 'success');
        return redirect()->route('admin.user.edit', $this->user->id);
    }
    public function debit_balance(){
        $this->validate([
            'debit_bal_amount' => 'required|numeric|min:0',
        ]);

        if ($this->user->balance < $this->debit_bal_amount) {
            $this->dispatch('notify', 'User balance is not enough', 'error');
            return;
        }

        $this->user->balance -= $this->debit_bal_amount;
        $this->user->save();

        $this->dispatch('notify', 'User balance has been debited', 'success');
        return redirect()->route('admin.user.edit', $this->user->id);
    }
    public function debit_sub_balance(){
        $this->validate([
            'debit_sub_bal_amount' => 'required|numeric|min:0',
        ]);

        if ($this->user->sub_balance < $this->debit_sub_bal_amount) {
            $this->dispatch('notify', 'User sub balance is not enough', 'error');
            return;
        }

        $this->user->sub_balance -= $this->debit_sub_bal_amount;
        $this->user->save();

        $this->dispatch('notify', 'User sub balance has been debited', 'success');
        return redirect()->route('admin.user.edit', $this->user->id);
    }
    // public function update_free_margin(){
    //     $this->validate([
    //         'free_margin' => 'required',
    //     ]);

    //     $this->user->user_trade_free_margin = $this->free_margin;
    //     $this->user->save();

    //     return $this->dispatch('notify', 'User trade free margin have been updated', 'success');
    // }
    public function network_fee_top_up(){
        $this->validate([
            'network_fee_amount' => 'required|min:0',
        ]);

        $this->user->network_fee = $this->network_fee_amount;
        $this->user->save();

        return $this->dispatch('notify', 'User network fee has been updated', 'success');
    }
    // public function update_equity(){
    //     $this->validate([
    //         'earnings' => 'required',
    //     ]);

    //     $this->user->user_trade_equity = $this->earnings;
    //     $this->user->save();

    //     return $this->dispatch('notify', 'User earnings have been updated', 'success');
    // }

    public function render()
    {
        return view('livewire.admin.edit-user.account-top-up');
    }
}
