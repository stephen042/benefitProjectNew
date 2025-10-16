<x-layouts.admin :title="__('Dashboard')">
    <div class="container mx-auto space-y-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-6">
                <!-- All Customers Card -->
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-5 flex flex-col items-center justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10 text-green-500 dark:text-green-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM4.5 19.5a8.25 8.25 0 1 1 15 0" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">All Customers</h3>
                    <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-200">{{ $total_users }}</p>
                </div>

                <!-- Total Balance Card -->
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-5 flex flex-col items-center justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10 text-blue-500 dark:text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">Total Balance</h3>
                    <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-200">
                        ${{ number_format($total_balance, 2) }}
                    </p>
                </div>

                <!-- Subscription Balance Card -->
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-5 flex flex-col items-center justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10 text-yellow-500 dark:text-yellow-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">Subscription Balance</h3>
                    <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-200">
                        ${{ number_format($total_sub_balance, 2) }}
                    </p>
                </div>

                <!-- Total Withdrawn Card -->
                <div class="bg-white dark:bg-gray-900 shadow rounded-lg p-5 flex flex-col items-center justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10 text-red-500 dark:text-red-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m15 0-4-4m4 4-4 4" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">Total Withdrawn (Send)</h3>
                    <p class="mt-2 text-2xl font-bold text-gray-900 dark:text-gray-200">
                        ${{ number_format($total_withdraw, 2) }}
                    </p>
                </div>
            </div>
        </div>


        <!-- All Users Table -->
        <livewire:admin.all-users />

        <!-- Alert Component -->
        <x-alert />
    </div>
</x-layouts.admin>