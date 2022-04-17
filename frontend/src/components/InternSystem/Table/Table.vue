<template>
  <div>
    <div >
      <b-card
        title="Mesa 9"
        class="m-2"
      >
        <b-card-text>
          Reservado para 12/28/9
        </b-card-text>

        <b-button href="#" variant="primary">Ver pedidos</b-button>
      </b-card>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      items: [
        { age: 40, first_name: "Dickerson", last_name: "Macdonald" },
        { age: 21, first_name: "Larsen", last_name: "Shaw" },
        { age: 89, first_name: "Geneva", last_name: "Wilson" },
        { age: 38, first_name: "Jami", last_name: "Carney" },
      ],
    };
  },
};
</script>

<style scoped>
.table-item {
  background: red;
}
</style>
