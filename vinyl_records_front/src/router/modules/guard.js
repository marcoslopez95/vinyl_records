import axios from "axios";
import router from "..";
/**
 * Vue-router Navigation Guard
 */
//External Route Guard Before Routing
router.beforeEach(async (to, from, next) => {
  const canAccess = await isAuth();
  if (to.name !== "login" && !canAccess){
      next({
        name: "login",
      });
  }
  if (to.name === "login" && canAccess){
    next({
      name: "home",
    });
}
  else next();
});

//External Route Guard After Routing
router.afterEach((to, from) => {});

function isAuth() {
  let token = localStorage.getItem("acces_token");

  axios
    .get("/api/user")
    .then((response) => {
      return true;
    })
    .catch((error) => {
      return false;
    });
}
