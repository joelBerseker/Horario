<template>
  <div>
    <DetailProduct
      :item="itemSelected"
      :changeMode="changeMode"
      :mode="mode"
      :pathName="pathName"
      :modalName="modalName"
      :getProductList="getProductList"
    />

    <transition name="t-extra-buttoms">
      <div v-if="!isBusy" class="nav_buttoms">
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

          <b-col class="pl-2">
            <b-button
              class="buttom_add"
              variant="primary"
              size="lg"
              block
              @click="detailProduct(item_new, 0)"
            >
              <b-icon icon="plus"></b-icon>
              <small>Agregar</small>
            </b-button>
          </b-col>
        </b-row>
      </div>
    </transition>
    <div>
      <b-table
        :busy="isBusy"
        hover
        :show-empty="!isBusy"
        :items="items"
        :fields="fields"
        responsive
        :per-page="perPage"
        :current-page="currentPage"
        empty-text="No hay registros para mostrar"
        empty-filtered-text="No hay registros para mostrar que coincidan con su solicitud"
      >
        <template #cell(option)="data">
          <b-button
            variant="secondary"
            size="sm"
            @click="detailProduct(data.item, 1)"
          >
            <b-icon icon="eye"></b-icon>&nbsp;Ver
          </b-button>
        </template>
        <template #table-busy>
          <div class="text-center c2 my-2" v-if="isBusy">
            <b-spinner class="align-middle"></b-spinner>&nbsp;
            <span>Cargando ...</span>
          </div>
        </template>
      </b-table>
      <div v-if="!isBusy && perPage < items.length">
        <b-pagination
          v-model="currentPage"
          :total-rows="rows"
          :per-page="perPage"
          aria-controls="my-table"
          align="center"
        ></b-pagination>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import DetailProduct from "@/components/InternSystem/Setting/Product/DetailProduct";
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
const url = process.env.VUE_APP_RUTA_API;

export default {
  mixins: [UtilityFunctions],
  components: {
    DetailProduct,
  },
  data() {
    return {
      item_new: {
        state: 0,
        typeproid: 0,
      },
      isBusy: true,
      modalName: "Product",
      pathName: "product",
      mode: 0, //0: agregar , 1: ver, 2: update
      itemSelected: {},
      perPage: 5,
      currentPage: 1,
      items: [],
      fields: [
        {
          key: "name",
          label: "Nombre",
        },
        {
          key: "description",
          label: "Descripción",
        },
        {
          key: "price",
          label: "Precio",
        },
        {
          key: "typeproname",
          label: "Tipo de producto",
        },
        {
          key: "promotion",
          label: "Promoción",
          formatter: (value) => {
            return this.selections[value].text;
          },
        },
        {
          key: "state",
          label: "Estado",
          formatter: (value) => {
            return this.status[value].text;
          },
        },
        {
          key: "option",
          label: "Opciones",
          tdClass: "toption-class text-center",
          thClass: "option-class text-center",
        },
      ],
    };
  },
  computed: {
    rows() {
      return this.items.length;
    },
  },
  methods: {
    changeMode(mode) {
      this.mode = mode;
    },
    detailProduct(item, mode) {
      this.itemSelected = Object.assign({}, item);
      this.mode = mode;
      this.$bvModal.show("detail-" + this.modalName + "-modal");
    },
    getProductList() {
      
      this.isBusy = true;
      var path = url + this.pathName;
      console.log(path);
      setTimeout(() => {
        axios
          .get(path)
          .then((response) => {
            this.items = response.data.data.products;
            console.log(response.data.data.products);
            this.isBusy = false;
          })
          .catch((error) => {
            this.makeToast(error, "danger");
          });
      }, 500);
    },
  },
  async created() {
    //await Service.access(1,typeofDush)
    await this.getProductList();
  },
};
</script>

<style scoped>
</style>
