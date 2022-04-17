<template>
  <b-form-group class="mb-2" :label="name" label-size="sm" label-class="mb-0">
    <b-form-file
      @change="obtainImage"
      accept="image/*"
      :disabled="disabled"
      v-model="computedItem"
      :required="required"
      :state="validation.status"
      placeholder="Escoge una imagen..."
      drop-placeholder="Suelta una imagen aqui..."
    ></b-form-file>
    <small v-if="validation.status == false" class="text-danger">
      <b-icon icon="exclamation-circle" variant="danger"></b-icon>&nbsp;
      {{ validation.value }}
    </small>
  </b-form-group>
</template>
<script>
export default {
  props: ["name", "validation", "disabled", "item", "required", "obtainImage"],
  model: {
    prop: "item",
    event: "itemchange",
  },
  computed: {
    computedItem: {
      get: function () {
        return this.item;
      },
      set: function (value) {
        this.$emit("itemchange", value);
      },
    },
  },
};
</script>