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
                <router-link to="/" tag="span"> Inicio </router-link>
            </b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse
                id="nav-collapse"
                is-nav
                class="justify-content-between"
            >
                <b-navbar-nav>
                    <b-nav-item
                        v-for="(link, i) in links"
                        :key="i"
                        :active="link.to == path"
                    >
                        <router-link :to="{name:link.to}" tag="span" replace>
                            {{ link.name }}
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
import { EventBus } from "@/event-bus";
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
        this.path = this.$route.path;
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
            path: "",
            links: [
                {
                    name: "Generos Musicales",
                    to: "genres",
                },
                {
                    name: "Albums",
                    to: "albums",
                },
                {
                    name: "Artistas",
                    to: "artists",
                },
                {
                    name: "Discos",
                    to: "records",
                },
                {
                    name: "Usuarios",
                    to: "users",
                },
            ],
        };
    },
    methods: {
        Logout() {
          EventBus.$emit('salir');
        },
    },
};
</script>

<style>
</style>