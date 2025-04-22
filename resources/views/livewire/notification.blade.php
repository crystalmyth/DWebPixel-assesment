<div
    class="fixed top-4 right-4 z-50 transition-all duration-300"
    x-data="{
        show: @entangle('show').live,
        message: @entangle('message').live,
        type: @entangle('type').live,
        init() {
            $wire.on('hide-notification', () => {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            });
        }
    }"
    x-show="show"
    x-transition:enter="translate-x-full"
    x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-full">
    <div
        :class="{
            'bg-green-100 border-green-400 text-green-700': type === 'success',
            'bg-red-100 border-red-400 text-red-700': type === 'error',
            'px-4 py-3 rounded relative': true, // Always apply these
        }"
        role="alert">
        <strong class="font-bold block" x-text="type === 'success' ? 'Success!' : 'Error!'"></strong>
        <span class="block sm:inline" x-text="message"></span>
    </div>
</div>