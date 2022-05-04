<template>
  <div>
    <div class="c1 main-title" body-class="">
      <b-row>
        <b-col class="text-aling-v-center">
          <h5 class="m-0 p-0">
            <b-icon icon="receipt"></b-icon>
            &nbsp;Pedidos
          </h5></b-col
        >
      </b-row>
    </div>
    <div class="main-body">
      <div class="container-masonry">
        <div v-for="item in orderList" :key="item.id" class="item-masonry">
          <OrderItem :item="item" :showTable="true" />
        </div>
      </div >
    </div>
  </div>
</template>

<script>
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
import OrderItem from "@/components/InternSystem/ReusableComponents/OrderItem";
export default {
  mixins: [UtilityFunctions],
  components: { OrderItem },
  data() {
    return {
      orderList: [
        {
          id: 12,
          itemList: [
            {
              name: "Ceviche",
              number: "2",
              delivered: 0,
              coment: "Sin lechuga",
              _showDetails: true,
            },
            { name: "Care asasda", number: "2", delivered: 1, coment: "" },
          ],
        },
        {
          id: 16,
          itemList: [
            { name: "Estofado", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
        {
          id: 17,
          itemList: [
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
        {
          id: 19,
          itemList: [
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
      ],
    };
  },
};
</script>

<style scoped>
</style>
