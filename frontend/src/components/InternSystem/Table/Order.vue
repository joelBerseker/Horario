<template>
  <div>
    <b-modal
      id="add-order-modal"
      body-class="p-0"
      ref="modal"
      scrollable
      no-close-on-backdrop
      :title="'Mesa ' + table.id + ' - Agregar pedido'"
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
                    ><b-icon icon="search" scale="0.9"></b-icon
                  ></b-input-group-text>
                </template>
                <b-form-input
                  v-model="filter"
                  type="search"
                  placeholder="Buscar"
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
                empty-text="No se han agregado pedidos"
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
                <template #row-details="data">
                  <b-form-textarea
                  class="mb-1"
                    v-model="data.item.coment"
                    size="sm"
                    placeholder="Ingresa un comentario"
                  ></b-form-textarea>
                </template>
                <template #cell(name)="data">
                  <span class="mb-2">{{data.value}}</span>
                  <b-form-checkbox
                  size="sm"
                    v-model="data.detailsShowing"
                    @change="data.toggleDetails"
                  >
                    <small>Comentario</small>
                  </b-form-checkbox>
                </template>
                <template #cell(number)="data">
                  <div class="float-right">
                    <b-input-group size="sm">
                      <b-input-group-prepend>
                        <b-button
                          size="sm"
                          variant="outline-success"
                          @click="subtractAmount(data.item)"
                          class="btn-amount px-2"
                        >
                          &nbsp; <span class="btn-amount-text">-</span>
                        </b-button>
                      </b-input-group-prepend>
                      <b-input-group-text class="py-0 amount">
                        &nbsp;<small class="amount-text">{{
                          data.value
                        }}</small>
                      </b-input-group-text>
                      <b-input-group-append>
                        <b-button
                          size="sm"
                          variant="outline-success"
                          @click="addAmount(data.item)"
                          class="btn-amount px-2"
                        >
                          &nbsp;<span class="btn-amount-text">+</span>
                        </b-button>
                      </b-input-group-append>
                    </b-input-group>
                  </div>
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
  props: ["table"],
  data() {
    return {
      search: "",
      filter: "",
      filterOn: ["name", "typeproname"],
      orderList: [
        {
          name: "Ceviche",
          number: "99",
          delivered: 0,
          coment: "",
          _showDetails: false,
        },
        {
          name: "Care asasda",
          number: "0",
          delivered: 1,
          coment: "",
          _showDetails: true,
        },
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
          label: "Nombre",
        },
        {
          key: "number",
          label: "Cantidad",
          tdClass: "text-center",
          thClass: "text-center",
          thStyle: "width: 100px !important",
        },

        {
          key: "option",
          label: "",
          tdClass: "text-center",
          thClass: "text-center",
        },
      ],
    };
  },
  methods: {
    addAmount(item) {
      item.number++;
    },
    subtractAmount(item) {
      if (item.number > 0) {
        item.number--;
      }
    },
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
.btn-amount-text {
  position: absolute;
  left: 0;
  right: 0;
}
.amount-text {
  position: absolute;
  right: 0;
  left: 0;
}
.amount {
  position: relative;
  width: 35px !important;
}
.btn-amount {
  position: relative;
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
