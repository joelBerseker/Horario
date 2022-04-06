<template>
  <div>
    <b-navbar toggleable="lg" class="nav-class fixed-top gp">
      <b-navbar-brand href="#" class="hurricane-font c1"
        >CampestreRes</b-navbar-brand
      >
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav class="nav-font">
        <b-navbar-nav class="mx-auto">
          <b-nav-item
            v-for="item in nav_items"
            :key="item.value"
            exact-active-class="active-item-home"
            :to="{ name: item.to }"
            class="item-navbar cf"
            >{{ item.name }}
          </b-nav-item>
        </b-navbar-nav>
        <b-navbar-nav>
          <b-nav-item><b-icon icon="facebook"></b-icon> </b-nav-item>
          <b-nav-item><b-icon icon="instagram"></b-icon> </b-nav-item>
          <b-nav-item><b-icon icon="twitter"></b-icon> </b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <div class="main-nav">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nav_items: [
        {
          value: 1,
          name: "Inicio",
          to: "Home",
        },
        {
          value: 2,
          name: "Promociones",
          to: "Promotion",
        },
        {
          value: 3,
          name: "Carta",
          to: "FoodMenu",
        },

        {
          value: 4,
          name: "Nosotros",
          to: "About",
        },
        {
          value: 5,
          name: "Contactanos",
          to: "Contact",
        },
      ],
    };
  },
};
</script>

<style scoped>
.active-item-home {
  border-bottom: 3px solid var(--first-color) !important;
}
.item-navbar a{
  transition: all ease-in-out 0.2s;
  border-bottom: 3px solid ;
  border-top: 3px solid ;
  border-color: var(--second-color);
  margin-left: 0.1rem;
  margin-right: 0.1rem;
}
.item-navbar a:hover {
  border-bottom: 3px solid var(--first-color);
}


</style>
