<template>
  <div>
    <div id="nav">
      <b-button
        v-if="!butonNav"
        @click="openNav"
        variant="link "
        class="c2 bg1 px-3 btn-none icon_menu"
        size="lg"
      >
        <b-icon icon="box-arrow-in-right"></b-icon>
      </b-button>
      <div id="mySidenav" class="sidenav">
        <b-row>
          <b-col>
            <div class="float-right">
              <b-button
                @click="closeNav"
                variant="link "
                size="lg"
                class="text-white pr-2 btn-none"
              >
                <b-icon icon="box-arrow-in-left"></b-icon>
              </b-button>
            </div>
          </b-col>
        </b-row>
        <b-list-group flush class="mt-5">
          <b-list-group-item
            v-for="item in nav_items"
            :key="item.value"
            class="bg2 c1 border-0"
            active-class="active-item"
            :to="{ name: item.to }"
          >
            <b-icon :icon="item.icon" class="im" :scale="item.scale"></b-icon>
            <transition name="fade">
              <span v-if="menuItem" class="menuItem">
                &nbsp; {{ item.name }}
              </span>
            </transition>
          </b-list-group-item>
        </b-list-group>
      </div>
    </div>

    <div id="main-side" style="overflow-y: hidden">
      <router-view />
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      item_selected: {
        recipe_name: null,
      },
      widht_side: "200px",
      loading: true,
      loading_side_bar: false,
      user: {
        name: "",
        last_name: "",
      },
      menuItem: true,
      butonNav: true,
      windowWidth: window.innerWidth,
      nav_items: [
        {
          value: 1,
          icon: "person-fill",
          scale: 1,
          name: "Jhon Mamani",
          to: "User",
        },
        {
          value: 2,
          icon: "power",
          scale: 1,
          name: "Cerrar Sesión",
          to: "Logout",
        },
        {
          value: 3,
          icon: "table",
          scale: 1,
          name: "Mesas",
          to: "Table",
        },
        {
          value: 4,
          icon: "receipt",
          scale: 1,
          name: "Pedidos",
          to: "Order",
        },
        {
          value: 5,
          icon: "person-lines-fill",
          scale: 1,
          name: "Mis Pedidos",
          to: "MyOrder",
        },
        {
          value: 6,
          icon: "gear-fill",
          scale: 1,
          name: "Configuracion",
          to: "Settingbar",
        },
      ],
    };
  },

  mounted() {
    window.onresize = () => {
      this.windowWidth = window.innerWidth;
      if (this.windowWidth >= 1200) {
        this.widht_side = "200px";
        //this.openNav();
      } else {
        //this.closeNav();
        this.widht_side = "0px";
      }
    };
    this.windowWidth = window.innerWidth;
    if (this.windowWidth >= 1200) {
      this.widht_side = "200px";
    } else {
      this.widht_side = "0px";
      this.butonNav = false;
      this.menuItem = false;
    }
  },
  methods: {
    show_loading_side_bar(value) {
      this.loading_side_bar = value;
    },
    logout() {
      this.$store.dispatch("logout");
      this.$router.push("/home");
    },
    openNav() {
      document.getElementById("mySidenav").style.width = "200px";
      document.getElementById("main-side").style.marginLeft = this.widht_side;

      this.butonNav = true;
      setTimeout(() => {
        this.menuItem = true;
      }, 250);
    },
    closeNav() {
      document.getElementById("mySidenav").style.width = "0px";
      document.getElementById("main-side").style.marginLeft = "0px";
      this.butonNav = false;
      this.menuItem = false;
    },
  },
  updated() {
    if ("SideBarHome" == this.$route.name) {
      this.$router.push("/username");
    }
  },
  async created() {
    this.$router.push({ name: 'Settingbar'})
  },
};
</script>
<style>
.sidenav {
  overflow: hidden;
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 100;
  top: 0;
  left: 0;
  background-color: var(--second-color) !important;
  transition: 0.2s;
  border-right: 1px solid var(--first-color);
}
.sidenav a:hover,
.sidenav a:focus {
  background-color: var(--first-color) !important;
  color: var(--second-color) !important;
  transition: all 0.6s ease;
}
.active-item {
  background-color: var(--first-color) !important;
  color: var(--second-color) !important;
}
.icon_menu {
  position: fixed; /* Stay in place */
  bottom: 0;
  margin: 0.3rem;
  z-index: 100;
}
#main-side {
  transition: margin-left 0.5s;
  margin-left: 200px;
  padding: 2rem;
  min-height: 100vh;
  background-size: cover;
}
.height-padding {
  min-height: calc(100vh - 4rem);
}
.bottom-card {
  margin-bottom: 0;
}

@media only screen and (max-width: 1199px) {
  #main-side {
    margin-left: 0px;
  }
  #mySidenav {
    width: 0px;
  }
  #perfilImage {
    visibility: hidden;
  }
}
@media only screen and (max-width: 767px) {
  .bottom-card {
    margin-bottom: 2rem;
  }
}
</style>