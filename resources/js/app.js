import './bootstrap';
import { createApp } from 'vue';
import ChatComponent from './components/ChatComponent.vue';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'a9664a6c63aec4961492',
    cluster: "ap2",
    encrypted: true,
});

const app = createApp({});
app.component('chat-component', ChatComponent);
app.mount('#app');


