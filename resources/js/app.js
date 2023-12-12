import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()
import { createApp} from "vue";
import showMore from "./components/show-more.vue";


const app = createApp({});
app.component('show-more', showMore);
app.mount('#app');
