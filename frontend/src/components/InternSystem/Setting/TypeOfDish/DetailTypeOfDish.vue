<template>
  <div>
    <b-modal
      id="detail-typeofdish-modal"
      ref="modal"
      :title="title[mode]"
      scrollable
      no-close-on-backdrop
      @ok="handleOk"
      ok-title="Agregar"
      cancel-title="Cancelar"
    >
      <div class="mb-2">
        <b-img :src="item.image" fluid :alt="item.name"></b-img>
      </div>
      <b-form-group
        class="mb-2"
        id="input-group-1"
        label="Nombre:"
        label-size="sm"
        label-for="input-1"
        label-class="mb-0"
      >
        <b-form-input
          id="input-1"
          v-model="item.name"
          type="text"
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group
        class="mb-2"
        id="input-group-2"
        label="Descripcion:"
        label-size="sm"
        label-for="input-2"
        label-class="mb-0"
      >
        <b-form-input
          id="input-2"
          v-model="item.description"
          type="text"
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group
        v-if="mode === 0 || mode === 2"
        class="mb-2"
        id="input-group-3"
        label="Imagen:"
        label-size="sm"
        label-for="input-3"
        label-class="mb-0"
      >
        <b-form-file
          accept="image/*"
          required
          id="input-3"
          v-model="image"
          placeholder="Escoge una imagen..."
          drop-placeholder="Suelta una imagen aqui..."
        ></b-form-file>
      </b-form-group>
      <template #modal-footer="{ cancel, ok }">
        <b-button variant="danger" @click="cancel()"> Cancelar </b-button>
        <b-button v-if="mode === 1" variant="warning" @click="editItemButtom()">
          Editar
        </b-button>
        <b-button
          v-if="mode === 1"
          variant="danger"
          @click="deleteItemButtom()"
        >
          Eliminar
        </b-button>
        <b-button
          v-if="mode === 2"
          variant="primary"
          @click="detailItemButtom()"
        >
          Ver
        </b-button>

        <b-button
          v-if="mode === 0 || mode === 2"
          variant="primary"
          @click="ok()"
        >
          Aceptar
        </b-button>
      </template>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: ["item", "mode", "changeMode"],
  data() {
    return {
      title: ["Agregar regitro", "Ver registro", "Editar registro"],
      image: null,
    };
  },
  methods: {
    handleOk(evt) {
      evt.preventDefault();
      this.handleSubmit();
    },
    handleSubmit() {
      switch (this.mode) {
        case 0:
          this.addItem();
          break;
        case 2:
          this.editItem();
          break;
        default:
          console.log("Ocurrio un error");
          break;
      }
    },
    editItem() {
      console.log("se edito el elemento");
      this.$nextTick(() => {
        this.$bvModal.hide("detail-typeofdish-modal");
      });
    },
    addItem() {
      console.log("se agrego el elemento");
      this.$nextTick(() => {
        this.$bvModal.hide("detail-typeofdish-modal");
      });
    },

    detailItemButtom() {
      this.changeMode(1);
    },
    editItemButtom() {
      this.changeMode(2);
    },
    deleteItemButtom() {
      this.$root.$emit("bv::show::modal", "delete-typeofdish-modal");
    },
  },
};
</script>

<style scoped>
</style>
