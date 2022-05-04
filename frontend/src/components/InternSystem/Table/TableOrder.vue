<template>
  <div>
    <AddOrder :table="item" />
    <transition name="t-extra-buttoms">
      <div class="nav_buttoms">
        <b-row>
          <b-col cols="auto" class="pr-0">
            <b-button
              variant="dark "
              class="c1 bg4 px-2 icon_menu_simulation"
              size="lg"
            >
              <b-icon icon="list"></b-icon>
            </b-button>
          </b-col>
          <b-col class="pl-2 pr-0" cols="auto">
            <b-button
              class="buttom_float px-3"
              variant="warning"
              size="lg"
              @click="detailProduct(item_new, 0)"
            >
              <small>
                <b-icon icon="credit-card2-front" scale="0.9"></b-icon>
                &nbsp;Finalizar
              </small>
            </b-button>
          </b-col>
          <b-col class="pl-2">
            <b-button
              class="buttom_float"
              variant="success"
              size="lg"
              block
              @click="addOrder()"
            >
              <small
                ><b-icon icon="plus" scale="1.2"></b-icon>&nbsp;Agregar
                pedido</small
              >
            </b-button>
          </b-col>
        </b-row>
      </div>
    </transition>

    <div class="c1 main-title" body-class="">
      <b-row>
        <b-col class="text-aling-v-center" v-on:click="back()">
          <h5 class="m-0 p-0">
            <b-icon icon="arrow-left"></b-icon>&nbsp;&nbsp;Mesa {{ item.id }}
          </h5></b-col
        >
        <b-col cols="auto">
          <div :class="'state-table ' + state_validation[item.reserved].class">
            <h6 class="m-0 p-0">
              {{ state_validation[item.reserved].text }}
              <span v-if="item.reserved == 2"> {{ item.hour }}</span>
            </h6>
          </div>
        </b-col>
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
import AddOrder from "@/components/InternSystem/Table/Order";
import OrderItem from "@/components/InternSystem/ReusableComponents/OrderItem";
export default {
  mixins: [UtilityFunctions],
  components: { AddOrder, OrderItem },
  data() {
    return {
      sortBy: "id",
      sortDirection: "asc",
      item: this.$route.params.itemSelected,
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
      ],
    };
  },
  methods: {
    back() {
      this.$router.push({ name: "Table" });
    },
    addOrder() {
      this.$bvModal.show("add-order-modal");
    },
  },
};
</script>

<style>
</style>
