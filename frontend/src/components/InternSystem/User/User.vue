<template>
  <div>
    <div class="c1 main-title" body-class="">
      <b-row>
        <b-col class="text-aling-v-center">
          <h5 class="m-0 p-0">
            <b-icon icon="person-fill"></b-icon>
            &nbsp;Perfil de usuario
          </h5></b-col
        >
      </b-row>
    </div>
    <div class="main-body">
      <b-row align-h="center">
        <b-col xl="5" lg="6" md="8" sm="11">
          <b-card class="table-card c1" body-class="mx-3 my-2">
            <b-row>
              <b-col cols="6">Nombre: </b-col>
              <b-col cols="6">{{ item.name }}</b-col>
              <b-col cols="6">Usuario: </b-col
              ><b-col cols="6">{{ item.nickname }}</b-col>
              <b-col cols="6">Rol: </b-col
              ><b-col cols="6">{{ item.rolename }}</b-col>
            </b-row>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      item: { name: "jhon", rolename: "Administrador", nickname: "Jhon1234" },
    };
  },
};
</script>

<style scoped>
</style>
