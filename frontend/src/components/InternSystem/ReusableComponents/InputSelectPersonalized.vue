<template>
  <b-form-group class="mb-2" :label="name" label-size="sm" label-class="mb-0">
    <b-form-select
      :disabled="mode === 1"
      v-model="computedItem"
      :options="list"
      :value-field="valueField"
      :text-field="textField"
      :required="required"
      :state="validation.status"
    >
      <template #first v-if="editFirst">
        <b-form-select-option :value="0" disabled>
          Seleccione una opción
        </b-form-select-option>
      </template>
    </b-form-select>
    <small v-if="validation.status == false" class="text-danger">
      <b-icon icon="exclamation-circle" variant="danger"></b-icon>&nbsp;
      {{ validation.value }}
    </small>
  </b-form-group>
</template>
<script>
export default {
  props: [
    "name",
    "validation",
    "mode",
    "item",
    "required",
    "list",
    "valueField",
    "textField",
    "editFirst",
  ],
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