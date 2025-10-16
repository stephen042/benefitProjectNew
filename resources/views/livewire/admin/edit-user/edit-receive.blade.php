<div>
    <div class="bg-gray-100 dark:bg-gray-900 shadow-lg rounded-xl overflow-hidden">
        <!-- Header -->
        <div class="p-6 border-b border-gray-700 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Receive History (Deposit)</h2>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-300">
                <thead class=" text-gray-900 dark:text-gray-100">
                    <tr class="text-sm font-semibold">
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">S/N</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Date</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Amount ($)</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Received for</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Proof IMG</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Status</th>
                        <th class="px-6 py-4 text-gray-900 dark:text-gray-100">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deposits as $index => $deposit)
                    <tr class="border-b border-gray-700 transition">
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $deposit->created_at->format('d M, Y')
                            }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                            {{ number_format($deposit->amount, 2) }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-100">
                            @if ($deposit->receiving_for == 1)
                            {{ "Net Balance" }}
                            @elseif ($deposit->receiving_for == 2)
                            {{ "Subscription Balance" }}
                            @endif
                        </td>

                        <td class="px-6 py-2 text-gray-900 dark:text-gray-100">
                            @if ($deposit->proof)
                            <a href="{{ asset('storage/' . $deposit->proof) }}" target="_blank">
                                <img src="{{ asset('storage/' . $deposit->proof) }}" alt="Proof Image"
                                    class="w-16 h-16 object-cover rounded-lg">
                            </a>
                            @else
                            <span class="text-red-500">No Image</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($deposit->status == 3) bg-green-600 text-green-800 
                                    @elseif($deposit->status == 1) bg-yellow-500 text-yellow-800
                                    @else bg-red-600 text-red-800 @endif">
                                @if ($deposit->status == 3)
                                {{ "Completed" }}
                                @elseif ($deposit->status == 1)
                                {{ "Pending" }}
                                @else
                                {{ "Denied" }}
                                @endif
                            </span>
                        </td>

                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                            <div class="flex space-x-2">
                                <!-- Delete Button -->
                                <button wire:click="deleteDeposit({{ $deposit->id }})"
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

                                @if ($deposit->status == 1)
                                <!-- Approve Button -->
                                <button wire:click="approveDeposit({{ $deposit->id }})" wire:loading.attr="disabled"
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
                                <button wire:click="denyDeposit({{ $deposit->id }})" wire:loading.attr="disabled"
                                    wire:loading.class="cursor-not-allowed opacity-50" wire:target="denyDeposit"
                                    class="flex items-center space-x-1 px-3 py-1 border border-yellow-600 text-yellow-600 text-xs font-semibold rounded hover:bg-yellow-600 hover:text-white transition">
                                    <!-- X Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" wire:loading.remove
                                        wire:target="denyDeposit">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span wire:loading.remove wire:target="denyDeposit">Deny</span>
                                    <span wire:loading wire:target="denyDeposit">Processing...</span>
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
            {{ $deposits->links('pagination::tailwind') }}
        </div>
    </div>
</div>