<template>
    <div class="center-xy">
        <BCard
            align="center"
            header="Iniciar Sesión"
            header-class="fs-4 text"
            style="max-width: 55%"
        >
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"
                    ><BIconPersonFill
                /></span>
                <input
                    v-model="form.email"
                    type="email"
                    @keypress="checkEnter($event)"
                    class="form-control"
                    placeholder="Correo Electrónico"
                    aria-label="Username"
                    aria-describedby="addon-wrapping"
                />
            </div>

            <div class="input-group flex-nowrap mt-2">
                <span class="input-group-text" id="addon-wrapping"
                    ><BIconLockFill
                /></span>
                <input
                    @keypress="checkEnter($event)"
                    v-model="form.password"
                    type="password"
                    class="form-control"
                    placeholder="Contraseña"
                    aria-label="password"
                    aria-describedby="addon-wrapping"
                />
            </div>

            <BRow class="mt-2">
                <BCol>
                    <b-alert :show="error !== ''" variant="danger">{{error}}</b-alert>
                </BCol>
            </BRow>

            <BRow class="mt-3">
                <BCol>
                    <BButton variant="danger">
                        Registrarse
                    </BButton>
                </BCol>
                <BCol>
                    <BButton variant="primary" @click="Login()" :disabled="submit">
                        Iniciar Sesión
                    </BButton>
                </BCol>
            </BRow>
        </BCard>
    </div>
</template>

<script>
import axios from "axios";
import {
    BCard,
    BRow,
    BCol,
    BForm,
    BInputGroup,
    BFormInput,
    BButton,
    BIconPersonFill,
    BIconLockFill,
    BInputGroupText,
    BAlert
} from "bootstrap-vue";
export default {
    name: "login",
    components: {
        BCard,
        BAlert,
        BIconPersonFill,
        BIconLockFill,
        BInputGroupText,
        BForm,
        BInputGroup,
        BFormInput,
        BButton,
        BRow,
        BCol,
    },
    data(){
        return {
            form: {
                email: '',
                password: '',
            },
            error: '',
            submit: false,
        }
    },
    methods: {
        Login(){
            let url = '/api/login'
            this.submit = true
            this.error = ''

            axios.post(url,this.form).then((response)=>{
                let data = response.data.data

                localStorage.setItem('access_token',data.token)
                localStorage.setItem('type_token',data.type)
                localStorage.setItem('first_name',data.first_name)
                localStorage.setItem('expired_token',data.expired)

                let auth = data.type + ' ' + data.token
                axios.defaults.headers.common['Authorization'] = auth;
                //console.log('login',data);
                this.$router.push('/')
            }).catch((error) =>{
                let e = error.response.data
                this.error = e.message
                this.submit = false
                //console.log('error',e);
            })
        },
        checkEnter(event){
            let key = event.keyCode
            if(key == 13){
                this.Login()
            }
        }
    }
};
</script>

<style>
.center-xy {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}
</style>