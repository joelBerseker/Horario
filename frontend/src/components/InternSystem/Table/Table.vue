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
            variant="dark"
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
      <div>
        <b-row>
          <b-col v-for="item in list" :key="item.id" cols="12" lg="6" xl="4">
            <b-card
              :class="
                'mb-2 c1 table-card '
              "
              body-class="p-3"
            >
              <b-row>
                <b-col cols="4" class="pr-0" @click="editStatusTable(item)">
                  <div
                    :class="
                      'text-center table-name border ' +
                      state_validation[item.reserved].class
                    "
                  >
                    <h5 class="m-0 p-0">Mesa</h5>
                    <h5 class="m-0 p-0">{{ item.id }}</h5>
                  </div>
                </b-col>
                <b-col>
                  <b-row>
                    <b-col cols="12" class="mb-2">
                      <div
                        @click="editStatusTable(item)"
                        :class="
                          'state-table border ' +
                          state_validation[item.reserved].class
                        "
                      >
                        <h6 class="m-0 p-0">
                          {{ state_validation[item.reserved].text }}
                          <span v-if="item.reserved == 2">
                            : {{ item.hour }}
                          </span>
                        </h6>
                      </div>
                    </b-col>
                    <b-col cols="12">
                      <b-button
                        block
                        variant="outline-light"
                        :to="{
                          name: 'TableOrder',
                          params: { itemSelected: item },
                        }"
                      >
                        <b-icon icon="list-task" scale="1"></b-icon> &nbsp; Ver
                        pedidos
                      </b-button>
                    </b-col>
                  </b-row>
                </b-col>
              </b-row>
            </b-card>
          </b-col>
        </b-row>
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
        { id: 40, reserved: 1, hour: "23:20" },
        { id: 21, reserved: 2, hour: "15:20" },
        { id: 89, reserved: 3, hour: "13:40" },
        { id: 38, reserved: 1, hour: "11:30" },
        { id: 37, reserved: 2, hour: "11:30" },
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
    editStatusTable(item) {
      this.itemSelected = Object.assign({}, item);
      this.mode = 3;
      this.$bvModal.show("detail-" + this.modalName + "-modal");
    },
    getTableList() {
      var path = url + "tabl";
      console.log(path);
      setTimeout(() => {
        axios
          .get(path)
          .then((response) => {
            this.list = response.data.data.tabl;
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

.table-card {
  background-color: var(--color-3) !important;
  border: none !important;
}
.main-title {
  background-color: var(--color-2) !important;
  border-radius: 0px !important;
  border: none !important;
  padding: 0.6rem 1rem 0.6rem 1rem;
  position: relative;
}
.main-title::after {
  content: "";
  position: absolute;

  background-color: var(--color-5);
  min-width: 0.3rem;
  min-height: 100%;
  top: 0;
  left: 0;
}
.occupied {
  background-color: #dc3546e7 !important;
}
.reserved {
  background-color: #ffc107e7 !important;
}
.free {
  background-color: #28a746e7 !important;
}
.title-table {
  padding-left: 1.25rem;
  padding-right: 1.25rem;
}
</style>
