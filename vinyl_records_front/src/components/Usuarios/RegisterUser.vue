<template>
    <div>
        <BCard>
            <b-button variant="primary" @click="$router.go(-1)"
                >Regresar</b-button
            >
            <BRow class="mt-4">
                <BCol>
                    <b-form-group
                        id="nombre"
                        label="Nombres"
                        label-for="nombre"
                    >
                        <b-form-input
                            id="Nombre"
                            v-model="form.first_name"
                            @keypress="validarNombre()"
                        ></b-form-input>
                    </b-form-group>
                </BCol>
                <BCol>
                    <b-form-group
                        id="apellido"
                        label="Apellidos"
                        label-for="apellido"
                    >
                        <b-form-input
                            id="apellido"
                            v-model="form.last_name"
                            @keypress="validarNombre()"
                        ></b-form-input>
                    </b-form-group>
                </BCol>
                <BCol>
                    <b-form-group
                        id="email"
                        label="Correo Electrónico"
                        label-for="email"
                    >
                        <b-form-input
                            id="email"
                            type="email"
                            v-model="form.email"
                            @keypress="validarNombre()"
                        ></b-form-input>
                    </b-form-group>
                </BCol>
                <BCol>
                    <b-form-group id="phone" label="Telefono" label-for="phone">
                        <b-form-input
                            id="phone"
                            v-model="form.phone"
                            @keypress="validarNombre()"
                        ></b-form-input>
                    </b-form-group>
                </BCol>
            </BRow>

            <BRow class="mt-3">
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
                                @change="previewImage($event)"
                            />
                        </div>
                    </div>
                </BCol>
            </BRow>
            <hr />
            <p>Seleccione sus gustos Musicales: </p>
            <div class="form-check form-check-inline" v-for="(option,i) in tastes" :key="i">
                <input
                    class="form-check-input"
                    type="checkbox"
                    :id="'check'+i"
                    :value="option.item"
                    v-model="form.tastes"
                />
                <label class="form-check-label" :for="'check'+i">{{option.name}}</label>
            </div>
            <hr />
            <BRow class="mt-2">
                <BCol sm="2">
                    <b-form-group
                        id="password"
                        label="Contraseña"
                        label-for="password"
                    >
                        <b-form-input
                            id="password"
                            type="password"
                            v-model="form.password"
                            @keypress="validarNombre()"
                        ></b-form-input>
                    </b-form-group>
                </BCol>
                <BCol sm="2">
                    <b-form-group
                        id="password_confirmation"
                        label="Confirmar Contraseña"
                        label-for="password_confirmation"
                    >
                        <b-form-input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            @keypress="validarNombre()"
                        ></b-form-input>
                    </b-form-group>
                </BCol>
            </BRow>
            <div class="text-center">
                <BButton variant="success" :disabled="!validated"
                    >Guardar</BButton
                >
            </div>
        </BCard>
    </div>
</template>

<script>
import { BButton, BImg, BFormCheckboxGroup, BFormGroup } from "bootstrap-vue";
import axios from "axios";
import headers from "@/api/auth";

export default {
    components: { BButton, BImg, BFormCheckboxGroup, BFormGroup },
    data() {
        return {
            form: {
                first_name: "",
                last_name: "",
                phone: "",
                avatar: "",
                email: "",
                password: "",
                password_confirmation: "",
                tastes: [],
            },
            tastes: [],
            preview: "",
            validated: false,
            mainProps: {
                blank: true,
                blankColor: "#777",
                width: 200,
                height: 200,
                class: "m1",
            },
        };
    },
    mounted() {
        this.getTastes();
    },
    methods: {
        validarNombre() {
            this.validated = this.form.name.length >= 2;
        },
        previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = (e) => {
                    this.form.avatar = this.preview = e.target.result;
                    console.log("p", this.preview);
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
        getTastes() {
            let url = "api/genres";
            axios.get(url, headers).then((response) => {
                let data = response.data.data;
                data.forEach((element) => {
                    this.tastes.push({
                        item: element.id,
                        name: element.name,
                    });
                });
            });
        },
    },
};
</script>

<style>
</style>