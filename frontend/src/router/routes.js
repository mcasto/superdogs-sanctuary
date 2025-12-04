import callApi from "src/assets/call-api";
import { useStore } from "src/stores/store";

const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/IndexPage.vue"),
        name: "home",
        beforeEnter: async () => {
          const store = useStore();

          store.sanctuary = await callApi({
            path: "/home",
            method: "get",
          });
        },
      },
      {
        path: "news",
        component: () => import("pages/NewsPage.vue"),
        name: "news",
        beforeEnter: async () => {
          const store = useStore();

          store.news = await callApi({
            path: "/news",
            method: "get",
            responseType: "text",
          });
        },
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
