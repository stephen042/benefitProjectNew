<div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Admin Cryptocurrency Addresses</h2>

    <form wire:submit.prevent="updateCryptoAddress">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Bitcoin address -->
            <div>
                <label for="bitcoin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bitcoin
                    address</label>
                <input type="text" id="bitcoin" wire:model="bitcoin" placeholder="Enter Bitcoin address"
                    class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:text-white">
            </div>
            <!-- Ethereum address -->
            <div>
                <label for="ethereum" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ethereum
                    address</label>
                <input type="text" id="ethereum" wire:model="ethereum" placeholder="Enter Ethereum address"
                    class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:text-white">
            </div>
            <!-- Solana address -->
            <div>
                <label for="solana" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Solana
                    address</label>
                <input type="text" id="solana" wire:model="solana" placeholder="Enter Solana address"
                    class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:text-white">
            </div>
            <!-- Ripple address -->
            <div>
                <label for="ripple" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ripple
                    address</label>
                <input type="text" id="ripple" wire:model="ripple" placeholder="Enter Ripple address"
                    class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:text-white">
            </div>
            <!-- USDT address -->
            <div>
                <label for="usdt" class="block text-sm font-medium text-gray-700 dark:text-gray-300">USDT
                    address</label>
                <input type="text" id="usdt" wire:model="usdt" placeholder="Enter USDT address"
                    class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:text-white">
            </div>
            <!-- Polygon address -->
            <div>
                <label for="polygon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Polygon
                    address</label>
                <input type="text" id="polygon" wire:model="polygon" placeholder="Enter Polygon address"
                    class="mt-1 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:text-white">
            </div>
        </div>
        <!-- Update Button -->
        <div class="mt-6">
            <button type="submit"
                class="w-full mt-3 bg-purple-600 hover:bg-purple-700 text-white text-sm font-semibold py-2 px-3 rounded-lg flex items-center justify-center gap-1">
                <!-- You can replace the icon below with your preferred icon component or SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-flex mb-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Update</span>
            </button>
        </div>
    </form>
    <x-alert />
</div>