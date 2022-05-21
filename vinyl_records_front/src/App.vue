<template>
  <div id="app">
    <NavBarComponent v-if="$route.path != '/login'"/>
    <router-view></router-view>
  </div>
</template>
<script>
import NavBarComponent from '@/components/HomeView/NavBarComponent.vue';
export default {
  name: "App",
  components:{
    NavBarComponent,
  },
  mounted(){
  }
};
</script>
<style>
@import url('./app.css');
</style>