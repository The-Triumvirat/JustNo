@php
    $notifications = session('notifications', []);

    foreach ($notifications as $index => $notification) {
        $notifications[$index]['id'] = $notification['id'] ?? uniqid('notification_', true);
        $notifications[$index]['type'] = $notification['type'] ?? 'info';
    }

    if (session()->has('message')) {
        $notifications[] = [
            'type' => session('alert-type', 'info'),
            'message' => session('message'),
            'id' => uniqid('notification_', true),
        ];
    }

    foreach (['success', 'info', 'warning', 'error'] as $type) {
        if (session()->has($type)) {
            $notifications[] = [
                'type' => $type,
                'message' => session($type),
                'id' => uniqid('notification_', true),
            ];
        }
    }

    if (session()->has('status')) {
        $notifications[] = [
            'type' => 'info',
            'message' => session('status'),
            'id' => uniqid('notification_', true),
        ];
    }
@endphp

<div
    x-data="{ notifications: [] }"
    x-init="notifications = JSON.parse($refs.notificationsPayload.textContent)"
    class="pointer-events-none fixed left-1/2 top-3 z-[80] w-[calc(100%-2rem)] -translate-x-1/2 space-y-2 sm:w-96 lg:left-[calc(50%+8rem)]">
    <script x-ref="notificationsPayload" type="application/json">@json($notifications)</script>

    <template x-for="notification in notifications" :key="notification.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-y-2 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-2 opacity-0"
            x-init="setTimeout(() => { notifications = notifications.filter(n => n.id !== notification.id) }, 5000)"
            :class="{
                'border-trium-400/40 bg-trium-panel text-trium-100': notification.type === 'success',
                'border-blue-400/40 bg-trium-panel text-blue-100': notification.type === 'info',
                'border-yellow-400/40 bg-trium-panel text-yellow-100': notification.type === 'warning',
                'border-red-400/40 bg-trium-panel text-red-100': notification.type === 'error'
            }"
            class="pointer-events-auto rounded-lg border px-4 py-3 shadow-trium-soft">
            <div class="flex items-start gap-3">
                <span
                    class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full"
                    :class="{
                        'bg-trium-400/15 text-trium-300': notification.type === 'success',
                        'bg-blue-400/15 text-blue-300': notification.type === 'info',
                        'bg-yellow-400/15 text-yellow-300': notification.type === 'warning',
                        'bg-red-400/15 text-red-300': notification.type === 'error'
                    }">
                    <i
                        class="bx text-base"
                        :class="{
                            'bx-check': notification.type === 'success',
                            'bx-info-circle': notification.type === 'info',
                            'bx-error': notification.type === 'warning',
                            'bx-x-circle': notification.type === 'error'
                        }"></i>
                </span>

                <p class="min-w-0 flex-1 text-sm font-medium leading-6" x-text="notification.message"></p>

                <button
                    type="button"
                    @click="notifications = notifications.filter(n => n.id !== notification.id)"
                    class="rounded-md p-1 text-trium-sub transition-colors hover:bg-white/5 hover:text-trium-text"
                    aria-label="Benachrichtigung schliessen">
                    <i class="bx bx-x text-lg"></i>
                </button>
            </div>
        </div>
    </template>
</div>
