<template>
    <div>
        <b-navbar
            toggleable="lg"
            type="dark"
            variant="success"
            fixed="top"
            class="px-3"
        >
            <b-navbar-brand> 
                <router-link to="/" tag="span" >
                    Inicio
                </router-link>
                </b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse
                id="nav-collapse"
                is-nav
                class="justify-content-between"
            >
                <b-navbar-nav>
                    <b-nav-item v-for="(link, i) in links" :key="i" :active="link.to == path">
                    <router-link :to="link.to" class="" tag="span">
                    {{link.name}}
                    </router-link>
                    </b-nav-item>
                </b-navbar-nav>

                <!-- Right aligned nav items -->
                <b-navbar-nav>
                    <b-nav-item-dropdown right>
                        <!-- Using 'button-content' slot -->
                        <template #button-content>
                            <em>{{ user }}</em>
                        </template>
                        <b-dropdown-item href="#" @click="Logout()"
                            >Salir</b-dropdown-item
                        >
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
import {
    BNavbar,
    BCollapse,
    BNavbarNav,
    BNavItemDropdown,
    BDropdownItem,
    BNavbarToggle,
    BNavbarBrand,
} from "bootstrap-vue";
export default {
    name: "nav-bar-component",
    components: {
        BNavbar,
        BCollapse,
        BNavbarNav,
        BNavItemDropdown,
        BDropdownItem,
        BNavbarToggle,
        BNavbarBrand,
    },
    mounted() {
        this.user = localStorage.getItem("first_name");
        this.path = this.$route.path
        this.links.sort(function (a, b) {
            if (a.name > b.name) {
                return 1;
            }
            if (a.name < b.name) {
                return -1;
            }
            // a must be equal to b
            return 0;
            });
    },
    data() {
        return {
            user: "",
            path: '',
            links: [
                {
                    name: "Generos Musicales",
                    to: "/genre_musical",
                },
                {
                    name: "Albums",
                    to: "/album",
                },
                {
                    name: "Artistas",
                    to: "/artistas",
                },
                {
                    name: "Discos",
                    to: "/discos",
                },
                {
                    name: "Usuarios",
                    to: "/usuarios",
                },
            ],
        };
    },
    methods: {
        Logout() {
            localStorage.removeItem("access_token");
            localStorage.removeItem("type_token");
            localStorage.removeItem("expired_token");
            this.$router.push("login");
        },
    },
};
</script>

<style>
</style>