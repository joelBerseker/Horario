<template>
  <div>
    <b-form-select v-model="selected" :options="rol"></b-form-select>
    <b-table responsive striped hover :items="items">
      <template #cell(create)="data">
        <b-form-checkbox v-model="data.value" name="check-button" switch>
        </b-form-checkbox>
      </template>
      <template #cell(read)="data">
        <b-form-checkbox v-model="data.value" name="check-button" switch>
        </b-form-checkbox>
      </template>
      <template #cell(update)="data">
        <b-form-checkbox v-model="data.value" name="check-button" switch>
        </b-form-checkbox>
      </template>
      <template #cell(delete)="data">
        <b-form-checkbox v-model="data.value" name="check-button" switch>
        </b-form-checkbox>
      </template>
    </b-table>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      selected: null,
      rol: [
        {value: null, text: "Seleccione una opción" },
        {value: 1, text: "Administrador" },
        {value: 2, text: "Cocinero" },
        {value: 3, text: "Mesero" },
      ],
      items: [
        { nombre: "mesas", create: true, read: 1, update: 1, delete: 1 },
        { nombre: "pedidos", create: 1, read: 1, update: 1, delete: 1 },
        { nombre: "mis pedidos", create: 1, read: 1, update: 1, delete: 1 },
        { nombre: "configuracion", create: true, read: 1, update: 1, delete: 1 },
      ],
      nav_items: [
        {
          value: 1,
          icon: "person-fill",
          scale: 1,
          name: "Mesas",
          to: "userProfile",
          active: "",
        },
        {
          value: 2,
          icon: "journal-medical",
          scale: 1,
          name: "Roles",
          to: "SearchHealthyFood",
          active: "",
        },
        {
          value: 3,
          icon: "people-fill",
          scale: 1,
          name: "Usuarios",
          to: "SearchHealthyFood",
          active: "",
        },
        {
          value: 4,
          icon: "power",
          scale: 1,
          name: "Platos",
          to: "SearchHealthyFood",
          active: "",
        },
        {
          value: 4,
          icon: "journal",
          scale: 0.93,
          name: "Tipos de platos",
          to: "SearchHealthyFood",
          active: "",
        },
        {
          value: 5,
          icon: "journal",
          scale: 1,
          name: "Accesos",
          to: "SearchHealthyFood",
          active: "",
        },
      ],
    };
  },
};
</script>

<style scoped>
</style>
