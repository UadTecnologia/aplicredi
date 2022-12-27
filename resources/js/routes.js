import Vue from "vue";
import Router from "vue-router";

import DemandaGraficos from "./views/demandas/graficos/Index.vue";

Vue.use(Router);

let routes = [
  {
    path: "/",
    component: DemandaGraficos,
  },
];

export default new Router({
  routes,
});
