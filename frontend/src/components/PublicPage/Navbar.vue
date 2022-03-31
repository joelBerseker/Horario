<template>
  <div class="leter">
    <b-navbar toggleable="lg" type="dark" class="nav-class fixed-top general-padding">
      <b-navbar-brand href="#" class="hurricane-font"
        >CampestreRes</b-navbar-brand
      >
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
      <b-collapse id="nav-collapse" is-nav class="nav-font">
        <b-navbar-nav class="mx-auto">
          <b-nav-item
            v-for="item in nav_items"
            :key="item.value"
            :to="{ name: item.to }"
            :class="'item-navbar' + item.active"
            >{{ item.name }}
          </b-nav-item>
        </b-navbar-nav>
        <b-navbar-nav >
          <b-nav-item><b-icon icon="facebook"></b-icon> </b-nav-item>
          <b-nav-item><b-icon icon="instagram"></b-icon> </b-nav-item>
          <b-nav-item><b-icon icon="twitter"></b-icon> </b-nav-item>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
    <div class="main">
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
          active: "active-item-home",
        },
        {
          value: 2,
          name: "Nosotros",
          to: "About",
          active: "",
        },
        {
          value: 3,
          name: "Contactanos",
          to: "Contact",
          active: "",
        },
        {
          value: 4,
          name: "Carta",
          to: "FoodMenu",
          active: "",
        },
        {
          value: 5,
          name: "Promociones",
          to: "Contact",
          active: "",
        },
      ],
    };
  },
};
</script>

<style scoped>
.pru {
  background-color: var(--second-color) !important;
}
</style>
