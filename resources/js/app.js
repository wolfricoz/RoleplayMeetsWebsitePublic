import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
import { createApp } from "vue";
import showMore from "./components/ShowMore.vue";
import summernote from "./components/SummerNote.vue";
import nsfwtoggle from "./components/NsfwToggle.vue";
import multiselect from "./components/MultiSelect.vue";
import createmodal from "./components/createmodal.vue";
import profileModal from "./components/ProfileModal.vue";
import countdown from "./components/countdown.vue";
import dropdown from "./components/dropdown.vue";
import ScriptX from "vue-scriptx";

import Ads from "vue-google-adsense";
import multiSearch from "./components/MultiSearch.vue";

const app = createApp({});
app.use(ScriptX);
app.use(Ads.Adsense);
app.use(Ads.InArticleAdsense);
app.use(Ads.InFeedAdsense);
app.component("show-more", showMore);
app.component("summernote", summernote);
app.component("nsfwtoggle", nsfwtoggle);
app.component("multiselectrole", multiselect);
app.component("multisearch", multiSearch);
app.component("createmodal", createmodal);
app.component("profilemodal", profileModal);
app.component("countdown", countdown);
app.component("dropdown", dropdown);

app.mount("#app");
