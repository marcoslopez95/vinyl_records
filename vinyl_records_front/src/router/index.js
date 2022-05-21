import Vue from "vue";
import VueRouter from "vue-router";
import DiscosView from '../views/Discos.vue'
import Usuarios from '../views/Usuarios.vue'
import Albums from '../views/Albums.vue'
import AlbumCreate from '../components/AlbumCreate.vue'
import AlbumEdit from '../components/AlbumEdit.vue'

Vue.use(VueRouter);

const createRouter = () =>
  new VueRouter({
    mode: "history",
    routes: [
     
      {
        path: "/",
        name: "home",
        component: () => import("@/views/Home.vue"),
        children: [
          {
            path: "usuarios",
            name: "users",
            component: Usuarios,
            children: [
              {
                path: "create",
                name: "users-create",
                component: () => import("@/components/Usuarios/RegisterUser.vue"),
              },
              {
                path: "edit/:id",
                name: "users-edit",
                component: () => import('../components/Usuarios/EditUser.vue')
              },
            ]
          },
          {
            path: "discos",
            name: "records",
            component: DiscosView
          },
          {
            path: "artistas",
            name: "artists",
            component: () => import("@/views/Artistas.vue"),
            children: [
              {
                path: "create",
                name: "artists-create",
                component: () => import("@/components/Artistas/ArtistaCreate.vue"),
              },
              {
                path: "edit/:id",
                name: "genrartistses-edit",
                component: () => import('../components/Artistas/ArtistaEdit.vue')
              },
            ]
          },
          {
            path: "albums",
            name: "albums",
            component: Albums,
            children: [
              {
                path: "create",
                name: "albums-create",
                component: AlbumCreate,
              },
              {
                path: "edit/:id",
                name: "albums-edit",
                component: AlbumEdit,
              },
            ]
          },
          {
            path: "generos",
            name: "genres",
            component: () => import("@/views/Generos.vue"),
            children: [
              {
                path: "create",
                name: "genres-create",
                component: () => import("@/components/Generos/GeneroCreate.vue"),
              },
              {
                path: "edit/:id",
                name: "genres-edit",
                component: () => import("@/components/Generos/GeneroEdit.vue"),
              },
            ]
          },
        ]
      },
      
     
      {
        path: "login",
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
