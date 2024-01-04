import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()
import { createApp} from "vue";
import showMore from "./components/show-more.vue";
import summernote from "./components/summernote.vue";
import nsfwtoggle from "./components/nsfwtoggle.vue";
import multiselect from "./components/multiselect.vue";
import createmodal from "./components/createmodal.vue";


const app = createApp({});
app.component('show-more', showMore);
app.component('summernote', summernote);
app.component('nsfwtoggle', nsfwtoggle);
app.component('multiselectrole', multiselect);
app.component('createmodal', createmodal);
app.mount('#app');
