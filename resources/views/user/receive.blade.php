<x-layouts.app :title="__('Receive')">
    <div class="container mx-auto">

        <livewire:user.receive>
            <!-- Crypto List Section -->
            <div class="mt-12 mb-16">
                <!-- Grid: full-width on mobile, 3 columns on large screens -->
                <div class="grid grid-cols-1 gap-3 lg:grid-cols-1">
                    <!-- Solana -->
                    <div
                        class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 lg:w-1/2">
                        <div class="flex items-center space-x-2">
                            <!-- Image -->
                            <img src="{{ asset('assets/user_assets/img/solana.jpg') }}" alt="Solana"
                                class="w-10 h-10 rounded-xl object-cover">
                            <div class="flex flex-col">
                                <span class="text-gray-900 dark:text-gray-100 font-medium">Solana</span>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span>
                                        <input type="text" class="border-0 bg-transparent p-0" id="addressCopySolana"
                                            value="{{ $admin_wallets->solana_address }}" readonly
                                            style="overflow-x: auto; white-space: nowrap; display: none;">
                                        @if ($admin_wallets->solana_address != 'Not Available')
                                            {{ substr($admin_wallets->solana_address, 0, 10) . '...' . substr($admin_wallets->solana_address, -6) }}
                                        @else
                                            Not Available
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="relative flex items-center space-x-2">
                            <!-- Copy Button -->
                            <button onclick="copyFunctionSolana()"
                                class="flex flex-col me-4 rounded-3xl bg-gray-800 text-white p-3 hover:bg-gray-700 transition"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2">
                                    </rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- ETH -->
                    <div
                        class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 lg:w-1/2">
                        <div class="flex items-center space-x-2">
                            <!-- image -->
                            <img src="{{ asset('assets/user_assets/img/ethereum.png') }}" alt="eth"
                                class="w-10 h-10 rounded-xl object-cover">
                            <div class="flex flex-col">
                                <span class="text-gray-900 dark:text-gray-100 font-medium">Ethereum</span>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span>
                                        <input type="text" class="border-0 bg-transparent p-0"
                                            id="addressCopyEthereum" value="{{ $admin_wallets->ethereum_address }}"
                                            readonly style="overflow-x: auto; white-space: nowrap; display: none;">
                                        @if ($admin_wallets->ethereum_address != 'Not Available')
                                            {{ substr($admin_wallets->ethereum_address, 0, 10) . '...' . substr($admin_wallets->ethereum_address, -6) }}
                                        @else
                                            Not Available
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="relative flex items-center space-x-2">
                            <!-- Copy Button -->
                            <button onclick="copyFunctionEthereum()"
                                class="flex flex-col me-4 rounded-3xl bg-gray-800 text-white p-3 hover:bg-gray-700 transition"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2">
                                    </rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- USDT -->
                    <div
                        class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 lg:w-1/2">
                        <div class="flex items-center space-x-2">
                            <!-- image -->
                            <img src="{{ asset('assets/user_assets/img/tether-usdt.jpg') }}" alt="usdt"
                                class="w-10 h-10 rounded-xl object-cover">
                            <div class="flex flex-col">
                                <span class="text-gray-900 dark:text-gray-100 font-medium">USDT Tether</span>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span>
                                        <input type="text" class="border-0 bg-transparent p-0" id="addressCopyTether"
                                            value="{{ $admin_wallets->usdt_address }}" readonly
                                            style="overflow-x: auto; white-space: nowrap; display: none;">
                                        @if ($admin_wallets->usdt_address != 'Not Available')
                                            {{ substr($admin_wallets->usdt_address, 0, 10) . '...' . substr($admin_wallets->usdt_address, -6) }}
                                        @else
                                            Not Available
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="relative flex items-center space-x-2">
                            <!-- Copy Button -->
                            <button onclick="copyFunctionTether()"
                                class="flex flex-col me-4 rounded-3xl bg-gray-800 text-white p-3 hover:bg-gray-700 transition"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2">
                                    </rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Bitcoin -->
                    <div
                        class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 lg:w-1/2">
                        <div class="flex items-center space-x-2">
                            <!-- image -->
                            <img src="{{ asset('assets/user_assets/img/bitcoin.jpg') }}" alt="BTC"
                                class="w-10 h-10 rounded-xl object-cover">
                            <div class="flex flex-col">
                                <span class="text-gray-900 dark:text-gray-100 font-medium">Bitcoin</span>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span>
                                        <input type="text" class="border-0 bg-transparent p-0"
                                            id="addressCopyBitcoin" value="{{ $admin_wallets->bitcoin_address }}"
                                            readonly style="overflow-x: auto; white-space: nowrap; display: none;">
                                        @if ($admin_wallets->bitcoin_address != 'Not Available')
                                            {{ substr($admin_wallets->bitcoin_address, 0, 10) . '...' . substr($admin_wallets->bitcoin_address, -6) }}
                                        @else
                                            Not Available
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="relative flex items-center space-x-2">
                            <!-- Copy Button -->
                            <button onclick="copyFunctionBitcoin()"
                                class="flex flex-col me-4 rounded-3xl bg-gray-800 text-white p-3 hover:bg-gray-700 transition"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2">
                                    </rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Polygon -->
                    <div
                        class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 lg:w-1/2">
                        <div class="flex items-center space-x-2">
                            <!-- image -->
                            <img src="{{ asset('assets/user_assets/img/polygon.png') }}" alt="pol"
                                class="w-10 h-10 rounded-xl object-cover">
                            <div class="flex flex-col">
                                <span class="text-gray-900 dark:text-gray-100 font-medium">Polygon</span>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span>
                                        <input type="text" class="border-0 bg-transparent p-0"
                                            id="addressCopyPolygon" value="{{ $admin_wallets->polygon_address }}"
                                            readonly style="overflow-x: auto; white-space: nowrap; display: none;">
                                        @if ($admin_wallets->polygon_address != 'Not Available')
                                            {{ substr($admin_wallets->polygon_address, 0, 10) . '...' . substr($admin_wallets->polygon_address, -6) }}
                                        @else
                                            Not Available
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="relative flex items-center space-x-2">
                            <!-- Copy Button -->
                            <button onclick="copyFunctionPolygon()"
                                class="flex flex-col me-4 rounded-3xl bg-gray-800 text-white p-3 hover:bg-gray-700 transition"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2">
                                    </rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- XRP -->
                    <div
                        class="flex items-center justify-between border border-gray-200 dark:border-gray-600 rounded-xl p-2 dark:bg-gray-700 lg:w-1/2">
                        <div class="flex items-center space-x-2">
                            <!-- image -->
                            <img src="{{ asset('assets/user_assets/img/xrp-logo.png') }}" alt="xrp"
                                class="w-10 h-10 rounded-xl object-cover">
                            <div class="flex flex-col">
                                <span class="text-gray-900 dark:text-gray-100 font-medium">Ripple</span>
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <span>
                                        <input type="text" class="border-0 bg-transparent p-0"
                                            id="addressCopyRipple" value="{{ $admin_wallets->ripple_address }}"
                                            readonly style="overflow-x: auto; white-space: nowrap; display: none;">
                                        @if ($admin_wallets->ripple_address != 'Not Available')
                                            {{ substr($admin_wallets->ripple_address, 0, 10) . '...' . substr($admin_wallets->ripple_address, -6) }}
                                        @else
                                            Not Available
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="relative flex items-center space-x-2">
                            <!-- Copy Button -->
                            <button onclick="copyFunctionRipple()"
                                class="flex flex-col me-4 rounded-3xl bg-gray-800 text-white p-3 hover:bg-gray-700 transition"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2">
                                    </rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script>
        function copyToClipboard(text) {
            try {
                // Try using the Clipboard API first
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(text);
                    return true;
                } else {
                    // Fallback for non-secure contexts
                    const textarea = document.createElement('textarea');
                    textarea.value = text;
                    textarea.style.position = 'fixed';
                    textarea.style.left = '-999999px';
                    textarea.style.top = '-999999px';
                    document.body.appendChild(textarea);
                    textarea.focus();
                    textarea.select();
                    const successful = document.execCommand('copy');
                    document.body.removeChild(textarea);
                    return successful;
                }
            } catch (err) {
                console.error('Failed to copy:', err);
                return false;
            }
        }

        function copyFunctionSolana() {
            const address = document.getElementById("addressCopySolana").value;
            const success = copyToClipboard(address);
            if (success) {
                alert("copied");
            } else {
                alert("Failed to copy");
            }
        }

        function copyFunctionEthereum() {
            const address = document.getElementById("addressCopyEthereum").value;
            const success = copyToClipboard(address);
            if (success) {
                alert("copied");
            } else {
                alert("Failed to copy");
            }
        }

        function copyFunctionTether() {
            const address = document.getElementById("addressCopyTether").value;
            const success = copyToClipboard(address);
            if (success) {
                alert("copied");
            } else {
                alert("Failed to copy");
            }
        }

        function copyFunctionBitcoin() {
            const address = document.getElementById("addressCopyBitcoin").value;
            const success = copyToClipboard(address);
            if (success) {
                alert("copied");
            } else {
                alert("Failed to copy");
            }
        }

        function copyFunctionPolygon() {
            const address = document.getElementById("addressCopyPolygon").value;
            const success = copyToClipboard(address);
            if (success) {
                alert("copied");
            } else {
                alert("Failed to copy");
            }
        }

        function copyFunctionRipple() {
            const address = document.getElementById("addressCopyRipple").value;
            const success = copyToClipboard(address);
            if (success) {
                alert("copied");
            } else {
                alert("Failed to copy");
            }
        }
    </script>

</x-layouts.app>
