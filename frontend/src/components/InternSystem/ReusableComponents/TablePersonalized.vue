<template>
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
          @click="detailItem(data.item, 1)"
        >
          <b-icon icon="eye"></b-icon>&nbsp;Ver
        </b-button>
      </template>
      <template #table-busy>
        <div class="text-center c2 my-2">
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
</template>
<script>
export default {
  props: ["items", "isBusy", "fields", "detailItem"],
  model: {
    prop: "item",
    event: "itemchange",
  },
  computed: {
    rows() {
      return this.items.length;
    },
  },
  data(){
    return{
      perPage: 5,
      currentPage: 1,
    }
  }
};
</script>