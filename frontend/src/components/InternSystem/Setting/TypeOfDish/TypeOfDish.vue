<template>
  <div>
    <DetailTypeOfDish
      :item="itemSelected"
      :changeMode="changeMode"
      :mode="mode"
    />
    <DeleteTypeOfDish
      :item="itemSelected"
    />
    <div>
      <b-button variant="primary" @click="detailTypeOfDish({}, 0)">
        Agregar
      </b-button>
    </div>
    <b-table striped hover :items="items" :fields="fields"
      ><template #cell(option)="data">
        <b-button size="sm" @click="detailTypeOfDish(data.item, 1)">
          Ver más
        </b-button>
      </template>
    </b-table>
  </div>
</template>

<script>
import axios from "axios";
const url = process.env.VUE_APP_RUTA_API;

import DetailTypeOfDish from "@/components/InternSystem/Setting/TypeOfDish/DetailTypeOfDish";
import DeleteTypeOfDish from "@/components/InternSystem/Setting/TypeOfDish/DeleteTypeOfDish";
export default {
  components: {
    DetailTypeOfDish,
    DeleteTypeOfDish
  },
  data() {
    return {
      mode: 0, //0: agregar , 1: ver, 2: update
      itemSelected: {},
      items: [
        {
          name: "Segundo",
          description: "Los segundos mas normales de la casa",
          image: "https://estag.fimagenes.com/img/3/1/T/b/p/1Tbp_900.jpg",
        },
        {
          name: "Tercero",
          description: "Los Tercero mas normales de la casa",
          image: "https://estag.fimagenes.com/img/3/1/T/b/p/1Tbp_900.jpg",
        },
      ],
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
          /**formatter: (value) => {
            return this.formalizarSexo(value);
          }, */
        },
        {
          key: "option",
          label: "Opciones",
        },
      ],
    };
  },
  methods: {
    changeMode(mode) {
      this.mode = mode;
    },
    detailTypeOfDish(item, mode) {
      this.itemSelected = item;
      this.mode = mode;
      this.$bvModal.show('detail-typeofdish-modal')

    },
    getTypeProduct(){
      var path =
        url + "api/typeproduct";
      axios.get(path).then((response) => {
          //this.userAliments = response.data.results;
          //this.functionLoading();
          this.items=response.data.data.typeProducts;
        })
        .catch((error) => {
          console.log(error);
          this.functionLoading();
        });

    },
  },
  async created() {
  //await Service.access(1,typeofDush)

    await this.getTypeProduct();
  }


};
</script>

<style scoped>
</style>
