<template>
  <div>
    <b-modal
      class-body="p-0"
      id="add-order-modal"
      ref="modal"
      scrollable
      no-close-on-backdrop
      :hide-header="true"
      @ok="handleOk"
      ok-title="Agregar"
      cancel-title="Cancelar"
    >
      <b-form-input
        v-model="filter"
        type="search"
        placeholder="Escribe para buscar"
      >
      </b-form-input>
      <div class="my-2">
        <b-button
          v-for="item in typeOfProductList"
          :key="item.id"
          variant="success"
          size="sm"
          class="mr-1 mb-1"
          @click="filterByType(item)"
        >
          {{item.name}}
        </b-button>
      </div>

      <b-table
        :filter="filter"
        :filter-included-fields="filterOn"
        :items="productList"
        :fields="productFields"
        responsive
        show-empty
        thead-class="d-none "
        class="table-add-order"
        empty-text="No hay registros para mostrar"
        empty-filtered-text="No hay registros para mostrar que coincidan con su solicitud"
      >
        <template #cell(option)="data">
          <b-button
            variant="secondary"
            size="sm"
            @click="addOrderToList(data.item)"
          >
            <b-icon icon="plus"></b-icon>&nbsp;Agregar
          </b-button>
        </template>
      </b-table>
      <div class="bg2 c1 py-2 px-3 title-selected mb-2">Pedido</div>
      <b-table
        :items="orderList"
        :fields="orderFields"
        responsive
        show-empty
        class="table-add-order"
        empty-text="No hay registros para mostrar"
        empty-filtered-text="No hay registros para mostrar que coincidan con su solicitud"
      >
        <template #cell(option)="data">
          <b-button
            variant="danger"
            size="sm"
            @click="deleteOrderFromList(data.index, 1)"
          >
            <b-icon icon="trash"></b-icon>
          </b-button>
        </template>
      </b-table>
    </b-modal>
  </div>
</template>

<script>
import axios from "axios";
const url = process.env.VUE_APP_RUTA_API;
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
export default {
  mixins: [UtilityFunctions],
  components: {},
  data() {
    return {
      search: "",
      filter: null,
      filterOn: ["name"],
      orderList: [
        { name: "Ceviche", number: "x2", delivered: 0 },
        { name: "Care asasda", number: "x2", delivered: 1 },
      ],
      productList: [],
      typeOfProductList: [],
      productFields: [
        {
          key: "name",
          label: "Nombre",
        },
        {
          key: "option",
          label: "Opciones",
        },
      ],
      orderFields: [
        {
          key: "name",
          label: "",
        },
        {
          key: "number",
          label: "Cantidad",
        },
      
        {
          key: "option",
          label: "Opciones",
        },
      ],
    };
  },
  methods: {
    deleteOrderFromList(index){
      this.orderList.splice(index,1)
    },
    addOrderToList(item) {
      console.log(item);
      this.orderList.unshift({name: item.name, number: 1});
    },
    handleOk() {},
    filterByType() {},
    getTypeOfProductList() {
      var path = url + "typeproduct";

      axios
        .get(path)
        .then((response) => {
          this.typeOfProductList = response.data.data.typeProducts;
        })
        .catch((error) => {
          this.makeToast(error, "danger");
        });
    },
    getProductList() {
      var path = url + "product";

      axios
        .get(path)
        .then((response) => {
          this.productList = response.data.data.products;
        })
        .catch((error) => {
          this.makeToast(error, "danger");
        });
    },
  },
  async created() {
    //await Service.access(1,typeofDush)
    await this.getProductList();
    this.getTypeOfProductList();
  },
};
</script>

<style>
.table-add-order td {
}
.table-add-order thead th {
  border: none;
  background-color: var(--color-1) !important;
  color: gray !important;
}
</style>
