<template>
<div>
<CardDiscosVue :fields="fields" :items="records" :name="name"></CardDiscosVue>
</div>
</template>

<script>
import axios from 'axios'
import CardDiscosVue from '../components/HomeView/CardBase.vue'
export default {
    name: 'discos',
    components: {
      CardDiscosVue
    },
    data(){
      return {
        records: [],
        name: 'Disco',
        fields: [
          {label: 'Nombre',key:'name'}
        ]
      }
    },
    methods:{
      getDiscos(){
        let url = 'api/records'
        axios.get(url).then((response)=>{
          let data = response.data.data
          console.log('discos',data);
          this.records.push(data)
        }).catch((error)=>{
          let e = error.response.data.data
          console.log('error_records',e);
        })
      }
    }
}
</script>

<style>

</style>