require('./bootstrap');

import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3'
import Layout  from "./Shared/Layout"
import Notification  from "./Shared/Notification"
import { InertiaProgress } from '@inertiajs/progress'


createInertiaApp({
  resolve: async name => {
    let page = (await import(`./Pages/${name}`)).default;
    
    page.layout ??= Layout


    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component("Link", Link)
      .component("Head", Head)
      .component("Notification", Notification)
      .mount(el)
  },

  title: title => 'My App: ' + title
})

InertiaProgress.init({
    // The delay after which the progress bar will
    // appear during navigation, in milliseconds.
    delay: 250,

    // The color of the progress bar.
    color: '#29d',

    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: false,
})