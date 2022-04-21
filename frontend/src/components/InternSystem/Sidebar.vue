<template>
  <div>
    <b-overlay :show="showOverlay" z-index="2000">
      <template #overlay>
        <div class="text-center c2 my-2">
          <b-spinner class="align-middle"></b-spinner>&nbsp;
          <span>Espere por favor ...</span>
        </div>
      </template>
      <div>
        <b-button
          v-if="!sideBarOpen"
          @click="openNav"
          variant="dark "
          class="c1 bg2 px-2 icon_menu"
          size="lg"
        >
          <b-icon icon="list"></b-icon>
        </b-button>
        <b-button
          v-else
          @click="closeNav"
          variant="link "
          size="lg"
          class="text-white px-2 btn-none icon_menu"
        >
          <b-icon icon="x"></b-icon>
        </b-button>
        <div id="side-bar">
          <div>
            <b-list-group flush class="mt-4">
              <b-list-group-item
                v-for="item in navItems"
                :key="item.value"
                class="bg2 c1 border-0 side-bar-item"
                active-class="active-item"
                :to="{ name: item.to }"
                v-on:click="closeNavAuto()"
              >
                <b-icon
                  :icon="item.icon"
                  class="im"
                  :scale="item.scale"
                ></b-icon>

                <span class=""> &nbsp; {{ item.name }} </span>
              </b-list-group-item>
            </b-list-group>
          </div>
        </div>
      </div>
      <transition name="t-side-bar-item">
        <div
          v-if="sideBarOpen && positionAbsolute"
          class="side-bar-cover"
          @click="closeNav"
        ></div>
      </transition>
      <div id="main-side">
        <router-view />
      </div>
    </b-overlay>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      marginWidth: "200px",
      user: {
        name: "",
        last_name: "",
      },
      sideBarOpen: true,
      positionAbsolute: false,
      windowWidth: window.innerWidth,
      navItems: [
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
  computed: {
    showOverlay() {
      return this.$store.getters.getLoading;
    },
  },
  mounted() {
    window.onresize = () => {
      this.windowWidth = window.innerWidth;
      if (this.windowWidth >= 1200) {
        this.marginWidth = "200px";
        this.positionAbsolute = false;
        this.openNav();
      } else {
        document.getElementById("main-side").style.marginLeft = "0px";
        this.marginWidth = "0px";
        this.positionAbsolute = true;
      }
    };
    this.windowWidth = window.innerWidth;
    if (this.windowWidth >= 1200) {
      this.marginWidth = "200px";
      this.positionAbsolute = false;
    } else {
      this.marginWidth = "0px";
      this.positionAbsolute = true;
      this.sideBarOpen = false;
    }
  },
  methods: {
    closeNavAuto() {
      if (this.positionAbsolute) {
        this.closeNav();
      }
    },
    openNav() {
      document.getElementById("side-bar").style.width = "200px";
      document.getElementById("main-side").style.marginLeft = this.marginWidth;
      this.sideBarOpen = true;
    },
    closeNav() {
      document.getElementById("side-bar").style.width = "0px";
      document.getElementById("main-side").style.marginLeft = "0px";
      this.sideBarOpen = false;
    },
  },
};
</script>
<style >
.side-bar-item {
  text-overflow: ellipsis;
  white-space: nowrap;
}
.side-bar-cover {
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.356) !important;
  position: fixed;
  z-index: 99;
}
#side-bar {
  overflow: hidden;
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 100;
  top: 0;
  left: 0;
  background-color: var(--color-2) !important;
  transition: width 0.2s;
}

.active-item {
  background-color: var(--color-1) !important;
  color: var(--color-2) !important;
}

#main-side {
  transition: margin-left 0.5s;
  margin-left: 200px;
  /*padding: 2rem;*/
  min-height: 100vh;
  background-size: cover;
  overflow-y: hidden;
  padding-bottom: 2.6rem !important;
}

.t-side-bar-item-enter-active {
  transition: all 0.2s ease;
}

.t-side-bar-item-enter {
  opacity: 0;
}
@media only screen and (max-width: 1199px) {
  #main-side {
    margin-left: 0px;
    /*padding: 0.3rem !important;*/
  }
  #side-bar {
    width: 0px;
  }
}
</style>