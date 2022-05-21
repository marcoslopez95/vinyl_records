<template>
    <div>
        <BContainer class="top_custom" fluid>
            <router-view v-if="$route.path != '/'" style="width:100%"/>
            <BCard v-else>
                <span class="text-center">
                    <h4>Bienvenido a Vinyl Records</h4>
                </span>
                lorem imsump lorem imsumplorem imsumplorem imsumplorem imsump
                lorem imsump lorem imsump lorem imsumplorem imsumplorem
                imsumplorem imsump lorem imsump lorem imsump lorem imsumplorem
                imsumplorem imsumplorem imsump lorem imsump lorem imsump lorem
                imsumplorem imsumplorem imsumplorem imsump lorem imsump lorem
                imsump lorem imsumplorem imsumplorem imsumplorem imsump lorem
                imsump lorem imsump lorem imsumplorem imsumplorem imsumplorem
                imsump lorem imsump lorem imsump lorem imsumplorem imsumplorem
                imsumplorem imsump lorem imsump
            </BCard>
        </BContainer>
    </div>
</template>
<script>
//import HomeApi from "@/api/modules/HomeApi";

import { BContainer, BRow, BCol, BCard } from "bootstrap-vue";
export default {
    name: "Home",
    components: {
        BContainer,
        BRow,
        BCol,
        BCard,
    },
};
</script>
<style scoped>
.top_custom {
    margin-top: 80px;
}
</style>
