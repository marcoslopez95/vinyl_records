<template>
    <div>
        <CreateBase :form="form" ruta="artists" :validated="validated" method="post">
            <BRow class="mt-4">
                <BCol>
                    <b-form-group
                        id="nombre"
                        description="Introduzca el nombre del artista"
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

export default {
    components: { CreateBase,BButton },
    data(){
      return {
        form:{
          name: ''
        },
        validated: false
      }
    },
    methods:{
      validarNombre(){
        this.validated = this.form.name.length >= 2
      }
    }

};
</script>

<style>
</style>