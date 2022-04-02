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
            v-on:click="changeActive(item.value)"
            :to="{ name: item.to }"
            :class="'item-navbar cf ' + item.active"
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
          active: "",
        },
        {
          value: 2,
          name: "Promociones",
          to: "Promotion",
          active: "",
        },
        {
          value: 3,
          name: "Carta",
          to: "FoodMenu",
          active: "",
        },

        {
          value: 4,
          name: "Nosotros",
          to: "About",
          active: "",
        },
        {
          value: 5,
          name: "Contactanos",
          to: "Contact",
          active: "",
        },
      ],
    };
  },
  methods: {
    changeActive(value) {
      for(let item of this.nav_items){
        item.active="";
        if (value == item.value) {
          item.active = "active-item-home";
        }
      }
      
    },
  },
  created() {
    this.nav_items.forEach((element) => {
      console.log(element.to +" "+this.$route.name );
      if (element.to == this.$route.name) {
        this.changeActive(element.value);
      }
    });
 
  },
};
</script>

<style scoped>
.active-item-home {
  border-bottom: 3px solid var(--first-color) !important;
}
.item-navbar {
  transition: all ease-in-out 0.2s;
  border-bottom: 3px solid ;
  border-top: 3px solid ;
  border-color: var(--second-color);
  margin-left: 0.1rem;
  margin-right: 0.1rem;
}
.item-navbar:hover {
  border-bottom: 3px solid var(--first-color);
}

</style>
