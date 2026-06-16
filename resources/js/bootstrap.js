import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',

    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,

    wsHost: window.location.hostname,
    wsPort: 6001,
    wssPort: 6001,

    forceTLS: false,
    encrypted: false,

    disableStats: true,

    enabledTransports: ['ws', 'wss'],

    authEndpoint: '/broadcasting/auth',
});
