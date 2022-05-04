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
          id: 13,
          count: 0,
          itemList: [
            { name: "Estofado", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
        {
          id: 14,
          count: 0,
          itemList: [
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
        {
          id: 15,
          count: 0,
          itemList: [
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
        {
          id: 16,
          count: 0,
          itemList: [
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
        {
          id: 17,
          count: 0,
          itemList: [
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
        {
          id: 18,
          count: 0,
          itemList: [
            { name: "Carne ", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
          ],
        },
        {
          id: 19,
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
