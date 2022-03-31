import Vue from 'vue'
import VueRouter from 'vue-router'
<<<<<<< HEAD

import Navbar from "@/components/PublicPage/Navbar";
import Home from "@/components/PublicPage/Home";
import Contact from "@/components/PublicPage/Contact";
import About from "@/components/PublicPage/About";
import FoodMenu from "@/components/PublicPage/FoodMenu/FoodMenu";
=======
import Home from '../components/HelloWorld'
>>>>>>> 70edd23a814faaafaa4209c079d4da58455e1401

Vue.use(VueRouter)

const routes = [
  {
<<<<<<< HEAD
    path: "/",
    name: "Navbar",
    component: Navbar,
    children: [
      {
        path: "/home",
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
    ]
  },
=======
    path: '/',
    name: 'Home',
    component: Home
  }
>>>>>>> 70edd23a814faaafaa4209c079d4da58455e1401
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
