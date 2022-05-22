<template>
    <div id="app">
        <NavBarComponent v-if="$route.path != '/login' && auth" />
        <router-view></router-view>
    </div>
</template>
<script>
import NavBarComponent from "@/components/HomeView/NavBarComponent.vue";
import { EventBus } from "./event-bus.js";
export default {
    name: "App",
    components: {
        NavBarComponent,
    },
    data() {
        return {
            auth: false,
        };
    },
    methods: {
        Logout() {
            localStorage.removeItem("access_token");
            localStorage.removeItem("type_token");
            localStorage.removeItem("expired_token");
            localStorage.removeItem("first_name");
            localStorage.removeItem("rol");
            this.auth = false;
            this.$router.push("login");
        },
        Login() {
            this.auth = true;
            //axios.defaults.headers.common['Authorization'] = auth;
            this.$router.push("/");
        },
    },
    mounted() {
        EventBus.$on("salir", this.Logout);
        EventBus.$on("login", this.Login);
        if (localStorage.getItem("access_token")) this.auth = true;
    },
};
</script>
<style>
@import url("./app.css");
</style>