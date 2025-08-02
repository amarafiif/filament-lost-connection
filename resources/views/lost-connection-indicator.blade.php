<div x-data="connectionIndicator({{ $checkInterval ?? 3000 }}, '{{ $pingUrl ?? 'https://httpbin.org/status/200' }}', {{ config('app.debug') ? 'true' : 'false' }})" x-init="init()" x-show="showIndicator" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-2"
    class="{{ $position === 'top' ? 'top-0' : 'bottom-0' }} pointer-events-auto fixed inset-x-0 z-50 mx-auto w-full p-4 text-white shadow-lg" :style="'background-color: ' + (online ? '{{ $connectedColor ?? '#065f46' }}' : '{{ $lostConnectionColor ?? '#991b1b' }}') + ';'">

    <div class="flex items-center justify-center">
        <div class="flex items-center gap-4">
            @if (isset($icon))
                <x-dynamic-component :component="$icon" class="mr-2 h-6 w-6 flex-shrink-0" />
            @else
                <svg class="mr-2 h-6 w-6 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            @endif

            <span x-text="online ? '{{ $connectedText ?? 'You are back online.' }}' : '{{ $lostConnectionText ?? 'You are disconnected.' }}'"></span>
        </div>
    </div>
</div>

<script>
    function connectionIndicator(checkInterval = 3000, pingUrl = 'https://httpbin.org/status/200') {
        return {
            online: navigator.onLine,
            showIndicator: false,
            checkInterval: checkInterval,
            pingUrl: pingUrl,
            intervalId: null,

            init() {
                this.online = navigator.onLine;

                window.addEventListener('online', () => {
                    this.online = true;
                    this.showConnectedMessage();
                });

                window.addEventListener('offline', () => {
                    this.online = false;
                    this.showIndicator = true;
                });

                this.startPeriodicCheck();
            },

            startPeriodicCheck() {
                this.intervalId = setInterval(() => {
                    this.checkConnection();
                }, this.checkInterval);

                setTimeout(() => this.checkConnection(), 1000);
            },

            async checkConnection() {
                try {
                    const controller = new AbortController();
                    const timeoutId = setTimeout(() => controller.abort(), 5000);

                    const response = await fetch(this.pingUrl + '?t=' + Date.now(), {
                        method: 'HEAD',
                        cache: 'no-cache',
                        signal: controller.signal
                    });

                    clearTimeout(timeoutId);

                    if (response.ok) {
                        if (!this.online) {
                            this.online = true;
                            this.showConnectedMessage();
                        }
                    } else {
                        this.handleConnectionLost();
                    }
                } catch (error) {
                    this.handleConnectionLost();
                }
            },

            handleConnectionLost() {
                if (this.online) {
                    this.online = false;
                    this.showIndicator = true;
                }
            },

            showConnectedMessage() {
                this.showIndicator = true;

                setTimeout(() => {
                    if (this.online) {
                        this.showIndicator = false;
                    }
                }, 3000);
            },

            destroy() {
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                }
            }
        };
    }
</script>
