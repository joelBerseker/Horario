<template>
  <div>
    <b-card class="c1 table-card">
      <b-card-text>
        <b-row>
          <b-col
            ><h5 class="mt-1">MESA {{ item.id }}</h5></b-col
          >
          <b-col cols="auto">
            <div
              :class="'state-table ' + state_validation[item.reserved].class"
            >
              <h6 class="m-0 p-0">
                {{ state_validation[item.reserved].text }}
                <span v-if="item.reserved == 2">para: {{ item.date }}</span>
              </h6>
            </div></b-col
          ></b-row
        >
      </b-card-text>
    </b-card>
    <b-card class="c1 table-card">
      <b-card-text>
        <b-row>
          <b-col> <h5 class="mt-1">Pedidos</h5> </b-col>
        </b-row>
      </b-card-text>
    </b-card>
  </div>
</template>

<script>
import UtilityFunctions from "@/mixin/UtilityFunctions.js";
export default {
  mixins: [UtilityFunctions],
  components: {},
  data() {
    return {
      sortBy: "id",
      sortDirection: "asc",
      item: { id: 40, reserved: 1, date: "23:20" },
    };
  },
};
</script>

<style scoped>
</style>
