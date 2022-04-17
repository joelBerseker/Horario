<template>
  <div>
    <b-form-select
      v-model="selected"
      :options="rol"
      class="mb-2"
    ></b-form-select>

    <b-table
      responsive
      striped
      hover
      :items="items"
      :fields="fields"
      class="mb-2"
    >
      <template #cell(create)="data">
        <b-form-checkbox v-model="data.value" :disabled="!edit" switch>
        </b-form-checkbox>
      </template>
      <template #cell(read)="data">
        <b-form-checkbox v-model="data.value" :disabled="!edit" switch>
        </b-form-checkbox>
      </template>
      <template #cell(update)="data">
        <b-form-checkbox v-model="data.value" :disabled="!edit" switch>
        </b-form-checkbox>
      </template>
      <template #cell(delete)="data">
        <b-form-checkbox v-model="data.value" :disabled="!edit" switch>
        </b-form-checkbox>
      </template>
    </b-table>
    <div>
      <b-button
        v-if="!edit"
        variant="warning"
        @click="editTable()"
        class="float-right mr-1"
      >
        <b-icon icon="pencil-square" scale="1"></b-icon>
        &nbsp;Editar
      </b-button>
      <b-button
        v-if="edit"
        variant="primary"
        @click="saveTable()"
        class="float-right mr-1"
      >
        <b-icon icon="check2" scale="1.1"></b-icon>
        &nbsp;Aceptar
      </b-button>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      edit: false,
      selected: null,
      rol: [
        { value: null, text: "Seleccione un rol" },
        { value: 1, text: "Administrador" },
        { value: 2, text: "Cocinero" },
        { value: 3, text: "Mesero" },
      ],
      fields: [
        {
          key: "name",
          label: "Recursos",
        },
        {
          key: "create",
          label: "Crear",
          formatter: (value) => {
            return value ? true : false;
          },
        },
        {
          key: "read",
          label: "Ver",
          formatter: (value) => {
            return value ? true : false;
          },
        },
        {
          key: "update",
          label: "Editar",
          formatter: (value) => {
            return value ? true : false;
          },
        },
        {
          key: "delete",
          label: "Eliminar",
          formatter: (value) => {
            return value ? true : false;
          },
        },
      ],
      items: [
        { name: "Mesas", create: 0, read: 0, update: 0, delete: 0 },
        { name: "Pedidos", create: 0, read: 0, update: 0, delete: 0 },
        { name: "Mis pedidos", create: 0, read: 0, update: 0, delete: 0 },
        {
          name: "Configuracion",
          create: 0,
          read: 0,
          update: 0,
          delete: 1,
        },
      ],
    };
  },
  methods: {
    editTable() {
      this.edit = true;
    },
    saveTable() {
      this.edit = false;
      console.log("operaciones en back uwu");
    },
  },
};
</script>

<style scoped>
</style>
