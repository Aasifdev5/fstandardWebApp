// resources/js/echo.js
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

export function init() {
    if (!import.meta.env.VITE_PUSHER_APP_KEY) {
        console.warn('Pusher key not defined in .env!');
    }

    return new Echo({
        broadcaster: 'pusher',
        key: import.meta.env.VITE_PUSHER_APP_KEY,
        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
        wsHost: import.meta.env.VITE_PUSHER_HOST || window.location.hostname,
        wsPort: import.meta.env.VITE_PUSHER_PORT || 6001,
        wssPort: import.meta.env.VITE_PUSHER_PORT || 6001,
        forceTLS: import.meta.env.VITE_PUSHER_SCHEME === 'https',
        encrypted: true,
        disableStats: true,
        enabledTransports: ['ws', 'wss'],
    });
}
