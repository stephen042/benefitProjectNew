<?php

namespace App\Livewire\Admin\EditUser;

use Livewire\Component;

class EditCryptoAccounts extends Component
{
    public $user;
    public $bitcoin;
    public $ethereum;
    public $solana;
    public $ripple;
    public $usdt;
    public $polygon;

    // Pass in the user model to the component via mount()
    public function mount($user)
    {
        $this->user = $user;

        // Retrieve crypto accounts from the associated account record
        $this->bitcoin  = $user->accounts->bitcoin_balance ?? 0 ;
        $this->ethereum = $user->accounts->ethereum_balance ?? 0 ;
        $this->solana   = $user->accounts->solana_balance ?? 0 ;
        $this->ripple   = $user->accounts->ripple_balance ?? 0 ;
        $this->usdt     = $user->accounts->usdt_balance ?? 0 ;
        $this->polygon  = $user->accounts->polygon_balance ?? 0 ;
    }

    public function updateCryptoAccounts()
    {
        $data = $this->validate([
            'bitcoin'  => 'nullable',
            'ethereum' => 'nullable',
            'solana'   => 'nullable',
            'ripple'   => 'nullable',
            'usdt'     => 'nullable',
            'polygon'  => 'nullable',
        ]);

        // Update the user's crypto accounts in the accounts table
        $this->user->accounts->update([
            'bitcoin_balance'  => $data['bitcoin'],
            'ethereum_balance' => $data['ethereum'],
            'solana_balance'   => $data['solana'],
            'ripple_balance'   => $data['ripple'],
            'usdt_balance'     => $data['usdt'],
            'polygon_balance'  => $data['polygon'],
        ]);

        return $this->dispatch('notify', 'User Crypto Balance Updated', 'success');
    }

    public function render()
    {
        return view('livewire.admin.edit-user.edit-crypto-accounts');
    }
}
