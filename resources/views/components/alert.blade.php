<div x-data="{ show: false, message: '', type: 'success' }"
    @notify.window="message = $event.detail[0]; type = $event.detail[1]; show = true; setTimeout(() => show = false, 6000)"
    x-show="show" x-transition
    class="fixed top-5 right-5 flex items-center gap-4 px-5 py-3 rounded-lg shadow-lg border-l-4" :class="{ 
'bg-green-50 border-green-500 text-green-700': type === 'success',
'bg-red-50 border-red-500 text-red-700': type === 'error'
}">

    <!-- Icon -->
    <svg x-show="type === 'success'" class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
    </svg>

    <svg x-show="type === 'error'" class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
    </svg>

    <!-- Message -->
    <span x-text="message" class="flex-1 text-sm font-medium"></span>

    <!-- Close Button -->
    <button @click="show = false" class="text-gray-500 hover:text-gray-700">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>