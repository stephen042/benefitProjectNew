<div>
    <form wire:submit.prevent="receive">
        <div class="flex flex-col p-3 rounded-lg lg:w-1/2 max-w-sm my-1">
            <flux:input wire:model.live="amount" type="number" description="Amount to receive ($)" placeholder="1000"
                wire:model.blur='amount' />
        </div>

        <div class="flex flex-col items-center p-3  rounded-lg w-full max-w-sm">
            <!-- File Upload -->
            <label
                class="flex flex-col items-center justify-center w-full cursor-pointer border-2  dark:border-gray-700">
                <input type="file" class="hidden" wire:model.live="proof">
                <div class="w-full h-32 flex items-center justify-center bg-gray-100 dark:bg-gray-800 rounded-lg">
                    @if ($proof)
                    <img src="{{ $proof->temporaryUrl() }}" class="w-full h-full object-cover rounded-lg" />
                    @else
                    <flux:icon.upload class="w-8 h-8 text-gray-400" />
                    <p class="mt-1 text-xs text-gray-600 dark:text-gray-300"> Tap to upload Proof of Payment</p>
                    @endif
                </div>
            </label>
            @error('proof')
            <p class="text-red-500 text-sm italic my-1">{{ $message }}</p>
            @enderror

            <hr class="w-full mt-5 border-1 border-gray-200 dark:border-gray-300" />
            <!-- Send Button -->
            <flux:button variant="primary" type="submit"
                class="mt-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold py-1 px-3 rounded-lg flex items-center justify-center gap-1">
                <flux:icon.paper-airplane class="w-4 h-4 inline-flex mb-1" />
                {{ __('Done') }}
            </flux:button>

            <x-action-message class="my-3" on="receive-submitted" type="success">
                {{ __('Your Receive request is on progress.') }}
            </x-action-message>

            <x-action-message class="my-3" on="receive-error" type="error">
                {{ __('Email was not sent:) an error occurred') }}
            </x-action-message>

        </div>
    </form>
</div>