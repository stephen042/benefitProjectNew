<x-layouts.admin :title="__('Edit User')">
    <div class="container mx-auto space-y-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total Balance Card -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5 flex flex-col items-center">
                    <!-- Icon (wallet) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-blue-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">Balance</h3>
                    <p class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">{{ number_format($user->balance,
                        2) }}</p>
                </div>

                <!-- Subscription Balance Card -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5 flex flex-col items-center">
                    <!-- Icon (subscription) -->
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.105 0-2 .895-2 2v4c0 1.105.895 2 2 2s2-.895 2-2v-4c0-1.105-.895-2-2-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2 12h2m16 0h2m-10-10v2m0 16v2m8.485-8.485l1.414-1.414m-16.97 0l1.414 1.414m12.02-12.02l1.414-1.414m-12.02 0l1.414 1.414" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">Subscription Balance</h3>
                    <p class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">{{
                        number_format($user->sub_balance, 2) }}</p>
                </div>

                <!-- Total Withdrawn Card -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5 flex flex-col items-center">
                    <!-- Icon (withdraw) -->
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0l-4-4m4 4l-4 4" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">Total Withdrawn (send)</h3>
                    <p class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">{{
                        number_format($user->total_withdraw, 2) }}</p>
                </div>

                <!-- Total Deposit Card -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-5 flex flex-col items-center">
                    <!-- Icon (deposit) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">Total Deposit (receive)</h3>
                    <p class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-100">{{
                        number_format($user->total_receive, 2) }}</p>
                </div>

            </div>
        </div>


        <livewire:admin.edit-user.edit-crypto-accounts :user="$user" />
        <livewire:admin.edit-user.account-top-up :user="$user" />
        <livewire:admin.edit-user.edit-progress-bar :user="$user" />
        <livewire:admin.edit-user.edit-signal-strength :user="$user" />
        <livewire:admin.edit-user.edit-receive :user="$user" />
        <livewire:admin.edit-user.edit-send :user="$user" />
        <livewire:admin.edit-user.edit-trade :user="$user" />

        <x-alert />
    </div>
</x-layouts.admin>