<template>
<div>
  <CardBase></CardBase>
</div>
</template>

<script>
import CardBase from './CardBase.vue'

export default {
  name:'CardDiscos',
  components:{ CardBase,},
  data(){
    return {
      ruta: 'discos'
    }
  }
}
</script>

<style>

</style>