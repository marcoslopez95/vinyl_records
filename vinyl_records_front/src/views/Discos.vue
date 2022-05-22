<template>
    <div>
        <CardDiscosVue
            v-if="$route.name == ruta"
            :fields="fields"
            :name="name"
            :ruta="ruta"
            :params="params"
        >
            <template slot="botones">
                <FiltroDiscos @filtrar="filtrar" />
            </template>
        </CardDiscosVue>
        <router-view v-else></router-view>
    </div>
</template>

<script>
import CardDiscosVue from "../components/HomeView/CardBase.vue";
import FiltroDiscos from "../components/Discos/FiltroDiscos.vue";

export default {
    name: "generos",
    components: {
        CardDiscosVue,
        FiltroDiscos,
    },
    data() {
        return {
            items: [],
            name: "Disco",
            ruta: "records",
            params: null,
            fields: [
                { label: "Nombre", key: "name" },
                { label: "Album", key: "album_name" },
                { label: "Año", key: "year" },
                { label: "Artista", key: "artist_name" },
            ],
        };
    },
    mounted() {},
    methods: {
        filtrar(filtros) {
            console.log("padre");
            this.params = filtros;
        },
    },
};
</script>

<style>
</style>