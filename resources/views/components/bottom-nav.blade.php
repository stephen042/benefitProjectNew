<div class="fixed bottom-0 left-0 w-full shadow-lg md:hidden p-3 border-t border-gray-300 dark:border-gray-700 bg-white dark:bg-black">
    <flux:navbar class="flex justify-around">
        <flux:navbar.item href="{{ route('dashboard') }}" icon="home"></flux:navbar.item>
        <flux:navbar.item href="{{ route('user.receive') }}" icon="download"></flux:navbar.item>
        <flux:navbar.item href="{{ route('user.swap') }}" icon="repeat"></flux:navbar.item> <!-- Using Lucide repeat icon -->
        <flux:navbar.item href="{{ route('user.trade.history') }}" icon="clock"></flux:navbar.item> <!-- Time -->
        <flux:navbar.item href="{{ route('user.trade') }}" icon="currency-dollar"></flux:navbar.item> <!-- Deposit -->
    </flux:navbar>
</div>

