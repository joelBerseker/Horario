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
    <transition name="t-extra-buttoms">
      <div v-if="!isBusy" class="nav_buttoms">
        <b-row>
          <b-col cols="auto" class="pr-2">
            <b-button
              variant="dark"
              class="c1 bg4 px-2 icon_menu_simulation"
              size="lg"
            >
              <b-icon icon="list"></b-icon>
            </b-button>
          </b-col>

          <b-col class="pl-0">
            <b-button
              class="buttom_float"
              variant="primary"
              size="lg"
              block
              @click="addTypeOfProduct(item_new)"
            >
              <small>
                <b-icon icon="plus" scale="1.2"></b-icon>&nbsp;Agregar
              </small>
            </b-button>
          </b-col>
        </b-row>
      </div>
    </transition>
    <TablePersonalized
      :isBusy="isBusy"
      :items="items"
      :fields="fields"
      :detailItem="detailTypeOfProduct"
    />
  </div>
</template>

<script>
import axios from "axios";
import DetailTypeOfProduct from "@/components/InternSystem/Setting/TypeOfProduct/DetailTypeOfProduct";
import TablePersonalized from "@/components/InternSystem/ReusableComponents/TablePersonalized";
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
const url = process.env.VUE_APP_RUTA_API;

export default {
  mixins: [UtilityFunctions],
  components: {
    DetailTypeOfProduct,
    TablePersonalized,
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
    detailTypeOfProduct(item) {
      this.itemSelected = Object.assign({}, item);
      this.mode = 1;
      this.$bvModal.show("detail-" + this.modalName + "-modal");
    },
    addTypeOfProduct(item) {
      this.itemSelected = Object.assign({}, item);
      this.mode = 0;
      this.$bvModal.show("detail-" + this.modalName + "-modal");
    },
    getTypeOfProductList() {
      this.isBusy = true;
      var path = url + this.pathName;
      console.log(path);
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
      }, 500);
    },
  },
  async created() {
    //await Service.access(1,typeofDush)
    await this.getTypeOfProductList();
  },
};
</script>

<style scoped>
/*.buttom_float {
  border-radius: 100px !important;
  position: fixed;
  bottom: 0;
  right: 0;
  margin: 0.3rem;
  z-index: 100;
  padding: 1rem;
  height: 3.5rem;
  width: 3.5rem;
}*/
</style>
