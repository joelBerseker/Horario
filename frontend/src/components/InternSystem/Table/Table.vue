<template>
  <div>
    <DetailTable
      :item="itemSelected"
      :changeMode="changeMode"
      :mode="mode"
      :pathName="pathName"
      :modalName="modalName"
      :getTableList="getTableList"
    />

    <div class="c1 main-title" body-class="">
      <b-row>
        <b-col class="text-aling-v-center">
          <h5 class="m-0 p-0">
            <b-icon icon="table" scale="0.9"></b-icon>
            &nbsp;Mesas
          </h5></b-col
        >
        <b-col>
          <b-dropdown
            id="dropdown-left"
            right
            variant="dark bg-transparent"
            size="sm"
            class="float-right"
          >
            <template #button-content>
              <b-icon icon="list-nested" scale="1"></b-icon> &nbsp;Orden:
              {{ show_sort.sortBy }}
              <b-icon
                :icon="'arrow-' + show_sort.sortDirection"
                scale="0.8"
              ></b-icon>
            </template>
            <b-dropdown-item @click="sort('id')">Nombre</b-dropdown-item>
            <b-dropdown-item @click="sort('reserved')">Estado</b-dropdown-item>
          </b-dropdown>
        </b-col>
      </b-row>
    </div>
    <div class="main-body">
      <div class="text-center c2 my-2" v-if="isBusy">
        <b-spinner class="align-middle"></b-spinner>&nbsp;
        <span>Cargando ...</span>
      </div>
      <div class="text-center my-2" v-else-if="list.length <= 0">
        <span>No hay registros para mostrar</span>
      </div>
      <div class="container-grid" v-else>
        <div v-for="item in list" :key="item.id" class="item-grid">
          <b-card
            v-on:click="
              $router.push({
                name: 'TableOrder',
                params: { itemSelected: item },
              })
            "
            :class="
              'c1 table-card cursor-pointer ' +
              state_validation[item.reserved].class
            "
            body-class="p-3"
          >
            <div class="text-center state-table-abs">
              <small class="m-0 p-0">
                {{ state_validation[item.reserved].text }}
                <span v-if="item.reserved == 2"> : 99:99 </span>
              </small>
            </div>
            <div class="text-center mt-1">
              <h3 class="m-0 p-0">Mesa</h3>
              <h3 class="m-0 p-0">{{ item.id }}</h3>
            </div>
          </b-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
import DetailTable from "@/components/InternSystem/Setting/Table/DetailTable";
const url = process.env.VUE_APP_RUTA_API;
import axios from "axios";
export default {
  mixins: [UtilityFunctions],
  components: { DetailTable },
  data() {
    return {
      isBusy: true,
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
      list: [],
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
    editStatusTable(item) {
      this.itemSelected = Object.assign({}, item);
      this.mode = 3;
      this.$bvModal.show("detail-" + this.modalName + "-modal");
    },
    getTableList() {
      this.isBusy = true;
      var path = url + "tabl";
      console.log(path);
      setTimeout(() => {
        axios
          .get(path)
          .then((response) => {
            this.isBusy = false;
            this.list = response.data.data.tabl;
            console.log(this.list.length);
          })
          .catch((error) => {
            this.makeToast(error, "danger");
          });
      }, 500);
    },
    changeMode(mode) {
      this.mode = mode;
    },
  },
  created() {
    this.getTableList();
    this.sort("id");
  },
};
</script>

<style>
.cursor-pointer {
  cursor: pointer !important;
}
.bg-transparent {
  background-color: transparent;
  border-color: transparent !important;
}
.text-aling-v-center {
  display: flex;
  align-items: center;
  height: 2.15rem;
}
.table-name {
  height: 100%;
  background-color: var(--color-6);
  padding: 0.6rem;
  border-radius: 5px;
  padding-top: 0.8rem;
}
.state-table {
  padding: 0.4rem 1rem 0.4rem 1rem;
  border-radius: 50px;
  display: inline-block;
}
.state-table-abs {
  position: absolute;
  right: 0;
  top: 0;
  padding-right: 0.8rem;
}

.bg-table {
  background-color: rgba(0, 0, 0, 0.116) !important;
}

.table-card {
  background-color: var(--color-3) !important;
  border: none !important;
}
.main-title {
  background-color: var(--color-2);
  border-radius: 0px !important;
  border: none !important;
  padding: 0.6rem 1rem 0.6rem 1rem;
  position: relative;
}
.main-title::after {
  content: "";
  position: absolute;

  background-color: var(--color-5);
  min-width: 0.2rem;
  min-height: 100%;
  top: 0;
  left: 0;
}
.occupied {
  background-color: #e6494a !important;
}
.reserved {
  background-color: #f5bc4b !important;
}
.free {
  background-color: #86c149 !important;
}
.title-table {
  padding-left: 1.25rem;
  padding-right: 1.25rem;
}
</style>
