import Vue from 'vue'
import VueRouter from 'vue-router'

import Navbar from "@/components/PublicPage/Navbar";
import Home from "@/components/PublicPage/Home";
import Contact from "@/components/PublicPage/Contact";
import About from "@/components/PublicPage/About";
import FoodMenu from "@/components/PublicPage/FoodMenu/FoodMenu";
import Promotion from "@/components/PublicPage/Promotion";

Vue.use(VueRouter)

const routes = [
  {
    path: "/",
    name: "Navbar",
    component: Navbar,
    children: [
      {
        path: "/",
        name: "Home",
        component: Home,
        props: true
      },
      {
        path: "/contact",
        name: "Contact",
        component: Contact,
        props: true
      },
      {
        path: "/about",
        name: "About",
        component: About,
        props: true
      },
      {
        path: "/food_menu",
        name: "FoodMenu",
        component: FoodMenu,
        props: true
      },
      {
        path: "/promotion",
        name: "Promotion",
        component: Promotion,
        props: true
      },
    ]
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
