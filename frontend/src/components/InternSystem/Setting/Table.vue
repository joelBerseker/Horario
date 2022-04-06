<template>
  <div>
    <b-table striped hover :items="items"></b-table>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      items: [
        { Nombre: "Mesa 1", Descripción: "La mesa del fondo"},
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
