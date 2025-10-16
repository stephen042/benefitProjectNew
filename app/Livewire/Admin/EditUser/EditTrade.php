<?php

namespace App\Livewire\Admin\EditUser;

use App\Models\Trade;
use Livewire\Component;

class EditTrade extends Component
{
    public $user;

    public $profits = [];
    public $losses = [];


    public function deleteTrade($tradeId)
    {
        $trade = Trade::findOrFail($tradeId);
        $trade->delete();
        $this->dispatch('notify', ['Trade deleted successfully', 'success']);
    }

    public function completeTrade($tradeId)
    {
        $this->validate([
            "profits.$tradeId" => 'nullable|numeric|min:0',
            "losses.$tradeId" => 'nullable|numeric|min:0',
        ]);

        $profit = $this->profits[$tradeId] ?? null;
        $loss = $this->losses[$tradeId] ?? null;

        if (is_null($profit) && is_null($loss)) {
            $this->dispatch('notify', 'Please enter a profit or a loss value.', 'error');
            return;
        }

        $trade = Trade::findOrFail($tradeId);

        // Update the user's balance
        if (!is_null($profit)) {
            $this->user->balance += $profit;
            $trade->trade_profit = $profit;
        }

        if (!is_null($loss)) {
            $this->user->sub_balance -= $loss;
            $trade->trade_loss = $loss;
        }

        $trade->trade_status = 3; // Mark as completed
        $trade->save();
        $this->user->save(); // Save the updated balance

        $this->dispatch('notify', 'Trade completed successfully', 'success');
    }

    public function render()
    {
        return view('livewire.admin.edit-user.edit-trade', [
            'trades' => $this->user->trades()->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }
}
