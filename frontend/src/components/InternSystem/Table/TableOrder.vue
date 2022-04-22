<template>
  <div class="main-body">
    <AddOrder />
    <transition name="t-extra-buttoms">
      <div class="nav_buttoms">
        <b-row>
          <b-col cols="auto" class="pr-0">
            <b-button
              variant="link "
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
                <b-icon icon="pencil-square" scale="0.9"></b-icon>
                &nbsp;Editar
              </small>
            </b-button>
          </b-col>
          <b-col class="pl-2">
            <b-button
              class="buttom_float"
              variant="primary"
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
    <b-card class="c1 table-card mb-2">
      <b-card-text class="py-0">
        <b-row>
          <b-col cols="auto" v-on:click="back()" class="pr-0">
            <h5 class="mt-1"><b-icon icon="arrow-left"></b-icon></h5>
          </b-col>
          <b-col>
            <h5 class="mt-1">Mesa {{ item.id }}</h5>
          </b-col>
          <b-col cols="auto">
            <div
              :class="'state-table ' + state_validation[item.reserved].class"
            >
              <h6 class="m-0 p-0">
                {{ state_validation[item.reserved].text }}
                <span v-if="item.reserved == 2"> {{ item.hour }}</span>
              </h6>
            </div>
          </b-col>
        </b-row>
      </b-card-text>
    </b-card>
    <b-row>
      <b-col cols="12" lg="6" xl="4" v-for="item in orderList" :key="item.id">
        <b-card class="table-card c1 mb-2">
          <b-card-text>
            <b-row>
              <b-col>
                <h5 class="mt-1">Pedido {{ item.id }}</h5>
              </b-col>
              <b-col cols="12">
                <b-table
                  :busy="isBusy"
                  :show-empty="!isBusy"
                  :items="item.itemList"
                  :fields="fields"
                  responsive
                  class="table-order"
                  empty-text="No hay registros para mostrar"
                  empty-filtered-text="No hay registros para mostrar que coincidan con su solicitud"
                >
                  <template #cell(delivered)="data">
                    <b-form-checkbox
                      v-model="data.value"
                      value="accepted"
                      unchecked-value="not_accepted"
                      size="lg"
                    >
                    </b-form-checkbox>
                  </template>
                </b-table>
              </b-col>
            </b-row>
          </b-card-text>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
import AddOrder from "@/components/InternSystem/Table/Order";
export default {
  mixins: [UtilityFunctions],
  components: { AddOrder },
  data() {
    return {
      sortBy: "id",
      sortDirection: "asc",
      item: this.$route.params.itemSelected,
      orderList: [
        {
          id: 12,
          itemList: [
            { name: "Ceviche", number: "2", delivered: 0 },
            { name: "Care asasda", number: "2", delivered: 1 },
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
      fields: [
        {
          key: "name",
          label: "",
        },
        {
          key: "number",
          label: "Cantidad",
          tdClass: "text-right",
          thClass: "text-right",
        },
        {
          key: "delivered",
          label: "Entregado",
          tdClass: "text-center",
          thClass: "text-center",
          formatter: (value) => {
            return value ? true : false;
          },
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
.table-order td {
  color: var(--color-1) !important;
}
.table-order thead th {
  border: none;
}
</style>
