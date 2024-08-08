require('./bootstrap')

import { createApp } from 'vue'
import router from './router'
import VueCarousel from '@chenfengyuan/vue-carousel';

// Import Bootstrap CSS
import 'bootstrap/dist/css/bootstrap.min.css';
// Import Bootstrap JS
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

const app = createApp({})

app.component(VueCarousel.name, VueCarousel);

app.use(router)

app.mount('#app')