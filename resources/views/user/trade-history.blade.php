<x-layouts.app :title="__('Trade History')">
    <div class="container mx-auto py-8">
        <div class="bg-gray-900 shadow-lg rounded-xl overflow-hidden">
            <!-- Header -->
            <div class="p-6 border-b border-gray-700 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-200">Trade History</h2>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-300">
                    <thead class="bg-gray-800 text-gray-400">
                        <tr class="text-sm font-semibold">
                            <th class="px-6 py-4">S/N</th>
                            <th class="px-6 py-4">Trade Type</th>
                            <th class="px-6 py-4">Trade Asset</th>
                            <th class="px-6 py-4">Stake Amount ($)</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Buy / Sell</th>
                            <th class="px-6 py-4">Profit ($)</th>
                            <th class="px-6 py-4">Loss ($)</th>
                            <th class="px-6 py-4">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trades as $index => $trade)
                        <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $trade->trade_type }}</td>
                            <td class="px-6 py-4">{{ $trade->trade_asset }}</td>
                            <td class="px-6 py-4 font-medium text-gray-100">
                                {{ number_format($trade->trade_amount, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        @if($trade->trade_status == 3) bg-green-600 text-white 
                                        @elseif($trade->trade_status == 1) bg-yellow-500 text-black 
                                        @else bg-red-600 text-white @endif">
                                    @if ($trade->trade_status == 3)
                                    {{ "Completed" }}
                                    @elseif ($trade->trade_status == 1)
                                    {{ "Ongoing" }}
                                    @else
                                    {{ "Denied" }}
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($trade->buy_sell == 2)
                                {{ "Sell" }}
                                @elseif ($trade->buy_sell == 1)
                                {{ "Buy" }}
                                @endif
                            </td>
                            <td class="px-6 py-4 text-green-400"> {{ number_format($trade->trade_profit, 2) }}</td>
                            <td class="px-6 py-4 text-red-400"> {{ number_format($trade->trade_profit, 2) }}</td>
                            <td class="px-6 py-4 text-gray-400">
                                {{ $trade->created_at->format('d M, Y') }}
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
</x-layouts.app>