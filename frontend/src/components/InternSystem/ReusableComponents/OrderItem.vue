<template>
  <div>
    <b-card class="table-card c1 mb-2" body-class="p-3">
      <b-card-text>
        <b-row>
          <b-col>
            <h5 class="mt-1">
              Pedido {{ item.id }} &nbsp;<b-icon
                v-if="isCompleted"
                icon="check-circle"
                scale="1.2"
              ></b-icon>
            </h5>
          </b-col>
          <b-col cols="auto" v-if="showTable">
            <div class="state-table py-1 bg6">
              <p class="my-0 py-0">mesa 3</p>
            </div>
          </b-col>
        </b-row>
        <hr class="my-1 p-0 bg1">
        <b-collapse :visible="isCompleted">
          <b-row v-if="isCompleted">
            <b-col cols="12">
              
            </b-col>
            <b-col cols="12" class="text-center">
              <small v-if="!collapseButtom" @click="collapseButtom = true"
                >Ver más&nbsp; <b-icon icon="arrow-bar-down"></b-icon
              ></small>
              <small v-else @click="collapseButtom = false"
                >Ver menos&nbsp; <b-icon icon="arrow-bar-up"></b-icon
              ></small>
            </b-col>
          </b-row>
        </b-collapse>
        <b-collapse :visible="!isCompleted || collapseButtom">
          <b-row class="mt-0">
            <b-col cols="12">
              <b-list-group class="" flush>
                <b-list-group-item class="item-order px-0">
                  <b-row>
                    <b-col cols="5" class="pr-1"></b-col>
                    <b-col cols="3" class="text-right px-2">Cantidad</b-col>
                    <b-col cols="4" class="text-center pl-1">Entregado</b-col>
                  </b-row>
                </b-list-group-item>
                <b-list-group-item
                  v-for="item in item.itemList"
                  :key="item.id"
                  :class="' item-order px-0 ' + crossOut(item.delivered)"
                >
                  <b-row>
                    <b-col cols="5" class="pr-1">{{ item.name }}</b-col>
                    <b-col cols="3" class="text-right px-2">{{
                      item.number
                    }}</b-col>
                    <b-col cols="4" class="text-center pl-1">
                      <b-form-checkbox
                        v-model="item.delivered"
                        :value="1"
                        :unchecked-value="0"
                        size="lg"
                      >
                      </b-form-checkbox>
                    </b-col>
                    <b-col cols="12" v-if="item.coment != ''">
                      <small>{{ item.coment }}</small>
                    </b-col>
                  </b-row>
                </b-list-group-item>
              </b-list-group>
            </b-col>
          </b-row>
        </b-collapse>
      </b-card-text>
    </b-card>
  </div>
</template>
<script>
export default {
  props: ["item", "showTable"],

  data() {
    return {
      collapseButtom: true,
    };
  },
  computed: {
    isCompleted() {
      this.changeColapse();
      return this.countDelivered == this.item.itemList.length;
    },
    showModal() {
      return true;
    },
    countDelivered() {
      var count = 0;
      for (const item of this.item.itemList) {
        if (item.delivered == 1) count++;
      }
      return count;
    },
  },
  methods: {
    changeColapse() {
      this.collapseButtom = false;
    },
    crossOut(delivered) {
      var cross = "";
      if (delivered == 1) {
        cross = "cross-out-text";
      }
      return cross;
    },
  },
  created() {},
};
</script>
<style>
.cross-out-text {
  text-decoration: line-through 2px;
}
.item-order{
  background-color: transparent !important;
  border-color: rgba(255, 255, 255, 0.877) !important;
  padding-bottom: 0.3rem !important;
  padding-top: 0.3rem !important;
}
</style>