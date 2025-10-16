<?php

namespace App\Livewire\User;

use App\Mail\AppMail;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Models\Trade as ModelTrade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Trade extends Component
{
    public $data = [];

    #[Rule('required', message: 'Please Select Trade Type')]
    public $type;

    #[Rule('required', message: 'Please Select Trade Asset')]
    public $assets;

    #[Rule('required', message: 'Please Select duration')]
    public $duration;

    public $buy_sell; // New property to store Buy/Sell value

    public function updatedType()
    {
        if ($this->type == "Crypto") {

            return $this->data = [
                "empty" => "Please Click here to select asset",
                "Ripple XRP" => "Ripple XRP $0.00",
                "Evmos" => "Evmos EVMOS $0.00",
                "Link LN" => "Link LN $0.00",
                "Aurora AURORA" => "Aurora AURORA $0.00",
                "Bitcoin BTC" => "Bitcoin BTC $0.00",
                "Decentraland MANA" => "Decentraland MANA $0.00",
                "Token GT" => "Token GT $0.00",
                "Ethereum ETH" => "Ethereum ETH $0.00",
                "Telos TLOS" => "Telos TLOS $0.00",
                "Ethereum Classic ETC" => "Ethereum Classic ETC $0.00",
                "USD Coin USDC" => "USD Coin USDC $0.00",
                "Zcash ZEC" => "Zcash ZEC $0.00",
                "Bitcoin Cash BCH" => "Bitcoin Cash BCH $0.00",

            ];
        } elseif ($this->type == "Stocks") {
            return $this->data = [
                "empty" => "Please Click here to select asset",
                "ASML" => "ASML ASML $0.00",
                "TSLA" => "Tesla TSLA $0.00",
                "COST" => "Costco COST $0.00",
                "CL" => "Colgate-Palmolive CL $0.00",
                "CCO" => "Clear Channel Outdoor CCO $0.00",
                "PG" => "Procter &amp; Gamble PG $0.00",
                "GM" => "General Motors GM $0.00",
                "BABA" => "Alibaba BABA $0.00",
                "MSI" => "Motorola MSI $0.00",
                "WFC" => "Wells Fargo WFC $0.00",
                "RKLB" => "Rocket Lab RKLB $0.00",
                "GOOGL" => "Google GOOGL $0.00",
                "RWLK" => "ReWalk Robotics RWLK $0.00",
                "NVS" => "Novartis NVS $0.00",
                "NVDA" => "Nvidia NVDA $0.00",
                "ADBE" => "Adobe ADBE $0.00",
                "AMD" => "AMD AMD $0.00",
                "FB" => "Meta Platforms Inc FB $0.00",
                "RL" => "Ralph Lauren RL $0.00",
            ];
        } elseif ($this->type == "Forex") {
            return $this->data = [
                "empty" => "Please Click here to select asset",
                "AUDCAD" => "AUD/CAD",
                "USDCHF" => "USD/CHF",
                "CHFJPY" => "CHF/JPY",
                "GBPUSD" => "GBP/USD",
                "EURAUD" => "EUR/AUD",
                "EURCHF" => "EUR/CHF",
                "AUDUSD" => "AUD/USD",
                "AUDNZD" => "AUD/NZD",
                "AUDJPY" => "AUD/JPY",
                "EURJPY" => "EUR/JPY",
                "GBPJPY" => "GBP/JPY",
                "EURUSD" => "EUR/USD",
                "NZDUSD" => "NZD/USD",
                "EURCAD" => "EUR/CAD",
                "EURGBP" => "EUR/GBP",
                "GBPCHF" => "GBP/CHF",
            ];
        }
    }

    public $amount;

    protected $rules = [
        'amount' => ['required', 'numeric', 'min:100'],
    ];
    protected $messages = [
        'amount.required' => 'Please input amount',
        'amount.min' => 'Amount should be at least $100',
    ];

    public function updated($amount)
    {
        $this->validateOnly($amount);
    }

    public function trade($buy_sell)
    {
        $this->validate();

        $this->buy_sell = $buy_sell; // Assign Buy (1) or Sell (2)

        $user_id = Auth::user()->id;
        $account_balance = Auth::user()->sub_balance;

        if ($this->amount > $account_balance) {
            $this->dispatch('trade_insufficient_balance');
            return;
        }

        // Store trade logic here
        $store = ModelTrade::create([
            'user_id' => $user_id,
            'trade_type' => $this->type,
            'trade_asset' => $this->assets,
            'trade_amount' => $this->amount,
            'trade_duration' => $this->duration,
            'trade_status' => 1,
            'trade_profit' => 0,
            'trade_loss' => 0,
            'buy_sell' => $this->buy_sell, // Save Buy (1) or Sell (2)
        ]);

        // Update user account balance
        $user = Auth::user();
        $user->sub_balance -= $this->amount;
        $user->save();

        if ($store) {
            $amount = $this->amount;
            $userEmail = Auth::user()->email;
            $full_name = Auth::user()->name;
            $subject = "Trade Notification";

            $bodyUser = [
                "name" => $full_name,
                "title" => "Trade Notification",
                "message" => "Your Trade of $$amount was successfully placed on " . now() . ".
                <br><br> Details: <br>
                <strong>Trade Type:</strong> $this->type <br>
                <strong>Trade Asset:</strong> $this->assets <br>
                <strong>Trade Amount:</strong> $$this->amount <br>
                <strong>Trade Duration:</strong> $this->duration <br>
                <strong>Trade Status:</strong> Ongoing... <br>"
            ];
            $bodyAdmin = [
                "name" => "Admin",
                "title" => "Customer Trade Request",
                "message" => "A user named $full_name made a Trade request of $$amount on " . now() . "."
            ];

            try {
                // Send email
                Mail::to($userEmail)->send(new AppMail($subject, $bodyUser));
                Mail::to(config('app.Admin_email'))->send(new AppMail($subject, $bodyAdmin));

                // Dispatch an event that Livewire listens to
                $this->dispatch('trade-submitted');
            } catch (\Throwable $th) {
                $this->dispatch('trade-error');
            }

            return $this->reset();
        }
    }

    public function render()
    {
        return view('livewire.user.trade');
    }
}
