<div>
    <form class="p-2 rounded-lg shadow-lg w-full max-w-md mb-16">
        <!-- type Select -->
        <div class="mb-4">
            <label for="assets" class="block text-gray-300 text-sm font-medium mb-2">Select Type</label>
            <flux:select id="assets" wire:model.live="type"
                class="w-full p-2 border rounded bg-gray-700 text-white focus:ring-2 focus:ring-blue-500">
                <flux:select.option>Select Trade type</flux:select.option>
                <flux:select.option value="Forex">Forex</flux:select.option>
                <flux:select.option value="Crypto">Crypto</flux:select.option>
                <flux:select.option value="Stocks">Stocks</flux:select.option>
            </flux:select>
            @error('type')
            <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Assets Select -->
        <div class="mb-4">
            <label for="assets" class="block text-gray-300 text-sm font-medium mb-2">Select Asset</label>
            <flux:select id="assets" wire:model.live="assets"
                class="w-full p-2 border rounded bg-gray-700 text-white focus:ring-2 focus:ring-blue-500">
                @forelse ($data as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
                @empty
                <option disabled>Please select trade type above</option>
                @endforelse
            </flux:select>
            @error('assets')
            <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Amount Input -->
        <div class="mb-4">
            <label for="amount" class="block text-gray-300 text-sm font-medium mb-2">Amount</label>
            <flux:input wire:model.live="amount" type="number" placeholder="1000" />
            @error('amount')
            <span class="text-red-400 text-sm mt-5">{{ $message }}</span>
            @enderror
        </div>

        <!-- Duration Select -->
        <div class="mb-6">
            <label for="duration" class="block text-gray-300 text-sm font-medium mb-2">Duration</label>
            <flux:select id="duration" wire:model.live="duration"
                class="w-full p-2 border rounded bg-gray-700 text-white focus:ring-2 focus:ring-blue-500">
                <flux:select.option>select trade duration</flux:select.option>
                <flux:select.option value="2 minutes">2 minutes</flux:select.option>
                <flux:select.option value="5 minutes">5 minutes</flux:select.option>
                <flux:select.option value="10 minutes">10 minutes</flux:select.option>
                <flux:select.option value="30 minutes">30 minutes</flux:select.option>
                <flux:select.option value="1 hour">1 hour</flux:select.option>
                <flux:select.option value="2 hours">2 hours</flux:select.option>
                <flux:select.option value="4 hours">4 hours</flux:select.option>
                <flux:select.option value="6 hours">6 hours</flux:select.option>
                <flux:select.option value="8 hours">8 hours</flux:select.option>
                <flux:select.option value="10 hours">10 hours</flux:select.option>
                <flux:select.option value="20 hours">20 hours</flux:select.option>
                <flux:select.option value="1 day">1 day</flux:select.option>
                <flux:select.option value="2 days">2 days</flux:select.option>
                <flux:select.option value="3 days">3 days</flux:select.option>
                <flux:select.option value="4 days">4 days</flux:select.option>
                <flux:select.option value="5 days">5 days</flux:select.option>
                <flux:select.option value="6 days">6 days</flux:select.option>
                <flux:select.option value="1 weeks">1 weeks</flux:select.option>
                <flux:select.option value="2 weeks">2 weeks</flux:select.option>
            </flux:select>
            @error('duration')
            <span class="text-red-400 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <!-- Buttons (Buy & Sell) -->
        <div class="flex justify-between">
            <flux:button variant="primary" type="button" wire:click="trade(1)"
                class="w-1/2 bg-blue-500 text-white p-2 rounded-lg font-medium hover:bg-blue-600 transition">
                {{ __('Buy') }}
            </flux:button>

            <flux:button variant="primary" type="button" wire:click="trade(2)"
                class="w-1/2 bg-red-500 text-white p-2 rounded-lg font-medium hover:bg-red-600 transition ml-2">
                {{ __('Sell') }}
            </flux:button>
        </div>
        <x-action-message class="my-3" on="trade-submitted" type="success">
            {{ __('Your Trade is on progress.') }}
        </x-action-message>

        <x-action-message class="my-3" on="trade-error" type="error">
            {{ __('Email was not sent:) an error occurred') }}
        </x-action-message>

        <x-action-message class="my-3" on="trade_insufficient_balance" type="error">
            {{ __('Insufficient funds to place this trade') }}
        </x-action-message>
    </form>
</div>