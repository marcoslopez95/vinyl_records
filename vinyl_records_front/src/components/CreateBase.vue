<template>
  <BCard>
    <b-button variant="primary" @click="$router.go(-1)">Regresar</b-button>
    <slot></slot>
    <div class="text-center">
        <BButton variant="success" :disabled="!validated" @click="submit()">Guardar</BButton>
    </div>
  </BCard>
</template>

<script>
import {BCard } from 'bootstrap-vue'
import axios from 'axios'

export default {
    name: 'create-base',
    props:{
        form: Object,
        validated: {type:Boolean, default:false},
        ruta: String,
        method: String
    },
    data(){
        return {
            
        }
    },
    components:{
        BCard
    },
    methods: {
        submit(){
            let url = import.meta.env.VITE_APP_BACKEND+'/api/'+this.ruta
            let token = localStorage.getItem('access_token')
            let type = localStorage.getItem('type_token')
            let auth = type + ' ' + token
            let config = {
                headers:{

                    Authorization:auth,
                },
            url:url,
            method: this.method,
            data: this.form,
            }
            axios(
                config
            ).then((response)=>{
                let data = response.data
                //EventBus.$emit('create',this.ruta)
                if(this.method == 'put'){
                    this.ruta = this.ruta.split('/')[0]
                }
                this.$router.push({name:this.ruta})
            }).catch((error) =>{
                let e = error.response.data
                console.log('error_create',e)
            })
        }
    }
}
</script>

<style>

</style>