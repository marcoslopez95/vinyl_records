<template>
    <div>
        <CreateBase
            :form="form"
            ruta="records"
            :validated="validated"
            method="post"
        >
            <BRow class="mt-4">
                <BCol></BCol>
                <BCol sm="4">
                    <BCol>
                        <b-form-group
                            id="nombre"
                            description="Introduzca el nombre del disco"
                            label="Nombre"
                            label-for="nombre"
                        >
                            <b-form-input
                                id="Nombre"
                                v-model="form.name"
                                @keypress="validarNombre()"
                            ></b-form-input>
                        </b-form-group>
                    </BCol>
                    <BCol class="mt-2">
                        <label for="year">Año del Disco</label>
                        <select
                            id="year"
                            class="form-select"
                            v-model="form.year"
                            @change="validarYear()"
                        >
                            <option
                                v-for="(year, i) in years"
                                :key="i"
                                :value="year.value"
                            >
                                {{ year.text }}
                            </option>
                        </select>
                    </BCol>
                    <BCol class="mt-2">
                        <label>Artista</label>
                        <select
                            class="form-select"
                            v-model="form.artist_id"
                            @change="validarArtista()"
                        >
                            <option
                                v-for="(artist, i) in artists"
                                :key="i"
                                :value="artist.id"
                            >
                                {{ artist.name }}
                            </option>
                        </select>
                    </BCol>
                    <BCol class="mt-2">
                        <label>Álbum</label>
                        <select class="form-select" v-model="form.album_id" @change="validarAlbum()">
                            <option
                                v-for="(album, i) in albums"
                                :key="i"
                                :value="album.id"
                            >
                                {{ album.name }}
                            </option>
                        </select>
                    </BCol>
                </BCol>
                <BCol>
                    <div class="text-center">
                        <div>
                            <b-img
                                v-bind="mainProps"
                                rounded
                                alt="Rounded image"
                                v-if="preview == ''"
                            ></b-img>
                            <img
                                v-else
                                :src="preview"
                                rounded="circle"
                                alt="Circle image"
                                width="200px"
                                height="200px"
                            />
                        </div>
                        <div>
                            <input
                                v-show="true"
                                id="file"
                                required
                                type="file"
                                @change="previewImage($event); validarFoto();"
                            />
                        </div>
                    </div>
                </BCol>
                <BCol></BCol>
            </BRow>
            <hr />
            <BRow>
                <BCol>
                    <p>Seleccione los géneros del disco:</p>
                    <div
                        class="form-check form-check-inline"
                        v-for="(option, i) in tastes"
                        :key="i"
                    >
                        <input
                            class="form-check-input"
                            type="checkbox"
                            :id="'check' + i"
                            :value="option.id"
                            v-model="form.genres"
                            @change="validarGenero()"
                        />
                        <label class="form-check-label" :for="'check' + i">{{
                            option.name
                        }}</label>
                    </div>
                </BCol>
            </BRow>
            <div style="height: 30px"></div>
        </CreateBase>
    </div>
</template>

<script>
import CreateBase from "@/components/CreateBase.vue";
import {
    BCard,
    BRow,
    BCol,
    BFormInput,
    BButton,
    BImg,
    BFormCheckboxGroup,
    BFormSelect,
    BFormGroup,
} from "bootstrap-vue";
import axios from "axios";

export default {
    components: { CreateBase, BButton, BFormSelect },
    data() {
        return {
            form: {
                name: "",
                album_id: "",
                cover_photo_: "",
                artist_id: "",
                year: "",
                genres: [],
            },
            validated: false,
            years: [{ value: "", text: "Seleccione el año del disco" }],
            preview: "",
            mainProps: {
                blank: true,
                blankColor: "#777",
                width: 200,
                height: 200,
                class: "m1",
            },
            token: "",
            tastes: [],
            albums: [{ id: "", name: "Seleccione un álbum..." }],
            artists: [{ id: "", name: "Seleccione un artista..." }],
        };
    },
    mounted() {
        this.rangeYear();
        let token = localStorage.getItem("access_token");
        let type = localStorage.getItem("type_token");
        this.token = type + " " + token;
        this.getTastes();
        this.getArtistas();
        this.getAlbums();
    },
    updated() {
        this.validarCampos();
    },
    methods: {
        rangeYear() {
            const max = new Date().getFullYear();
            const min = max - 100;

            for (let i = max; i >= min; i--) {
                this.years.push({
                    value: i,
                    text: i,
                });
            }
        },
        validarCampos() {
            let bool =
                this.validarNombre() &&
                this.validarFoto() &&
                this.validarYear() &&
                this.validarAlbum() &&
                this.validarGenero() &&
                this.validarArtista()
                console.warn("validarForm", bool);
            return (this.validated = bool);
        },
        validarNombre() {
            let bool;

            bool = this.form.name.length >= 2;
            console.log("validar_nombre", bool);
            return bool;
        },
        validarAlbum() {
            let bool;
            bool = this.form.album_id != "";
            console.log("validar_album", bool);

            return bool;
        },
        validarFoto() {
            let bool;
            bool = this.form.cover_photo_ != "";
            console.log("validar_foto", bool);

            return bool;
        },
        validarYear() {
            let bool;
            bool = this.form.year != "";
            console.log("validar_año", bool);

            return bool;
        },
        validarArtista() {
            let bool;
            bool = this.form.artist_id != "";
            console.log("validar_artis", bool);

            return bool;
        },
        validarGenero() {
            let bool;
            bool = this.form.genres != "";
            console.log("validar_genero", bool);

            return bool;
        },
        previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.form.cover_photo_ = this.preview = e.target.result;
                    //console.log("p", this.preview);
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        getTastes() {
            let url = "api/genres";
            let headers = {
                Authorization: this.token,
            };
            axios.get(url, { headers }).then((response) => {
                let data = response.data.data;
                data.forEach((element) => {
                    this.tastes.push(element);
                });
            });
        },
        getArtistas() {
            let url = "api/artists";
            let headers = {
                Authorization: this.token,
            };
            axios.get(url, { headers }).then((response) => {
                let data = response.data.data;
                data.forEach((element) => {
                    this.artists.push(element);
                });
            });
        },
        getAlbums() {
            let url = "api/albums";
            let headers = {
                Authorization: this.token,
            };
            axios.get(url, { headers }).then((response) => {
                let data = response.data.data;
                data.forEach((element) => {
                    this.albums.push(element);
                });
            });
        },
    },
};
</script>

<style>
</style>