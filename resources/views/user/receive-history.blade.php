<x-layouts.app :title="__('Receive History')">
    <div class="container mx-auto py-8">
        <div class="bg-gray-900 shadow-lg rounded-xl overflow-hidden">
            <!-- Header -->
            <div class="p-6 border-b border-gray-700 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-200">Receive History</h2>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-300">
                    <thead class="bg-gray-800 text-gray-400">
                        <tr class="text-sm font-semibold">
                            <th class="px-6 py-4">S/N</th>
                            <th class="px-6 py-4">Date</th>
                            <th class="px-6 py-4">Amount ($)</th>
                            <th class="px-6 py-4">Received for</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deposits as $index => $deposit)
                        <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $deposit->created_at->format('d M, Y') }}</td>
                            <td class="px-6 py-4 font-medium text-gray-100">
                                {{ number_format($deposit->amount, 2) }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-100">
                                @if ($deposit->receiving_for == 1)
                                {{ "Net Balance" }}
                                @elseif ($deposit->receiving_for == 2)
                                {{ "Subscription Balance" }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        @if($deposit->status == 3) bg-green-600 text-white 
                                        @elseif($deposit->status == 1) bg-yellow-500 text-black 
                                        @else bg-red-600 text-white @endif">
                                    @if ($deposit->status == 3)
                                    {{ "Completed" }}
                                    @elseif ($deposit->status == 1)
                                    {{ "Pending" }}
                                    @else
                                    {{ "Denied" }}
                                    @endif
                                </span>
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
</x-layouts.app>