<div class="shadow rounded-xl p-6">
    <!-- Card Header -->
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Signal Strength</h3>

    <!-- Progress Bar -->
    <div class="border-t border-gray-500 w-full py-2 my-5 mx-3">
        <div class="relative w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
            <!-- Dynamic Progress Bar -->
            <div class="bg-red-500 h-3 rounded-full transition-all duration-300 relative"
                style="width: {{$user->signal_strength}}%;">
                <!-- Progress Value Text -->
                <span class="absolute right-2 top-1/2 transform -translate-y-1/2 text-xs text-white font-semibold">
                    {{$user->signal_strength}}%
                </span>
            </div>
        </div>
    </div>

    <!-- Input to Edit Progress with Button -->
    <form wire:submit.prevent="updateSignalStrength">
        <div class="mt-4">
            <label for="progressInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Edit Signal Strength
            </label>
            <div class="flex">
                <input type="number" id="progressInput" wire:model="signal_strength"
                    placeholder="Enter progress percentage"
                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-l-md focus:outline-none focus:ring-red-500 focus:border-red-200 dark:bg-gray-700 dark:text-gray-200">
                <button type="submit"
                    class="px-4 py-2 bg-red-500 text-white font-semibold rounded-r-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Update
                </button>
            </div>
            @error('signal_strength')
                <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>
    </form>
</div>