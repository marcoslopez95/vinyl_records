<template>
<div>
    <CardDiscosVue v-if="$route.name == ruta" :fields="fields" :name="name" :ruta="ruta"></CardDiscosVue>
    <router-view v-else></router-view>
</div>
</template>

<script>
import CardDiscosVue from '../components/HomeView/CardBase.vue'

export default {
    name: 'generos',
    components: {
      CardDiscosVue
    },
    data(){
      return {
        items: [],
        name: 'Usuario',
        ruta: 'users',
        fields: [
          {label: 'Nombres',key:'first_name'},
          {label: 'Apellidos',key:'last_name'},
          {label: 'Email',key:'email'},
          {label: 'Telefono',key:'phone'},
          {label: 'Rol',key:'rol_name'},
        ]
      }
    },
    mounted(){
        
    },
    methods:{
      
    }
}
</script>

<style>

</style>