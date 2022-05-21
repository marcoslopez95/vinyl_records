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
import config from '../api/auth'
import axios from 'axios'

export default {
    name: 'create-base',
    props:{
        form: Object,
        validated: {type:Boolean, default:false},
        ruta: String,
        method: String
    },
    components:{
        BCard
    },
    methods: {
        submit(){
            let url = '/api/'+this.ruta
            config['url']= url
            config['method']= this.method,
            config['data']= this.form,
            console.log('headers',config);
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