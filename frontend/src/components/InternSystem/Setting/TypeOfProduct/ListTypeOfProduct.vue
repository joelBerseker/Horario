<template>
  <div>
    <DetailTypeOfProduct
      :item="itemSelected"
      :changeMode="changeMode"
      :mode="mode"
      :pathName="pathName"
      :modalName="modalName"
      :getTypeOfProductList="getTypeOfProductList"
    />

    <b-button
      v-if="!isBusy"
      class="buttom_add"
      variant="primary"
      @click="detailTypeOfProduct(item_new, 0)"
    >
      <div>
        <div class="icon_add"><b-icon icon="plus"></b-icon></div>
        <div class="text_add"><small>Agregar</small></div>
      </div>
    </b-button>

    <b-table
      :busy.sync="isBusy"
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
          @click="detailTypeOfProduct(data.item, 1)"
        >
          <b-icon icon="box-arrow-in-up-right"></b-icon>&nbsp;Ver
        </b-button>
      </template>
      <template #table-busy>
        <div class="text-center c2 my-2">
          <b-spinner class="align-middle"></b-spinner>&nbsp;
          <strong>Cargando ...</strong>
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
</template>

<script>
import axios from "axios";
import DetailTypeOfProduct from "@/components/InternSystem/Setting/TypeOfProduct/DetailTypeOfProduct";
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
const url = process.env.VUE_APP_RUTA_API;

export default {
  mixins: [UtilityFunctions],
  components: {
    DetailTypeOfProduct,
  },
  data() {
    return {
      item_new: {
        state: 0,
      },
      isBusy: true,
      modalName: "TypeOfProduct",
      pathName: "typeproduct",
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
    detailTypeOfProduct(item, mode) {
      this.itemSelected = Object.assign({}, item);
      this.mode = mode;
      this.$bvModal.show("detail-" + this.modalName + "-modal");
    },
    getTypeOfProductList() {
      this.isBusy = true;
      var path = url + this.pathName;
      setTimeout(() => {
        axios
          .get(path)
          .then((response) => {
            this.items = response.data.data.typeProducts;
            this.isBusy = false;
          })
          .catch((error) => {
            this.makeToast(error, "danger");
          });
      }, 2000);
    },
  },
  async created() {
    //await Service.access(1,typeofDush)
    await this.getTypeOfProductList();
  },
};
</script>

<style scoped>
.buttom_add {
  border-radius: 100px !important;
  position: fixed; /* Stay in place */
  bottom: 0;
  right: 0;
  margin: 0.3rem;
  z-index: 100;
  padding: 1rem;
  height: 4rem;
  width: 4rem;
}

.icon_add {
  position: absolute;
  right: 0;
  left: 0;
  top: 17%;
}
.text_add {
  position: absolute;
  right: 0;
  left: 0;
  bottom: 20%;
}
</style>
