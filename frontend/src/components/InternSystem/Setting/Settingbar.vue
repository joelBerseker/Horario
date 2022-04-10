<template>
  <div>
    <div class="mb-4">
      <b-nav tabs fill>
        
          <b-nav-item
            class="nav-setting"
            active
            v-for="item in getNavItems"
            :key="item.value"
            :to="{ name: item.to }"
            v-on:click="getTitle(item)"
            exact
            exact-active-class="active-item"
          >
          <transition name="fade">
            <span v-if="!item.active">
              <b-icon :icon="item.icon" class="im" :scale="item.scale"></b-icon>
              &nbsp;{{ item.name }}</span
            >
            </transition>
          </b-nav-item>
        
      </b-nav>
    </div>
    <div class="bg2 c1 p-2 mb-1">
      <b-icon
        :icon="item_selected.icon"
        class="im"
        :scale="item_selected.scale"
      ></b-icon>
      &nbsp;{{ item_selected.name }}
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
      item_selected: {},
      nav_items: [
        {
          value: 1,
          icon: "table",
          scale: 0.95,
          name: "Mesas",
          to: "SettingTable",
          active_: false,
        },
        {
          value: 2,
          icon: "journal-medical",
          scale: 1,
          name: "Roles",
          to: "Rol",
          active: false,
        },
        {
          value: 3,
          icon: "people-fill",
          scale: 1,
          name: "Usuarios",
          to: "SettingUser",
          active: false,
        },
        {
          value: 4,
          icon: "box-seam",
          scale: 1,
          name: "Platos",
          to: "Dish",
          active: false,
        },
        {
          value: 5,
          icon: "journal",
          scale: 1,
          name: "Tipo de productos",
          to: "ListTypeOfProduct",
          active: false,
        },
        {
          value: 6,
          icon: "bezier2",
          scale: 1.1,
          name: "Accesos",
          to: "Access",
          active: false,
        },
      ],
    };
  },
  computed: {
    getNavItems() {
      var nav_items_selected = [];
      this.nav_items.forEach((element) => {
        if (element.active === false) nav_items_selected.push(element);
        else this.item_selected = element;
      });
      return nav_items_selected;
    },
  },
  methods: {
    getTitle(currentTitle) {
      this.nav_items.forEach((element) => {
        element.active = false;
      });
      currentTitle.active = true;
    },
    getPath() {
      this.nav_items.forEach((element) => {
        if (element.to === this.$route.name) {
          element.active = true;
        } else {
          element.active = false;
        }
      });
    },
  },
  async created() {
    this.getPath();
  },
};
</script>

<style scoped>
.nav-setting a {
  border-radius: 0px !important;
  border: none;
}
.active-item {
  transition: 0.2s;
  background-color: var(--second-color) !important;
  color: var(--first-color) !important;
}
</style>
