<template>
    <BCol class="text-end">
        <BButton variant="primary" v-b-modal.filtro> Filtrar </BButton>
        <BModal id="filtro" hide-header cancel-title="Cerrar" ok-title="Buscar" @ok="filtrar()" @show="vaciarForm()">
            <BRow class="mt-4">
                <BCol class="px-4">
                    <BCol class="mt-2">
                        <b-form-group
                            id="nombre"
                            label="Nombre del disco"
                            label-for="nombre"
                        >
                            <b-form-input
                                id="Nombre"
                                v-model="form.name"
                            ></b-form-input>
                        </b-form-group>
                    </BCol>
                    <BCol class="mt-2">
                        <b-form-group
                            id="artista"
                            label="Artista"
                            label-for="artista"
                        >
                            <b-form-input
                                id="artista"
                                v-model="form.artist"
                            ></b-form-input>
                        </b-form-group>
                    </BCol>
                    <BCol class="mt-2">
                        <b-form-group
                            id="album"
                            label="Álbum"
                            label-for="album"
                        >
                            <b-form-input
                                id="album"
                                v-model="form.album"
                            ></b-form-input>
                        </b-form-group>
                    </BCol>
                    <BCol class="mt-2">
                        <label for="example-datepicker">Fecha de eliminación</label>
                        <b-form-datepicker
                            id="example-datepicker"
                            v-model="form.deleted"
                            class="mb-2"
                        ></b-form-datepicker>
                    </BCol>
                </BCol>
            </BRow>
        </BModal>
    </BCol>
</template>

<script>
import {
    BCol,
    BButton,
    BFormDatepicker,
    BModal,
    BRow,
    BFormInput,
    BFormGroup,
} from "bootstrap-vue";
export default {
    name: "filtro-discos",
    components: {
        BCol,
        BButton,
        BFormDatepicker,
        BModal,
        BRow,
        BFormInput,
        BFormGroup,
    },
    data(){
        return {
            form:{
                name: '',
                artist: '',
                album: '',
                deleted: ''
            }
        }
    },
    methods: {
        filtrar(){
            console.log('modal');
            let array = [
                'name',
                'artist',
                'album',
                'deleted',
            ]
            let bool = false;
            array.forEach((element)=>{
                if(this.form[element] != ''){
                    bool = true;
                }
            })
            if(bool){
                this.$emit('filtrar',this.form)
            }else{
                this.$emit('filtrar',null)
            }
        },
        vaciarForm(){
            this.form.name= ''
            this.form.artist= ''
            this.form.album= ''
            this.form.deleted= ''
        }
    }
};
</script>

<style>
</style>