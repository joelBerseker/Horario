<template>
  <div class="pt-5">
    <b-row>
      <b-col cols="3">
        <div class="food-title mt-4 general-padding">
          <h5 class="m-0 p-0">Categorias</h5>
        </div>
        <div>
          <b-list-group>
            <b-list-group-item>Sopas</b-list-group-item>
            <b-list-group-item>Platos tipicos</b-list-group-item>
            <b-list-group-item>Bebidas</b-list-group-item>
            <b-list-group-item>Carnes</b-list-group-item>
            <b-list-group-item>Postres</b-list-group-item>
          </b-list-group>
        </div>
      </b-col>
      <b-col cols="9">
        <div class="food-title mt-4 general-padding">
          <h5 class="m-0 p-0">Platos tipicos</h5>
        </div>
        <div class="general-padding">
          <b-row class="mt-4">
            <b-col cols="4" v-for="item in nav_items" :key="item.value">
              <div>
                <div class="">
                  <div class="food-price">
                    {{ item.price }}
                  </div>
                  <div class="food-name">
                    {{ item.name }}
                  </div>
                  <img
                    class="d-block img-fluid food-image"
                    :src="item.img"
                    alt="image slot"
                  />
                </div>
              </div>
            </b-col>
          </b-row>
        </div>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nav_items: [
        {
          value: 1,
          name: "Sarsa de cuy",
          price: "S/.25",
          img: "https://chefs4estaciones.com/wp-content/uploads/2021/05/polenta-1-con-sugo.jpg",
        },
        {
          value: 2,
          name: "Arros solitario",
          price: "S/.25",
          img: "https://envato-shoebox-0.imgix.net/209b/eecf-541d-4658-925e-3a521e85a0ab/escena-madera-532.jpg?auto=compress%2Cformat&fit=max&mark=https%3A%2F%2Felements-assets.envato.com%2Fstatic%2Fwatermark2.png&markalign=center%2Cmiddle&markalpha=18&w=700&s=d1cddc674261a1f707b4e81b1f5968e5",
        },
        {
          value: 3,
          name: "Lomo saltado sin salsa",
          price: "S/.25",
          img: "https://i0.wp.com/comer.me/wp-content/uploads/2021/01/chorrillana.jpg?resize=700%2C500&ssl=1",
        },
        {
          value: 4,
          name: "Lomo saltado",
          price: "S/.25",
          img: "https://i0.wp.com/comer.me/wp-content/uploads/2021/01/chorrillana.jpg?resize=700%2C500&ssl=1",
        },
      ],
    };
  },
};
</script>

<style scoped>
</style>
