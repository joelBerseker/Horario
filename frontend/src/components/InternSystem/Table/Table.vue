<template>
  <div class="main-body">
    <DetailTable
      :item="itemSelected"
      :changeMode="changeMode"
      :mode="mode"
      :pathName="pathName"
      :modalName="modalName"
      :getTableList="getTableList"
    />

    <div class="mb-2">
      <b-dropdown id="dropdown-left" variant="dark" size="sm">
        <template #button-content>
          <b-icon icon="list-nested" scale="1"></b-icon> &nbsp;Ordenar por:
          {{ show_sort.sortBy }}
          <b-icon
            :icon="'arrow-' + show_sort.sortDirection"
            scale="0.8"
          ></b-icon>
        </template>
        <b-dropdown-item @click="sort('id')">Nombre</b-dropdown-item>
        <b-dropdown-item @click="sort('reserved')">Estado</b-dropdown-item>
      </b-dropdown>
    </div>
    <div>
      <b-card v-for="item in list" :key="item.id" class="mb-2 c1 table-card">
        <b-card-text>
          <b-row>
            <b-col
              ><h5 class="mt-1">Mesa n° {{ item.id }}</h5>
            </b-col>
            <b-col cols="auto">
              <div
                :class="'state-table ' + state_validation[item.reserved].class"
              >
                <h6 class="m-0 p-0">
                  {{ state_validation[item.reserved].text }}
                  <span v-if="item.reserved == 2">para: {{ item.date }}</span>
                </h6>
              </div>
            </b-col>
          </b-row>
        </b-card-text>
        <b-row>
          <b-col cols="auto" class="pr-0">
            <b-button
              variant="outline-light"
              class="px-2"
              @click="detailTable(item, 3)"
            >
              <b-icon icon="pencil-square" scale="1"></b-icon>
              &nbsp;Editar
            </b-button>
          </b-col>
          <b-col>
            <b-button block variant="primary" :to="{ name: 'TableOrder' }">
              <b-icon icon="list-task" scale="1"></b-icon> &nbsp;Ver pedidos
            </b-button>
          </b-col>
        </b-row>
      </b-card>
    </div>
  </div>
</template>

<script>
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
import DetailTable from "@/components/InternSystem/Setting/Table/DetailTable";
export default {
  mixins: [UtilityFunctions],
  components: { DetailTable },
  data() {
    return {
      show_sort: {
        sortBy: "Nombre",
        sortDirection: "up",
      },
      sortBy: "id",
      sortDirection: "desc",
      modalName: "Table",
      pathName: "tabl",
      mode: 0, //0: agregar , 1: ver, 2: update
      itemSelected: {},
      list: [
        { id: 40, reserved: 1, date: "23:20" },
        { id: 21, reserved: 2, date: "15:20" },
        { id: 89, reserved: 3, date: "13:40" },
        { id: 38, reserved: 1, date: "11:30" },
        { id: 37, reserved: 2, date: "11:30" },
      ],
    };
  },
  computed: {},
  methods: {
    sort(s) {
      switch (s) {
        case "id":
          this.show_sort.sortBy = "Nombre";
          break;
        case "reserved":
          this.show_sort.sortBy = "Estado";
          break;
        default:
          break;
      }
      if (s === this.sortBy) {
        this.sortDirection = this.sortDirection === "asc" ? "desc" : "asc";
        this.show_sort.sortDirection =
          this.sortDirection === "asc" ? "up" : "down";
      }
      this.sortBy = s;
      this.list.sort((p1, p2) => {
        let modifier = 1;
        if (this.sortDirection === "desc") modifier = -1;
        if (p1[this.sortBy] < p2[this.sortBy]) return -1 * modifier;
        if (p1[this.sortBy] > p2[this.sortBy]) return 1 * modifier;
        return 0;
      });
    },
    detailTable(item, mode) {
      this.itemSelected = Object.assign({}, item);
      this.mode = mode;
      this.$bvModal.show("detail-" + this.modalName + "-modal");
    },
    getTableList() {},
    changeMode(mode) {
      this.mode = mode;
    },
  },
  created() {
    this.sort("id");
  },
};
</script>

<style>
.state-table {
  padding: 0.4rem 1rem 0.4rem 1rem;
  border-radius: 50px;
}
.table-card {
  background-color: var(--color-2) !important;
  border-radius: 0px !important;
  border: none !important;
}
.occupied {
  background-color: #dc3546a2;
}
.reserved {
  background-color: #d89c10dc;
}
.free {
  background-color: var(--color-4);
}
</style>
