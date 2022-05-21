<template>
    <div>
        <CreateBase :form="form" :ruta="'albums/'+id" :validated="validated" method="put">
            <BRow class="mt-4">
                <BCol>
                    <b-form-group
                        id="nombre"
                        description="Introduzca el nombre del álbum"
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
            </BRow>
            
        </CreateBase>
    </div>
</template>

<script>
import CreateBase from "@/components/CreateBase.vue";
import { BButton } from "bootstrap-vue";
import axios from 'axios';
import headers from '@/api/auth'
export default {
    components: { CreateBase,BButton },
    data(){
      return {
        form:{
          name: ''
        },
        validated: false,
        id: ''
      }
    },
    mounted(){
        this.id = this.$route.params.id;
        this.getData()
    },
    methods:{
      validarNombre(){
        this.validated = this.form.name.length >= 2
      },
      getData(){
          
          let url = 'api/albums/'+this.id
          axios.get(url,headers).then((response)=>{
              let data = response.data.data
              this.form.name = data.name
              this.validarNombre()
          }).catch((error)=>{

          })
      }
    }

};
</script>

<style>
</style>