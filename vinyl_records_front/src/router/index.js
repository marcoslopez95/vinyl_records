import axios from "axios";
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const createRouter = () =>
  new VueRouter({
    mode: "history",
    routes: [
      {
        path: "/",
        name: "home",
        component: () => import("@/views/Home.vue"),
        children:[
            {
                path: 'discos',
                component: () => import("@/components/HomeView/CardDiscos.vue")
            }
        ]
      },
      {
        path: "/login",
        name: "login",
        component: () => import("@/views/Login.vue"),
      },
    ],
  });

const router = createRouter();

const isAuthenticated = () => {
  if (localStorage.getItem("access_token")) {
    return true;
  } else {
    return false;
  }
};
router.beforeEach(async (to, from, next) => {
  const auth = await isAuthenticated();
  if (to.name !== "login" && !auth)
    next({
      name: "login",
    });
  if (to.name === "login" && auth)
    next({
      name: "home",
    });
  else next();
});
export default router;
