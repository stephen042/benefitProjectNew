<div class="container mx-auto py-8">
    <div class="bg-gray-100 dark:bg-gray-900 shadow-lg rounded-xl overflow-hidden">
        <!-- Header -->
        <div class="p-6 border-b border-gray-700 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Trade History</h2>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-300">
                <thead class="text-gray-900 dark:text-gray-100">
                    <tr class="text-sm font-semibold">
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">S/N</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Date</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">But / Sell</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Trade Type</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Trade Asset</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Stake Amount ($)</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Status</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Profit ($)</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Loss ($)</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trades as $index => $trade)
                    <tr class="border-b border-gray-700  transition">
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $trade->created_at->format('d M, Y')
                            }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            @if ($trade->buy_sell == 2)
                            {{ "Sell" }}
                            @elseif ($trade->buy_sell == 1)
                            {{ "Buy" }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $trade->trade_type}}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">{{ $trade->trade_asset }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                            {{ number_format($trade->trade_amount, 2) }}
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($trade->trade_status == 3) bg-green-600 text-green-800 
                                    @elseif($trade->trade_status == 1) bg-yellow-500 text-yellow-800
                                    @else bg-red-600 text-red-800 @endif">
                                @if ($trade->trade_status == 3)
                                {{ "Completed" }}
                                @elseif ($trade->trade_status == 1)
                                {{ "Ongoing" }}
                                @else
                                {{ "Denied" }}
                                @endif
                            </span>
                        </td>
                        <!-- Profit -->
                        <td class="px-6 py-4">
                            @if ($trade->trade_status == 1)
                            <input type="number" step="0.01" wire:model.defer="profits.{{ $trade->id }}"
                                placeholder="Enter Profit"
                                class="w-24 bg-gray-800 text-green-400 border border-green-600 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-green-500">
                            @else
                            <span class="text-green-400">{{ number_format($trade->trade_profit, 2) }}</span>
                            @endif
                        </td>

                        <!-- Loss -->
                        <td class="px-6 py-4">
                            @if ($trade->trade_status == 1)
                            <input type="number" step="0.01" wire:model.defer="losses.{{ $trade->id }}"
                                placeholder="Enter Loss"
                                class="w-24 bg-gray-800 text-red-400 border border-red-600 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-red-500">
                            @else
                            <span class="text-red-400">{{ number_format($trade->trade_loss, 2) }}</span>
                            @endif
                        </td>


                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            <div class="flex space-x-2">
                                <!-- Delete Button -->
                                <button wire:click="deleteTrade({{ $trade->id }})"
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

                                @if ($trade->trade_status == 1)
                                <!-- Approve Button -->
                                <button wire:click="completeTrade({{ $trade->id }})" wire:loading.attr="disabled"
                                    wire:cofirm='Are you sure you want to complete this trade ?'
                                    class="flex items-center space-x-1 px-3 py-1 border border-green-600 text-green-600 text-xs font-semibold rounded hover:bg-green-600 hover:text-white transition">
                                    <!-- Check Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" wire:loading.remove>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span wire:loading.remove>Complete</span>
                                    <span wire:loading>Processing...</span>
                                </button>
                                @else
                                {{-- completed btn --}}
                                <button
                                    class="flex items-center space-x-1 px-3 py-1 border border-green-600 text-green-600 text-xs font-semibold rounded hover:bg-green-600 hover:text-white transition"
                                    disabled>
                                    <!-- Check Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Completed</span>
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
            {{ $trades->links('pagination::tailwind') }}
        </div>
    </div>
</div>