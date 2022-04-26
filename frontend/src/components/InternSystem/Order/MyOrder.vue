<template>
  <div>
    <div class="c1 main-title" body-class="">
      <b-row>
        <b-col class="text-aling-v-center">
          <h5 class="m-0 p-0">
            <b-icon icon="person-lines-fill"></b-icon>
            &nbsp;Mis pedidos
          </h5></b-col
        >
      </b-row>
    </div>
    <div class="main-body">
      <b-row>
        <b-col cols="12" lg="6" xl="4" v-for="item in orderList" :key="item.id">
          <OrderItem :item="item" :showTable="true" />
        </b-col>
      </b-row>
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
          count: 0,
          itemList: [
            {
              name: "Ceviche",
              number: "2",
              delivered: 0,
              coment: "Sin lechuga",
            },
            { name: "Care asasda", number: "2", delivered: 1, coment: "" },
          ],
        },
        {
          id: 16,
          count: 0,
          itemList: [
            { name: "Estofado", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
        {
          id: 17,
          count: 0,
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
