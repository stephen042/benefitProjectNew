<div class="container mx-auto py-8">
    <div class="bg-gray-100 dark:bg-gray-900 shadow-lg rounded-xl overflow-hidden">
        <!-- Header -->
        <div class="p-6 border-b border-gray-700 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Send History (Withdraw)</h2>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-300">
                <thead class="text-gray-900 dark:text-gray-100">
                    <tr class="text-sm font-semibold">
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">S/N</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Date</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Amount ($)</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Wallet Address</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Crypto Currency</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Status</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($withdraws as $index => $withdraw)
                    <tr class="border-b border-gray-700  transition">
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $withdraw->created_at->format('d M, Y') }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                            {{ number_format($withdraw->amount, 2) }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                            {{ $withdraw->wallet_address }}
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $withdraw->crypto_currency }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($withdraw->status == 3) bg-green-600 text-green-800 
                                    @elseif($withdraw->status == 1) bg-yellow-500 text-yellow-800
                                    @else bg-red-600 text-red-800 @endif">
                                @if ($withdraw->status == 3)
                                {{ "Completed" }}
                                @elseif ($withdraw->status == 1)
                                {{ "Pending" }}
                                @else
                                {{ "Denied" }}
                                @endif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            <div class="flex space-x-2">
                                <!-- Delete Button -->
                                <button wire:click="deleteWithdraw({{ $withdraw->id }})"
                                    wire:confirm='Are you sure you want to delete this transaction ?'
                                    class="flex items-center space-x-1 px-3 py-1 border border-red-600 text-red-600 text-xs font-semibold rounded hover:bg-red-600 hover:text-white transition">
                                    <!-- Trash Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span>Delete</span>
                                </button>

                                @if ($withdraw->status == 1)
                                <!-- Approve Button -->
                                <button wire:click="approveWithdraw({{ $withdraw->id }})" wire:loading.attr="disabled"
                                    class="flex items-center space-x-1 px-3 py-1 border border-green-600 text-green-600 text-xs font-semibold rounded hover:bg-green-600 hover:text-white transition">
                                    <!-- Check Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" wire:loading.remove>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span wire:loading.remove>Approve</span>
                                    <span wire:loading>Processing...</span>
                                </button>

                                <!-- Deny Button -->
                                <button wire:click="denyWithdraw({{ $withdraw->id }})" wire:loading.attr="disabled"
                                    wire:loading.class="cursor-not-allowed opacity-50" wire:target="denyWithdraw"
                                    class="flex items-center space-x-1 px-3 py-1 border border-yellow-600 text-yellow-600 text-xs font-semibold rounded hover:bg-yellow-600 hover:text-white transition">
                                    <!-- X Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" wire:loading.remove
                                        wire:target="denyWithdraw">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span wire:loading.remove wire:target="denyWithdraw">Deny</span>
                                    <span wire:loading wire:target="denyWithdraw">Processing...</span>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 bg-gray-900 border-t border-gray-700">
            {{ $withdraws->links('pagination::tailwind') }}
        </div>
    </div>
</div>
