<template>
<div>
    <CardDiscosVue v-if="$route.name == ruta" :fields="fields" :name="name" :ruta="ruta"></CardDiscosVue>
    <router-view v-else></router-view>
</div>
</template>

<script>
import CardDiscosVue from '../components/HomeView/CardBase.vue'

export default {
    name: 'artistas',
    components: {
      CardDiscosVue
    },
    data(){
      return {
        items: [],
        name: 'artista',
        ruta: 'artists',
        fields: [
          {label: 'Nombre',key:'name'}
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