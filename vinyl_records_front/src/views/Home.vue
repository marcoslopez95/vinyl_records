<template>
<div>
  <NavBarComponent />

  <BContainer class="center-xy">
    <BRow>
    <BCol>
      <BCard v-if="$route.path == '/'">
        <span class="text-center">
          <h4>Bienvenido a Vinyl Records</h4>
        </span>
        lorem imsump lorem imsumplorem imsumplorem imsumplorem imsump lorem imsump
        lorem imsump lorem imsumplorem imsumplorem imsumplorem imsump lorem imsump
        lorem imsump lorem imsumplorem imsumplorem imsumplorem imsump lorem imsump
        lorem imsump lorem imsumplorem imsumplorem imsumplorem imsump lorem imsump
        lorem imsump lorem imsumplorem imsumplorem imsumplorem imsump lorem imsump
        lorem imsump lorem imsumplorem imsumplorem imsumplorem imsump lorem imsump
        lorem imsump lorem imsumplorem imsumplorem imsumplorem imsump lorem imsump
      </BCard>
      <router-view v-else/>
    </BCol>
    </BRow>
  </BContainer>

  
</div>
</template>
<script>
//import HomeApi from "@/api/modules/HomeApi";
import NavBarComponent from '@/components/HomeView/NavBarComponent.vue';
import {
  BContainer,
  BRow,
  BCol,
  BCard
} from 'bootstrap-vue'
export default {
  name: "Home",
  components: {
    NavBarComponent,
    BContainer,
    BRow,
    BCol,
    BCard
  },
  computed: {},
  data: () => ({}),
  beforeCreate() {},
  created() {},
  beforeMount() {},
  mounted() {},
  beforeUpdate() {},
  updated() {},
  activated() {}, //when keep-alive
  deactivated() {}, //when keep-alive
  beforeDestroy() {},
  destroyed() {},
  methods: {
    // getDatList(){
    //   HomeApi.getDatList()
    // }
  },
};
</script>
<style scoped>
.center-xy {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}
</style>
