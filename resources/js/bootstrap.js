/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });


// import io from 'socket.io-client';

// const socket = io('http://localhost:1000');



// socket.on('connect', () => {
//     console.log('Connected to Laravel Echo Server');

//     // Subscribe to the "laravel_database_message" channel
//     // socket.emit('subscribe', 'laravel_database_message');
//     socket.emit('data', { text: 'Hello from server' });
// });

// socket.on('data', (data) => {
//     console.log('Received message:', data);
// });


// import io from 'socket.io-client';

// const socket = io('http://192.168.0.127:6001'); // Server manzili va porti

// socket.on('connect', () => {
//     console.log('Connected to Socket.IO server');
// });

// socket.on('disconnect', () => { 
//     console.log('Disconnected from Socket.IO server');
// });


// import Echo from 'laravel-echo';
// import io from 'socket.io-client';

// window.io = io ;

// const echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':1000', // Laravel Echo Serverning manzili
// });

// echo.channel('laravel_database_message')
//     .listen('.message', (data) => {
//         console.log('Hodisa tinglandi:', data);
//     });

// console.log(window.location.hostname);


import Pusher from 'pusher-js';


const pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
});

const channel = pusher.subscribe('message');

channel.bind('message', function(data) {
   console.log(55);
});
