<x-layouts.app :title="__('Dashboard')">
    <div class="container mx-auto">
        <!-- Main Card Wrapper -->
        <div
            class="flex flex-col lg:flex-col lg:items-center gap-4 lg:border lg:border-gray-300 dark:lg:border-gray-700 rounded-2xl">
            <!-- Account Balance Card -->
            <div class="p-4 flex flex-col items-center justify-center lg:w-full">
                <!-- Account balance value -->
                <div class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                    ${{ number_format((float) (auth()->user()->balance ?? 0), 2) }}
                </div>
                <!-- Gained money indicator -->
                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mt-1">
                    <span>Sub Bal - ${{ number_format((float) (auth()->user()->sub_balance ?? 0), 2) }}</span>
                </div>
            </div>

            <!-- Transaction Actions Card -->
            <div class="p-4 flex flex-col items-center lg:w-full">
                <div class="flex space-x-3">
                    <!-- Receive -->
                    <a href="{{ route('user.receive') }}"
                        class="flex flex-col items-center border-2 border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 w-20 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        <flux:icon.download class="w-8 h-8 text-purple-200" />
                        <span class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-medium">Receive</span>
                    </a>
                    <!-- Send -->
                    <a href="{{ route('user.send') }}"
                        class="flex flex-col items-center border-2 border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 w-20 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        <flux:icon.paper-airplane class="w-8 h-8 text-purple-200" />
                        <span class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-medium">Send</span>
                    </a>
                    <!-- Swap -->
                    <a href="{{ route('user.swap') }}"
                        class="flex flex-col items-center border-2 border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 w-20 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        <flux:icon.repeat class="w-8 h-8 text-purple-200" />
                        <span class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-medium">Swap</span>
                    </a>
                    <!-- Buy -->
                    <a href="{{ route('user.trade') }}"
                        class="flex flex-col items-center border-2 border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 w-20 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                        <flux:icon.currency-dollar class="w-8 h-8 text-purple-200" />
                        <span class="mt-1 text-sm text-gray-900 dark:text-gray-100 font-medium">Trade</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Crypto List Section -->
        <div class="mt-12 mb-16">
            <!-- Grid: full-width on mobile, 3 columns on large screens -->
            <div class="grid grid-cols-1 gap-2 lg:grid-cols-2">
                <!-- Solana -->
                <div
                    class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700">
                    <div class="flex items-center space-x-2">
                        <!-- image -->
                        <img src="{{ asset('assets/user_assets/img/solana.jpg') }}" alt="Solana"
                            class="w-10 h-10 rounded-full object-cover">
                        <div class="flex flex-col">
                            <span class="text-gray-900 dark:text-gray-100 font-medium">Solana</span>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <span><b>SOL</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-900 dark:text-gray-100 font-semibold">${{ number_format((float)
                            ($crypto_accounts->solana_balance ?? 0), 2) }}</span>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{-- <span>+0.00</span> --}}
                        </div>
                    </div>
                </div>

                <!-- ETH -->
                <div
                    class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700">
                    <div class="flex items-center space-x-2">
                        <!-- image -->
                        <img src="{{ asset('assets/user_assets/img/ethereum.png') }}" alt="eth"
                            class="w-10 h-10 rounded-full object-cover">
                        <div class="flex flex-col">
                            <span class="text-gray-900 dark:text-gray-100 font-medium">Ethereum</span>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <span><b>ETH</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-900 dark:text-gray-100 font-semibold">${{ number_format((float)
                            ($crypto_accounts->ethereum_balance ?? 0), 2) }}</span>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{-- <span>+0.00</span> --}}
                        </div>
                    </div>
                </div>

                <!-- USDT -->
                <div
                    class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700">
                    <div class="flex items-center space-x-2">
                        <!-- image -->
                        <img src="{{ asset('assets/user_assets/img/tether-usdt.jpg') }}" alt="usdt"
                            class="w-10 h-10 rounded-full object-cover">
                        <div class="flex flex-col">
                            <span class="text-gray-900 dark:text-gray-100 font-medium">USDT Tether</span>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <span><b>USDT</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-900 dark:text-gray-100 font-semibold">${{ number_format((float)
                            ($crypto_accounts->usdt_balance ?? 0), 2) }}</span>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{-- <span></span> --}}
                        </div>
                    </div>
                </div>

                <!-- Bitcoin -->
                <div
                    class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700">
                    <div class="flex items-center space-x-2">
                        <!-- image -->
                        <img src="{{ asset('assets/user_assets/img/bitcoin.jpg') }}" alt="eth"
                            class="w-10 h-10 rounded-full object-cover">
                        <div class="flex flex-col">
                            <span class="text-gray-900 dark:text-gray-100 font-medium">Bitcoin</span>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <span><b>BTC</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-900 dark:text-gray-100 font-semibold">${{ number_format((float)
                            ($crypto_accounts->bitcoin_balance ?? 0), 2) }}</span>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{-- <span>+0.00</span> --}}
                        </div>
                    </div>
                </div>

                <!-- Polygon -->
                <div
                    class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700">
                    <div class="flex items-center space-x-2">
                        <!-- image -->
                        <img src="{{ asset('assets/user_assets/img/polygon.png') }}" alt="pol"
                            class="w-10 h-10 rounded-full object-cover">
                        <div class="flex flex-col">
                            <span class="text-gray-900 dark:text-gray-100 font-medium">Polygon</span>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <span><b>POL</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-900 dark:text-gray-100 font-semibold">${{ number_format((float)
                            ($crypto_accounts->polygon_balance ?? 0), 2) }}</span>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{-- <span>+0.00</span> --}}
                        </div>
                    </div>
                </div>

                <!-- XRP -->
                <div
                    class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700">
                    <div class="flex items-center space-x-2">
                        <!-- image -->
                        <img src="{{ asset('assets/user_assets/img/xrp-logo.png') }}" alt="pol"
                            class="w-10 h-10 rounded-full object-cover">
                        <div class="flex flex-col">
                            <span class="text-gray-900 dark:text-gray-100 font-medium">Ripple</span>
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                <span><b>XRP</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-gray-900 dark:text-gray-100 font-semibold">${{ number_format((float)
                            ($crypto_accounts->ripple_balance ?? 0), 2) }}</span>
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{-- <span>+0.00</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>