import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

export function init() {
    return new Echo({
        broadcaster: 'pusher',

        key: import.meta.env.VITE_PUSHER_APP_KEY,

        cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,

        wsHost: import.meta.env.VITE_PUSHER_HOST,
        wsPort: Number(import.meta.env.VITE_PUSHER_PORT),
        wssPort: Number(import.meta.env.VITE_PUSHER_PORT),

        forceTLS: false,
        encrypted: false,

        enabledTransports: ['ws'],
    });
}
