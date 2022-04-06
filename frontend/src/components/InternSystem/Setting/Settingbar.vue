<template>
  <div>
    <div class="mb-2">
      <b-nav tabs fill>
        <b-nav-item
          class="nav-setting"
          active
          v-for="item in nav_items"
          :key="item.value"
          :to="{ name: item.to }"
          exact
          exact-active-class="active-item"
        >
          <b-icon :icon="item.icon" class="im" :scale="item.scale"></b-icon>
          <span>&nbsp;{{ item.name }}</span>
        </b-nav-item>
      </b-nav>
    </div>

    <div>
      <router-view />
    </div>
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
          icon: "table",
          scale: 0.95,
          name: "Mesas",
          to: "SettingTable",
          active: "",
          active_: true,
        },
        {
          value: 2,
          icon: "journal-medical",
          scale: 1,
          name: "Roles",
          to: "Rol",
          active: "",
          active_: false,
        },
        {
          value: 3,
          icon: "people-fill",
          scale: 1,
          name: "Usuarios",
          to: "SettingUser",
          active: "",
          active_: false,
        },
        {
          value: 4,
          icon: "box-seam",
          scale: 1,
          name: "Platos",
          to: "Dish",
          active: "",
          active_: false,
        },
        {
          value: 5,
          icon: "journal",
          scale: 1,
          name: "Tipos de platos",
          to: "TypeOfDish",
          active: "",
          active_: false,
        },
        {
          value: 6,
          icon: "bezier2",
          scale: 1.1,
          name: "Accesos",
          to: "Access",
          active: "",
          active_: false,
        },
      ],
    };
  },
  async created() {
    this.$router.push({ name: 'SettingTable'})
  },
};
</script>

<style scoped>
.nav-setting a{
  border-radius: 0px !important;
  border: none;
}
.active-item {
  background-color: var(--second-color) !important;
  color: var(--first-color) !important;
}
</style>
