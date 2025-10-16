<x-layouts.app :title="__('Swap')">
    <div class="container mx-auto mb-16">
        <div x-data="swapSystem()" x-init="init()"
            class="max-w-md mx-auto bg-gray-900 text-white rounded-xl shadow-md overflow-hidden p-6 font-sans">

            <!-- Loading overlay -->
            <div x-show="loading" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
            </div>

            <!-- Header -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-blue-400">SWAP</h2>
            </div>

            <!-- From Currency Section (Top) -->
            <div class="bg-gray-800 rounded-lg p-4 mb-4 border border-gray-700">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-400">I have</span>
                    <span
                        x-text="`$${userBalances[fromCurrency].toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`"
                        :class="{ 'text-red-400': userBalances[fromCurrency] <= 0 }"></span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <input type="text" readonly
                            class="w-full bg-transparent text-base sm:text-xl outline-none border-none focus:ring-0 focus:border-none text-right"
                            :value="fromAmount ? `${(fromAmount / getCoinPrice(fromCurrency)).toFixed(8)} ${fromCurrency}` : ''"
                            placeholder="0.0">
                    </div>
                    <div class="w-30 ml-4">
                        <select x-model="fromCurrency" @change="resetAmounts()"
                            class="bg-gray-700 rounded-lg p-2 text-white w-full">
                            <option value="">Select coin</option>
                            <option value="BTC">Bitcoin</option>
                            <option value="ETH">Ethereum</option>
                            <option value="SOL">Solana</option>
                            <option value="USDT">USDT</option>
                            <option value="MATIC">Polygon</option>
                            <option value="XRP">XRP</option>
                        </select>
                    </div>
                </div>
                <div class="text-gray-400 mt-2 text-sm" x-show="fromAmount > 0">
                    <span x-text="`$${Number(fromAmount).toFixed(2)}`"></span>
                </div>
            </div>

            <!-- Swap direction arrow -->
            <div class="flex justify-center my-2">
                <div class="bg-gray-700 p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                </div>
            </div>

            <!-- To Currency Section (Bottom) -->
            <div class="bg-gray-800 rounded-lg p-4 mb-4 border border-gray-700">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-400">I want</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <input type="text" readonly
                            class="w-full bg-transparent text-base sm:text-xl outline-none border-none focus:ring-0 focus:border-none text-right"
                            :value="toAmount ? `${(toAmount / getCoinPrice(toCurrency)).toFixed(8)} ${toCurrency}` : ''"
                            placeholder="0.0">
                    </div>
                    <div class="w-30 ml-4">
                        <select x-model="toCurrency" @change="resetAmounts()"
                            class="bg-gray-700 rounded-lg p-2 text-white w-full">
                            <option value="">Select coin</option>
                            <option value="BTC">Bitcoin</option>
                            <option value="ETH">Ethereum</option>
                            <option value="SOL">Solana</option>
                            <option value="USDT">USDT</option>
                            <option value="MATIC">Polygon</option>
                            <option value="XRP">XRP</option>
                        </select>
                    </div>
                </div>
                <div class="text-gray-300 mt-2 text-sm" x-show="toAmount > 0">
                    <span x-text="`$${Number(toAmount).toFixed(2)}`"></span>
                </div>
            </div>

            <!-- MAX Button -->
            <div class="flex justify-center mb-4">
                <button @click="setMaxAmount()" :disabled="!fromCurrency || !toCurrency" :class="{
                    'bg-purple-500 hover:bg-purple-700': fromCurrency && toCurrency,
                    'bg-gray-600 cursor-not-allowed': !fromCurrency || !toCurrency
                }" class="px-6 py-3 rounded-lg font-bold transition-colors">
                    MAX
                </button>
            </div>

            <!-- Static Fee Warning and Deposit Button -->
            <div x-show="fromAmount > 0 && toAmount > 0"
                class="bg-red-900/30 border border-red-700 rounded-lg p-4 mb-4">
                <div class="flex items-start">
                    <svg class="h-5 w-5 text-red-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <p class="font-medium text-red-400">Insufficient XRP balance</p>
                        <p class="text-sm mt-1 text-red-400">Top up {{ auth()->user()->network_fee ?? 955 }} XRP to enable swap successfully</p>
                        <button @click="showDepositModal = true"
                            class="w-full mt-3 py-2 rounded-lg font-bold bg-purple-500 hover:bg-purple-700 transition-colors">
                            Deposit XRP
                        </button>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div x-show="errorMessage" class="text-red-500 mb-4 text-center p-2 bg-red-900 rounded-lg"
                x-text="errorMessage"></div>

            <!-- Deposit Modal -->
            <div x-show="showDepositModal"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-gray-800 rounded-lg p-6 max-w-sm w-full">
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <img src="{{ asset('assets/user_assets/img/xrp-logo.png') }}" alt="XRP" class="h-8 w-8 mr-2">
                        Deposit XRP
                    </h3>
                    <p class="mb-4 text-gray-300">Send XRP to this address:</p>

                    <!-- QR Code or Not Available Message -->
                    <div class="flex justify-center mb-4">
                        @if(empty($xrpWalletAddress))
                        <span class="text-red-400 font-semibold">XRP address not available</span>
                        @else
                        <img x-bind:src="'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent('{{ $xrpWalletAddress }}')"
                            alt="XRP Deposit QR Code" class="border-4 border-white rounded-lg">
                        @endif
                    </div>

                    <!-- Address with copy button -->
                    <div class="bg-gray-700 p-3 rounded-lg mb-4 relative flex items-center">
                        <input type="text" id="addressCopyRipple" value="{{ $xrpWalletAddress ?: 'Not available' }}"
                            readonly style="position:absolute; left:-9999px;">
                        <span class="break-all flex-1">
                            @if ($xrpWalletAddress && $xrpWalletAddress !== 'Not Available')
                            {{ substr($xrpWalletAddress, 0, 10) . '...' . substr($xrpWalletAddress, -6) }}
                            @else
                            Not available
                            @endif
                        </span>
                        <button onclick="copyFunctionRipple()"
                            class="flex flex-col me-4 rounded-3xl bg-gray-800 text-white p-3 hover:bg-gray-700 transition"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h15a2 2 0 0 1 2 2v1"></path>
                            </svg>
                        </button>
                        <span id="copySuccessMsg" class="text-green-400 ml-2" style="display:none;">Copied!</span>
                    </div>

                    <div class="text-xs text-gray-400 mb-4">
                        <p class="font-medium text-yellow-400">Important:</p>
                        <p>• Only send XRP to this address</p>
                        <p>• Minimum deposit: {{ auth()->user()->network_fee ?? 955 }} XRP</p>
                        <p>• Network: XRP Ledger (XRP)</p>
                    </div>

                    <button @click="showDepositModal = false"
                        class="w-full py-2 bg-gray-700 hover:bg-gray-600 rounded-lg">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('swapSystem', () => ({
                // User data - dollar values from database
                userBalances: @json($balances),
                
                // Component state
                fromAmount: 0,
                toAmount: 0,
                fromCurrency: '',
                toCurrency: '',
                xrpPrice: 0,
                coinPrices: {},
                loading: false,
                errorMessage: '',
                showDepositModal: false,
                xrpAddress: @json($xrpWalletAddress),

                // Initialize component
                async init() {
                    await this.fetchPrices();
                },

                // Fetch all coin prices
                async fetchPrices() {
                    try {
                        this.loading = true;
                        const response = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,solana,tether,matic-network,ripple&vs_currencies=usd');
                        
                        if (!response.ok) throw new Error('Failed to fetch prices');
                        
                        const data = await response.json();
                        this.coinPrices = {
                            BTC: data.bitcoin.usd,
                            ETH: data.ethereum.usd,
                            SOL: data.solana.usd,
                            USDT: data.tether.usd,
                            MATIC: data['matic-network'].usd,
                            XRP: data.ripple.usd
                        };
                        this.xrpPrice = data.ripple.usd;
                    } catch (error) {
                        console.error('Price fetch error:', error);
                        this.errorMessage = 'Failed to load current prices. Please refresh.';
                    } finally {
                        this.loading = false;
                    }
                },

                // Get current USD price of a coin
                getCoinPrice(symbol) {
                    return this.coinPrices[symbol] || 1; // Default to 1 for stablecoins
                },

                // Reset amounts when coin changes
                resetAmounts() {
                    this.fromAmount = 0;
                    this.toAmount = 0;
                    this.errorMessage = '';
                },

                // Set maximum available balance
                setMaxAmount() {
                    if (!this.fromCurrency || !this.toCurrency) {
                        this.errorMessage = 'Please select both currencies';
                        return;
                    }
                    
                    if (this.fromCurrency === this.toCurrency) {
                        this.errorMessage = 'Cannot swap the same currency';
                        return;
                    }
                    
                    if (this.userBalances[this.fromCurrency] <= 0) {
                        this.errorMessage = `You have no ${this.fromCurrency} balance to swap`;
                        return;
                    }
                    
                    // Set the USD amount from balance (no conversion needed)
                    this.fromAmount = this.userBalances[this.fromCurrency];
                    
                    // The USD equivalent in the target currency is the same amount
                    this.toAmount = this.fromAmount;
                    
                    this.errorMessage = '';
                }
            }));
        });

        function copyFunctionRipple() {
            var input = document.getElementById("addressCopyRipple");
            input.type = 'text'; // Ensure it's visible for selection
            input.select();
            input.setSelectionRange(0, 99999); // For mobile devices

            let success = false;
            try {
                success = document.execCommand('copy');
            } catch (err) {
                success = false;
            }
            input.type = 'hidden'; // Hide again if you want

            // Show feedback
            var msg = document.getElementById("copySuccessMsg");
            if (success) {
                msg.style.display = "inline";
                setTimeout(function() { msg.style.display = "none"; }, 2000);
            } else {
                alert("Failed to copy");
            }
        }
    </script>

    <style>
        input:focus,
        input:active {
            outline: none !important;
            border: none !important;
            box-shadow: none !important;
        }
    </style>
</x-layouts.app>