import Vue from "vue";
import VueRouter from "vue-router";

import Navbar from "@/components/PublicPage/Navbar";
import Home from "@/components/PublicPage/Home";
import Contact from "@/components/PublicPage/Contact";
import About from "@/components/PublicPage/About";
import FoodMenu from "@/components/PublicPage/FoodMenu/FoodMenu";
import Promotion from "@/components/PublicPage/Promotion";

import Table from "@/components/InternSystem/Table/Table";
import Logout from "@/components/InternSystem/Autentication/Logout";
import User from "@/components/InternSystem/User/User";
import Order from "@/components/InternSystem/Order/Order";
import MyOrder from "@/components/InternSystem/Order/MyOrder";
import Sidebar from "@/components/InternSystem/Sidebar";

import Access from "@/components/InternSystem/Setting/Access";
import Dish from "@/components/InternSystem/Setting/Dish";
import Rol from "@/components/InternSystem/Setting/Rol";
import Settingbar from "@/components/InternSystem/Setting/Settingbar";
import SettingTable from "@/components/InternSystem/Setting/Table";
import ListTypeOfProduct from "@/components/InternSystem/Setting/TypeOfProduct/ListTypeOfProduct";
import SettingUser from "@/components/InternSystem/Setting/User";

Vue.use(VueRouter);

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
        props: true,
      },
      {
        path: "/contact",
        name: "Contact",
        component: Contact,
        props: true,
      },
      {
        path: "/about",
        name: "About",
        component: About,
        props: true,
      },
      {
        path: "/food_menu",
        name: "FoodMenu",
        component: FoodMenu,
        props: true,
      },
      {
        path: "/promotion",
        name: "Promotion",
        component: Promotion,
        props: true,
      },
    ],
  },
  {
    path: "/system",
    name: "Sidebar",
    redirect: '/system/setting/',
    component: Sidebar,
    children: [
      {
        path: "/system/user",
        name: "User",
        component: User,
        props: true,
      },
      {
        path: "/system/logout",
        name: "Logout",
        component: Logout,
        props: true,
      },
      {
        path: "/system/table",
        name: "Table",
        component: Table,
        props: true,
      },
      {
        path: "/system/order",
        name: "Order",
        component: Order,
        props: true,
      },
      {
        path: "/system/myorder",
        name: "MyOrder",
        component: MyOrder,
        props: true,
      },
      {
        path: "/system/setting/",
        name: "Settingbar",

        component: Settingbar,
        redirect: '/system/setting/table',
        props: true,
        children: [
          {
            path: "/system/setting/table",
            name: "SettingTable",
            component: SettingTable,
            props: true,
          },
          {
            path: "/system/setting/access",
            name: "Access",
            component: Access,
            props: true,
          },
          {
            path: "/system/setting/dish",
            name: "Dish",
            component: Dish,
            props: true,
          },
          {
            path: "/system/setting/rol",
            name: "Rol",
            component: Rol,
            props: true,
          },
          {
            path: "/system/setting/typeofproduct",
            name: "ListTypeOfProduct",
            component: ListTypeOfProduct,
            props: true,
          },
          {
            path: "/system/setting/user",
            name: "SettingUser",
            component: SettingUser,
            props: true,
          },
        ],
      },
    ],
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
