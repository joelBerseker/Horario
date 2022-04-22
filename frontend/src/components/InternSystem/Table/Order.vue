<template>
  <div>
    <b-modal
      id="add-order-modal"
      body-class="p-0"
      ref="modal"
      scrollable
      no-close-on-backdrop
      title="Agregar pedido"
      @ok="handleOk"
      ok-title="Agregar"
      cancel-title="Cancelar"
    >
      <b-card no-body class="order-tab">
        <b-tabs card class="nav-order">
          <b-tab title="Productos" active>
            <div>
              <p class="c2">Ultimo agregado</p>
              <b-input-group prepend="$" class="mb-3">
                <template #prepend>
                  <b-input-group-text class="item-left"
                    ><b-icon icon="search" scale="0.9"></b-icon></b-input-group-text
                  >
                </template>
                <b-form-input
                  v-model="filter"
                  type="search"
                  placeholder="Escribe para buscar"
                >
                </b-form-input>
              </b-input-group>

              <div class="mb-3">
                <b-button
                  v-for="item in typeOfProductList"
                  :key="item.id"
                  variant="success"
                  size="sm"
                  class="mr-1 mb-1"
                  @click="filterByType(item.name)"
                >
                  {{ item.name }}
                </b-button>
              </div>

              <b-table
                :filter="filter"
                :filter-included-fields="filterOn"
                :items="productList"
                :fields="productFields"
                responsive
                hover
                show-empty
                @row-clicked="addOrderToList"
                thead-class="d-none"
                class="table-add-order"
                empty-text="No hay registros para mostrar"
                empty-filtered-text="No hay registros para mostrar que coincidan con su solicitud"
              >
              </b-table>
              

            </div>
          </b-tab>
          <b-tab title="Pedidos">
            <div>
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
            </div>
          </b-tab>
        </b-tabs>
      </b-card>
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
      filter: "",
      filterOn: ["name", "typeproname"],
      orderList: [
        { name: "Ceviche", number: "12", delivered: 0 },
        { name: "Care asasda", number: "2", delivered: 1 },
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
          tdClass: "text-right",
          thClass: "text-right",
        },

        {
          key: "option",
          label: "Opciones",
          tdClass: "text-center",
          thClass: "text-center",
        },
      ],
    };
  },
  methods: {
    deleteOrderFromList(index) {
      this.orderList.splice(index, 1);
    },
    addOrderToList(item) {
      console.log(item);
      this.orderList.unshift({ name: item.name, number: 1 });
    },
    handleOk() {},
    filterByType(name) {
      this.filter = name;
    },
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
.item-left {
  border-top-left-radius: 0rem !important;
  border-bottom-left-radius: 0rem !important;
}
.table-add-order td {
}
.order-tab {
  border-radius: 0px !important;
  border: none !important;
}
.order-tab .nav-link.active {
  color: var(--color-2) !important;
}
.order-tab .card-header {
  border-bottom: 0px !important;
  background-color: #7c7c7c2f;
  padding-left: 1rem;
  padding-right: 1rem;
  border-radius: 0px !important;
  padding-top: 0.25rem;
}

.table-add-order thead th {
  border: none;
  background-color: var(--color-1) !important;
  color: gray !important;
}
.nav-order a {
  color: #707070;
}
.title-modal-order {
  padding-left: 1rem;
  padding-right: 1rem;
}
.nav-tabs .nav-link {
  margin-bottom: -2px !important;
}
.order-tab .card-header-tabs {
  margin-left: 0rem;
  margin-right: 0rem;
}
</style>
