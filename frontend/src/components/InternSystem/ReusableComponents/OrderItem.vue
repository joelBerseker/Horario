<template>
  <div>
    <b-card class="table-card c1 mb-2">
      <b-card-text>
        <b-row>
          <b-col>
            <h5 class="mt-1">Pedido {{ item.id }}</h5>
          </b-col>
          <b-col cols="12">
            <b-list-group class="bg2" flush >
              <b-list-group-item class="bg2">Cras justo odio</b-list-group-item>
              <b-list-group-item class="bg2">Dapibus ac facilisis in</b-list-group-item>
              <b-list-group-item class="bg2">Morbi leo risus</b-list-group-item>
              <b-list-group-item class="bg2">Porta ac consectetur ac</b-list-group-item>
              <b-list-group-item class="bg2">Vestibulum at eros</b-list-group-item>
            </b-list-group>
            <b-table
              show-empty
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
              <template #row-details="data">
                <small class="mb-1">{{ data.item.coment }}</small>
              </template>
            </b-table>
          </b-col>
        </b-row>
      </b-card-text>
    </b-card>
  </div>
</template>
<script>
export default {
  props: ["item"],

  data() {
    return {
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
  created() {},
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