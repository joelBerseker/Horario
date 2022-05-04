<template>
  <div>
    <transition name="loading-system">
      <div class="loading-system" v-if="showOverlay">
        <div class="mx-auto center justify-content-center c2 my-2">
          <b-spinner class="align-middle"></b-spinner>&nbsp;
          <span>Espere por favor ...</span>
        </div>
      </div>
    </transition>
    <div>
      <div class="icon_menu_place">
        <b-button
          v-if="!sideBarOpen"
          @click="openNav"
          variant="dark "
          class="px-2 icon_menu"
          size="lg"
        >
          <b-icon icon="list"></b-icon>
        </b-button>
        <b-button
          v-else
          @click="closeNav"
          variant="dark "
          size="lg"
          class="px-2 icon_menu"
        >
          <b-icon icon="x"></b-icon>
        </b-button>
      </div>

      <div id="side-bar" class="py-5">
        <div>
          <Logo size="1.2" class="side-bar-item mb-4" />
          <b-list-group flush>
            <b-list-group-item
              v-for="item in navItems"
              :key="item.value"
              class="c1 side-bar-item"
              active-class="side-bar-active-item"
              :to="{ name: item.to }"
              v-on:click="closeNavAuto()"
            >
              <b-icon :icon="item.icon" class="im" :scale="item.scale"></b-icon>

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
      <transition name="t-main-side" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
import Logo from "@/components/InternSystem/ReusableComponents/Logo";
export default {
  components: { Logo },
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
          name: "Mi Perfil",
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
  border: none !important;
  background-color: transparent !important;
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
  background-color: var(--color-2);
  transition: width 0.2s;
}

.side-bar-active-item {
  background-color: var(--color-1) !important;
  color: var(--color-2) !important;
}
.side-bar-active-item::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0px;
  background-color: var(--color-5);
  min-width: 0.2rem;
  height: 100%;
  margin-bottom: 3px;
}

#main-side {
  transition: margin-left 0.5s;
  margin-left: 200px;
  /*padding: 2rem;*/
  min-height: 100vh;
  background-size: cover;
  overflow: hidden;
  padding-bottom: 2.6rem !important;
}

.t-side-bar-item-enter-active {
  transition: all 0.3s ease;
}

.t-side-bar-item-enter {
  opacity: 0;
}

.loading-system {
  background-color: rgba(207, 207, 207, 0.781);
  position: fixed;
  z-index: 2000;
  width: 100%;
  height: 100%;
  align-items: center;
  display: flex;
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

.t-main-side-enter-active,
.t-smain-side-leave-active {
  transition: 0.3s;
}
.t-main-side-enter {
  transform: translateY(-5vh);
}
.t-main-side-leave-to {
  transform: translateY(3rem);
}

.t-loading-system-enter-active,
.t-loading-system-leave-active {
  transition: 0.3s;
}
.t-loading-system-enter {
  opacity: 1;
}
.t-loading-system-leave-to {
  opacity: 0;
}
</style>