<template>
    <BreezeGuestLayout>

        <BreezeValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit($event)">
            <div>
                <BreezeLabel for="email" value="Correo electrónico" />
                <BreezeInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Contraseña" />
                <BreezeInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
            </div>

            <div class="w-full h-[50px] mt-5">
                <v-alert type="danger" v-if="error !== ''">
                    {{error}}
                </v-alert>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                >
                    ¿Olvidaste tu contraseña?
                </a>

                <BreezeButton
                    class="ml-4"
                    :class="{ 'opacity-25': boolSubmit }"
                    :disabled="boolSubmit"
                >
                    Iniciar Sesión
                </BreezeButton>

            </div>
        </form>
    </BreezeGuestLayout>

</template>
<script>
import BreezeButton from "@/Components/Button.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import VAlert from "@/Components/Alert.vue"
import axios from "axios";

export default {
    name: "login",
    components: {
        BreezeButton,
        VAlert,
        BreezeCheckbox,
        BreezeGuestLayout,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },
    props: {
        canResetPassword: Boolean,
        status: String,
    },
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            error: '',
            boolSubmit: false
        };
    },
    methods: {
        submit(e) {
            this.boolSubmit = true
            e.preventDefault()
            axios
                .post("/api/login", this.form)
                .then((response) => {
                    //console.log("response", response);
                    this.error = '';

                    let data = response.data.data

                    localStorage.setItem('token'  ,data.token)
                    localStorage.setItem("type"   ,data.type)
                    localStorage.setItem("expired",data.expired)
                    window.location.href = window.location.origin +'/'
                })
                .catch((error) => {
                    let e = error.response;
                    console.log("error", e);
                    this.boolSubmit = false
                    this.error = e.data.message
                });
        },
    },
};
</script>
