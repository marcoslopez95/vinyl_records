<template>
    <BCard>
        <BRow>
            <BCol>
                <b-button variant="primary" @click="crearRegistro()"
                    >Crear {{ name }}</b-button
                >
            </BCol>
            <slot name="botones"></slot>
        </BRow>
        <BTable hover :fields="fields" :items="items" sticky-header>
            <template #cell(#)="data">
                {{ data.index + 1 }}
            </template>
            <template #cell(Acciones)="data">
                <b-button
                    class="mx-2"
                    @click="editRegistro(data.item.id)"
                    variant="primary"
                    >edit</b-button
                >
                <b-button
                    class="mx-2"
                    @click="deletRegistro(data.item.id)"
                    variant="danger"
                    >delete</b-button
                >
                <slot></slot>
            </template>
        </BTable>
    </BCard>
</template>

<script>
import { BCard, BTable } from "bootstrap-vue";
import axios from "axios";

export default {
    name: "card-base",
    props: {
        fields: Array,
        ruta: String,
        name: String,
        params: {type: Object, default: null}
    },
    components: {
        BCard,
        BTable,
    },
    mounted() {
        this.fields.unshift("#");
        this.fields.push("Acciones");
        this.getData();
        // EventBus.$on('create',this.refresh)
    },
    data() {
        return {
            items: [],
        };
    },
    watch:{
        params: function(nuevo){
            console.log('base');
            this.getData()
        }
    },
    methods: {
        crearRegistro() {
            let ruta = this.name + "s/create";
            this.$router.push(ruta);
        },
        editRegistro(id) {
            let ruta = this.name + "s/edit/" + id;
            console.log(ruta);
            this.$router.push(ruta);
        },
        deletRegistro(id) {
            let ruta = "api/" + this.ruta + "/" + id;
            let token = localStorage.getItem("access_token");
            let type = localStorage.getItem("type_token");
            let auth = type + " " + token;
            let headers = {
                Authorization: auth,
            };
            axios
                .delete(ruta, {headers})
                .then((response) => {
                    let data = response.data.data;
                    //console.log('eliminado',data);
                    this.getData();
                })
                .catch((error) => {
                    let e = error.response.data.data;
                    console.log("error_eliminar", e);
                });
        },
        getData() {
            let url = "api/" + this.ruta;
            this.items = [];
            let token = localStorage.getItem("access_token");
            let type = localStorage.getItem("type_token");
            let auth = type + " " + token;
            let headers = {
                Authorization: auth,
            };
            axios
                .get(url, {
                    headers,
                    params:this.params
                    })
                .then((response) => {
                    let data = response.data.data;
                    console.log("discos", data);
                    data.forEach((element) => {
                        this.items.push(element);
                    });
                })
                .catch((error) => {
                    let e = error.response.data.data;
                    console.log("error_records", e);
                });
        },
    },
};
</script>

<style>
</style>