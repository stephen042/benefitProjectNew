<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <div class="ml-1 grid flex-1 text-left text-sm">
                <span class="mb-0.5 truncate leading-none font-bold">{{ config('app.name') }}</span>
            </div>
        </a>
        @if (auth()->user()->role == 1)
            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Overview')" class="grid">
                    <flux:navlist.item icon="home" :href="route('admin.dashboard')"
                        :current="request()->routeIs('admin.dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    <flux:navlist.item icon="wallet" :href="route('admin.wallet.address')"
                        :current="request()->routeIs('admin.wallet.address')" wire:navigate>{{ __('Wallet Addresses') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>
        @else
            
        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Overview')" class="grid">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>

                <flux:navlist.item icon="download" :href="route('user.receive')"
                    :current="request()->routeIs('user.receive')" wire:navigate>{{ __('Receive') }}</flux:navlist.item>

                <flux:navlist.item icon="paper-airplane" :href="route('user.send')"
                    :current="request()->routeIs('user.send')" wire:navigate>{{ __('Send') }}</flux:navlist.item>

                <flux:navlist.item icon="repeat" :href="route('user.swap')" :current="request()->routeIs('user.swap')"
                    wire:navigate>{{ __('SWAP') }}</flux:navlist.item>

            </flux:navlist.group>
        </flux:navlist>

        <flux:navlist.group :heading="__('More')" class="grid">
            <!-- Transactions Dropdown -->
            <flux:dropdown>
                <flux:button icon:trailing="chevron-down">
                    Transactions
                </flux:button>

                <flux:menu>
                    <flux:menu.item icon="chart-bar" :href="route('user.trade.history')"
                        :current="request()->routeIs('user.trade.history')">
                        Trade History
                    </flux:menu.item>

                    <flux:menu.item icon="download" :href="route('user.receive.history')"
                        :current="request()->routeIs('user.receive.history')">
                        Receive History
                    </flux:menu.item>

                    <flux:menu.item icon="paper-airplane" :href="route('user.send.history')"
                        :current="request()->routeIs('user.send.history')">
                        Send History
                    </flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:navlist.group>
        @endif

        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts

    {{-- livechat --}}
    <script id="chatway" async="true" src="https://cdn.chatway.app/widget.js?id=IuDBje7xd2BU"></script>
</body>

</html>