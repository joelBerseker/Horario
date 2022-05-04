<template>
  <div>
    <b-card class="table-card c1" body-class="p-3">
      <b-card-text>
        <b-row>
          <b-col>
            <h5 class="m-0 p-0">
              Pedido {{ item.id }}
              <span v-if="showTable">| Mesa 3 </span>
              <span v-if="isCompleted">
                &nbsp;<b-icon icon="check-circle-fill" class="c23 bg1 rounded-circle" scale="1.2"> </b-icon>
                <span v-if="!collapseButtom" @click="collapseButtom = true">
                  &nbsp;<b-icon icon="chevron-down" scale="0.9"></b-icon>
                </span>
                <span v-else @click="collapseButtom = false">
                  &nbsp;<b-icon icon="chevron-up" scale="0.9"></b-icon>
                </span>
              </span>
            </h5>
          </b-col>

          <b-col cols="auto">
            <b-button variant="link c1 py-0 px-1" @click="deleteOrder(item)">
              <b-icon icon="x" scale="1"> </b-icon>
            </b-button>
          </b-col>
        </b-row>
        <b-collapse :visible="!isCompleted || collapseButtom">
          <div class="mt-0">
            <b-list-group class="" flush>
              <b-list-group-item class="item-order px-0">
                <b-row>
                  <b-col cols="1" class="text-center"></b-col>
                  <b-col cols="5" class="pr-1"></b-col>
                  <b-col cols="4" class="text-right">Cantidad</b-col>
                  <b-col cols="auto" class="text-right"></b-col>
                </b-row>
              </b-list-group-item>
              <b-list-group-item
                v-for="item in item.itemList"
                :key="item.id"
                :class="' item-order px-0 ' + crossOut(item.delivered)"
              >
                <b-row>
                  <b-col cols="1">
                    <b-form-checkbox
                      v-model="item.delivered"
                      :value="1"
                      :unchecked-value="0"
                    >
                    </b-form-checkbox>
                  </b-col>
                  <b-col cols="5">
                    <div>{{ item.name }}</div>
                    <div v-if="item.coment != ''">
                      <small>{{ item.coment }}</small>
                    </div>
                  </b-col>
                  <b-col cols="4" class="text-right">
                    {{ item.number }}
                  </b-col>
                  <b-col cols="1" class="text-right">
                    <b-button
                      variant="link c1 "
                      size="sm"
                      @click="deleteItemOrder(item)"
                      class="py-0 px-1"
                    >
                      <b-icon icon="x" scale="1"></b-icon>
                    </b-button>
                  </b-col>
                </b-row>
              </b-list-group-item>
            </b-list-group>
          </div>
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
    deleteItemOrder() {},
    deleteOrder() {},
  },
  created() {},
};
</script>
<style>
.cross-out-text {
  text-decoration: line-through 2px;
}
.item-order {
  background-color: transparent !important;
  border-color: rgba(255, 255, 255, 0.877) !important;
  padding-bottom: 0.3rem !important;
  padding-top: 0.3rem !important;
}
</style>