<div>
    <x-action-message class="my-3" on="send_insufficient_balance" type="error">
        {{ __('Insufficient balance') }}
    </x-action-message>
    <form wire:submit.prevent="StoreSend">
        <div class="flex flex-col p-3 rounded-lg lg:w-1/2 max-w-sm my-2 space-y-4">
            <flux:select wire:model.blur="currency" description="Select Crypto Currency">
                <option>Select</option>
                <flux:select.option value="bitcoin">Bitcoin</flux:select.option>
                {{-- <flux:select.option value="solana">Solana</flux:select.option> --}}
                <flux:select.option value="ethereum">Ethereum</flux:select.option>
                <flux:select.option value="ripple">Ripple</flux:select.option>
                <flux:select.option value="usdt">Tether (USDT)</flux:select.option>
                <flux:select.option value="polygon">Polygon (MATIC)</flux:select.option>
                <flux:select.option value="ripple">Ripple</flux:select.option>
            </flux:select>

            <flux:input wire:model.live="amount" type="number" description="Amount to Send ($)" placeholder="50000" />

            <flux:input wire:model="wallet_address" type="text" description="Crypto Currency's Wallet Address"  placeholder="7uoq...Xs6y" />
            
            <flux:button variant="primary" type="submit"
                class="mt-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold py-1 px-3 rounded-lg flex items-center justify-center gap-1">
                <flux:icon.paper-airplane class="w-4 h-4 inline-flex mb-1" />
                {{ __('Send') }}
            </flux:button>

            <x-action-message class="my-3" on="send-submitted">
                {{ __('Your Send request is on progress.') }}
            </x-action-message>

            <x-action-message class="my-3" on="send-error" type="error">
                {{ __('Email was not sent:) an error occurred') }}
            </x-action-message>
        </div>
    </form>
</div>