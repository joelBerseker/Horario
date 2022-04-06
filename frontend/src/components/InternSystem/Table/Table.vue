<template>
  <div>
    Table
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      items: [
        { age: 40, first_name: "Dickerson", last_name: "Macdonald" },
        { age: 21, first_name: "Larsen", last_name: "Shaw" },
        { age: 89, first_name: "Geneva", last_name: "Wilson" },
        { age: 38, first_name: "Jami", last_name: "Carney" },
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
          icon: "bezier2",
          scale: 1.1,
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
