<template>
  <div>
    <v-card>
      <v-container>
        <v-card-title>
          <v-btn
            class="white red--text mr-0 mt-6"
            small
            absolute
            top
            elevation="0"
            right
            dark
            fab
            @click="save"
          >
            <v-icon class=" text-h4">mdi-close</v-icon>
          </v-btn>
        </v-card-title>

        <div class="d-flex justify-center">
          <croppa
            v-model="croppa"
            initial-size="contain"
            :height="editport"
            :show-remove-button="false"
            :width="editport"
          >
            <img :src="files" slot="initial" />
          </croppa>
        </div>

        <v-card-actions class="d-flex justify-center">
          <v-btn large color="primary" dark @click="rotate">
            <v-icon> mdi-reload </v-icon></v-btn
          >
        </v-card-actions>
      </v-container>
    </v-card>
  </div>
</template>

<script>
export default {
  name: "ImageViewer",
  props: ["files", "name"],
  emits: ["closeDialog"],
  data() {
    return {
      croppa: {}
    };
  },
  computed: {
    editport() {
      switch (this.$vuetify.breakpoint.name) {
        case "xs":
          return 250;
        case "sm":
          return 350;
        case "md":
          return 450;
        case "lg":
          return 600;
        case "xl":
          return 550;
      }
    }
  },
  watch: {
    files() {
      this.croppa.refresh();
    }
  },

  methods: {
    rotate() {
      this.croppa.rotate();
    },
    save() {
      this.dataUrl = this.croppa.generateDataUrl();

      this.$emit("clicked", this.dataUrl, this.name);
    }
  }
};
</script>

<style scoped></style>
