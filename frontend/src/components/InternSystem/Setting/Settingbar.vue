<template>
  <div>
    <div class="bg2">
      <div class="c1 main-title" body-class="">
        <b-row>
          <b-col class="text-aling-v-center">
            <h5 class="m-0 p-0">
              <b-icon icon="gear-fill"></b-icon>
              &nbsp;Configuración
            </h5></b-col
          >
        </b-row>
      </div>
      <div class="mb-2 setting-bar">
        <b-nav tabs fill class="setting-tabs">
          <b-nav-item
            class="nav-setting"
            v-for="item in navItems"
            :key="item.value"
            :to="{ name: item.to }"
            exact
            exact-active-class="active active-item"
            v-on:click="changeTitle()"
          >
            <span>
              <b-icon :icon="item.icon" :scale="item.scale"></b-icon>
              <div class="text-nav">{{ item.name }}</div>
            </span>
          </b-nav-item>
        </b-nav>
      </div>
    </div>

    <div class="setting-body">
      <transition name="t-setting-bar-title" mode="out-in">
        <div class="c1 py-2 title-selected mb-2" v-if="showTitle">
          <span v-show="showTitleText">
            <b-icon
              :icon="navItemSelected.icon"
              :scale="navItemSelected.scale"
            ></b-icon>
            &nbsp;{{ navItemSelected.name }} </span
          >&nbsp;
        </div>
      </transition>
      <transition name="t-setting-bar-body" mode="out-in">
        <router-view />
      </transition>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      showTitle: true,
      showTitleText: true,
      itemSelected: {},
      navItems: [
        {
          value: 1,
          icon: "table",
          scale: 0.94,
          name: "Mesas",
          to: "ListSettingTable",
          active_: false,
        },
        {
          value: 2,
          icon: "journal-medical",
          scale: 1,
          name: "Roles",
          to: "ListRol",
          active: false,
        },
        {
          value: 3,
          icon: "people-fill",
          scale: 1,
          name: "Usuarios",
          to: "ListSettingUser",
          active: false,
        },
        {
          value: 4,
          icon: "box-seam",
          scale: 1,
          name: "Productos",
          to: "ListProduct",
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
          scale: 1,
          name: "Accesos",
          to: "Access",
          active: false,
        },
      ],
    };
  },
  computed: {
    navItemSelected: {
      get: function () {
        var itemSelected = {};
        if (this.showTitle == false) {
          return {};
        }
        this.navItems.forEach((element) => {
          if (element.to === this.$route.name) {
            element.active = true;
            itemSelected = element;
          } else {
            element.active = false;
          }
        });

        return itemSelected;
      },
      set: function (value) {
        this.showTitle = value;
      },
    },
  },
  methods: {
    changeTitle() {
      this.showTitleText = false;
      setTimeout(() => {
        this.navItemSelected = false;
      }, 0);

      setTimeout(() => {
        this.showTitleText = true;
        this.showTitle = true;
      }, 200);
    },
  },
  async created() {},
};
</script>

<style>
.title-selected {
  padding-left: 0.75rem;
  padding-right: 0.75rem;
  border-radius: 0.3rem;
  background-color: var(--color-7);
}
.text-nav {
  position: absolute;
  left: 0;
  right: 0;
  text-align: center;
  margin-left: 0.3rem;
  margin-right: 0.3rem;
  font-size: 0.84rem;
  max-width: 100%;
  bottom: 0.1rem;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}
.nav-setting a {
  position: relative;
  /*color: #707070;*/
  color: var(--color-1);
  min-height: 3.2rem;
  padding-top: 0.3rem;
}
.active a {
  background-color: var(--second-color) !important;
  color: var(--first-color) !important;
}
.active {
  border-color: var(--color-1) !important;
}
.setting-bar {
  /*background-color: #7c7c7c4b;*/
  background-color: var(--color-2);
  position: relative;
}
.setting-bar::before {
  content: "";
  position: absolute;
  top: -1px;
  background-color: var(--color-5);
  min-width: 0.2rem;
  height: 100%;
  margin-bottom: 3px;
}
.setting-body {
  padding: 1.5rem;
}
.setting-tabs {
  padding-left: 1.5rem !important;
  padding-right: 1.5rem;
  border-color: var(--color-1) !important;
}
.setting-tabs .nav-link:hover {
  border-color: transparent !important;
  background-color: rgba(255, 255, 255, 0.212);
  color: var(--color-1);
}
@media only screen and (max-width: 1199px) {
  .setting-body {
    padding: 0.3rem;
  }
  .setting-tabs {
    padding-left: 0.3rem !important;
    padding-right: 0.3rem;
  }
}

/*t-setting-bar-body*/
.t-setting-bar-body-enter-active,
.t-setting-bar-body-leave-active {
  transition: opacity 0.2s ease;
}

.t-setting-bar-body-enter {
  opacity: 0;
}

.t-setting-bar-body-leave-to {
  opacity: 0;
}

/*t-setting-bar-title*/
.t-setting-bar-title-enter-active,
.t-setting-bar-title-leave-active {
  transition: 0.2s;
}

.t-setting-bar-title-enter {
  opacity: 0;
  transform: translateX(-3rem);
}

.t-setting-bar-title-leave-to {
  opacity: 0;
  transform: translateX(3rem);
}
</style>
