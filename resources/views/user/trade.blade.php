<x-layouts.app :title="__('Dashboard')">
    <div class="container">
        <div class="space-y-0.5 text-xs">
            <div class="flex justify-between items-center lg:w-1/2">
                <span class="text-gray-900 dark:text-gray-100">Earning:</span>
                <span class="text-gray-900 dark:text-gray-100 font-semibold">${{ number_format(auth()->user()->balance,2)
                    }}</span>
            </div>

            <div class="flex justify-between items-center lg:w-1/2">
                <span class="text-gray-900 dark:text-gray-100">Balance:</span>
                <span class="text-gray-900 dark:text-gray-100 font-semibold">${{ number_format(auth()->user()->sub_balance,
                    2) }}</span>
            </div>

            <a href="{{ route('user.send.history') }}">
                <div class="flex justify-between items-center lg:w-1/2">
                    <span class="text-gray-900 dark:text-gray-100">Withdrawal:</span>
                    <span class="text-gray-900 dark:text-gray-100 font-semibold">${{number_format($amount,2)}}</span>
                </div>
            </a>
        </div>



        <!-- Progress Bar Card -->
        <div class="border-t border-gray-500 lg:w-1/2 w-full max-w-md py-2 my-5 mx-3">
            <div class="text-center">
                <span class="text-gray-900 dark:text-gray-100 font-semibold">Trade Progress</span>
            </div>

            <div class="relative w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                <!-- Progress Bar -->
                <div class="bg-blue-500 h-3 rounded-full transition-all duration-300 relative"
                    style="width: {{auth()->user()->progress_bar_status}}%;">
                    <!-- Progress Value Text -->
                    <span class="absolute right-2 top-1/2 transform -translate-y-1/2 text-xs text-white font-semibold">
                        {{auth()->user()->progress_bar_status}}%
                    </span>
                </div>
            </div>
        </div>


        <!-- Progress Bar Card -->
        <div class="border-t border-gray-500 lg:w-1/2 w-full max-w-md py-2 my-5 mx-3">
            <div class="text-center mt-2 mb-2">
                <span class="text-gray-900 dark:text-gray-100 font-semibold">Signal Strength</span>
            </div>

            <div class="relative w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                <!-- Progress Bar -->
                <div class="bg-green-400 h-3 rounded-full transition-all duration-300 relative"
                    style="width: {{auth()->user()->signal_strength}}%;">
                    <!-- Progress Value Text -->
                    <span class="absolute right-2 top-1/2 transform -translate-y-1/2 text-xs text-white font-semibold">
                        {{auth()->user()->signal_strength}}%
                    </span>
                </div>
            </div>
        </div>

        <livewire:user.trade />
    </div>
</x-layouts.app>