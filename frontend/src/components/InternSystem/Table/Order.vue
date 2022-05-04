<template>
  <div>
    <b-modal
      id="add-order-modal"
      body-class="p-0 order-modal-body"
      ref="modal"
      scrollable
      no-close-on-backdrop
      :title="'Mesa ' + table.id + ' | Agregar pedido'"
      @ok="handleOk"
      ok-title="Agregar"
      cancel-title="Cancelar"
    >
      <b-card no-body class="order-tab">
        <b-tabs card class="nav-order">
          <b-tab active>
            <template #title>
              <b-icon icon="box-seam" scale="0.9"></b-icon>&nbsp;Productos
            </template>
            <div>
              <p class="c2">Ultimo agregado</p>

              <div>
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
              <div class="py-2" id="section2">
                <b-input-group v-on:click="redirec()">
                  <template #prepend>
                    <b-input-group-text class="item-left"
                      ><b-icon icon="search" scale="0.9"></b-icon
                    ></b-input-group-text>
                  </template>
                  <b-form-input
                    id="input-search"
                    v-model="filter"
                    type="search"
                    placeholder="Buscar"
                    autocomplete="off"
                  >
                  </b-form-input>
                </b-input-group>
              </div>

              <b-table
                :filter="filter"
                :filter-included-fields="filterOn"
                :items="productList"
                :fields="productFields"
                primary-key="id"
                responsive
                hover
                show-empty
                @row-clicked="addOrderToList"
                thead-class="d-none"
                class="table-add-order-product"
                empty-text="No hay registros para mostrar"
                empty-filtered-text="No hay registros para mostrar que coincidan con su solicitud"
              >
                <template #cell(name)="data">
                  <span>{{ data.value }}</span>

                  <span>
                    <b-icon
                      :class="'add-signal ' + data.item.addedClass"
                      icon="plus"
                    >
                    </b-icon>
                  </span>
                </template>
                <template #cell(option)="data">
                  <h5 v-if="data.item.added" class="m-0 p-0">
                    <b-icon class="c23" icon="check-circle-fill"></b-icon>
                  </h5>
                </template>
              </b-table>
            </div>
          </b-tab>
          <b-tab>
            <template #title>
              <div class="order-count-place">
                <b-icon icon="receipt" scale="0.9"></b-icon>&nbsp;Pedidos&nbsp;
                <div class="order-count-container">
                  <div class="order-count-text">
                    {{ orderList.length }}
                  </div>
                </div>
              </div>
            </template>
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
                    @click="deleteOrderFromList(data, 1)"
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
                  <span class="mb-2">{{ data.value }}</span>
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
                          variant="success"
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
                          variant="success"
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
          label: "",
          tdClass: "text-right",
          thClass: "text-right",
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
    redirec() {
      window.location.href = "#section2";
      document.getElementById("input-search").focus();
    },
    addAmount(item) {
      item.number++;
    },
    subtractAmount(item) {
      if (item.number > 0) {
        item.number--;
      }
    },
    deleteOrderFromList(item) {
      console.log(item);
      var product = this.productList.find(
        (element) => element.id === item.item.id
      );
      console.log(product);
      product.added = false;
      this.orderList.splice(item.index, 1);
    },
    addOrderToList(item) {
      console.log(item);
      if (item.added) {
        this.makeToast("El producto ya se agrego", "danger");
      } else {
        item.added = true;
        item.addedClass = "add-signal-added";
        setTimeout(() => {
          item.addedClass = "";
          //this.filter = "";
        }, 500);
        console.log(item);
        this.orderList.unshift({ name: item.name, number: 1, id: item.id });
      }
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
.order-count-place {
  position: relative;
  margin-right: calc(23px);
}

.order-tab .nav-link.active .order-count-container{
  background-color: var(--color-2);
  color: var(--color-1);
}
.order-count-text {
  position: relative;
  text-align: center;
  font-size: 80%;
  margin-top: 2px;
}
.order-count-container {
  width: 23px;
  height: 23px;
  background-color: var(--color-1);
  color: var(--color-2);
  border-radius: 100px;
  position: absolute;
  right: -1.5rem;
  top: 0;
}

.t-add-signal-enter-active {
  animation: adSignalKeyframe 0.7s;
}

.order-modal-body {
  overflow-x: hidden;
}
.add-signal {
  position: absolute;
  margin-left: 2rem;
  margin-top: 0.25rem;
  color: var(--color-23);

  opacity: 0;
}
.add-signal-added {
  /*transform: scale(5);
  opacity: 1;*/
  animation-duration: 0.5s;
  animation-name: adSignalKeyframe;
}
@keyframes adSignalKeyframe {
  0% {
    opacity: 0;
  }
  30% {
    opacity: 1;
    transform: scale(2.5);
  }
  100% {
    opacity: 0;
    transform: translateX(4rem);
  }
}

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

.table-add-order-product td {
  border-top: none !important;
  border-bottom: 1px solid #dee2e6;
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
  background-color: var(--color-2);
  color: var(--color-2) !important;
  padding-left: 1rem;
  padding-right: 1rem;
  border-radius: 0px !important;
  padding-top: 0.25rem;
}

.order-tab .nav-link:hover {
  border-color: transparent !important;
  background-color: rgba(255, 255, 255, 0.212);
  color: var(--color-1);
}
.order-tab .nav-link {
  color: var(--color-1);
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
