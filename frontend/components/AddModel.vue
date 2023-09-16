<template>
  <v-card>
   
    <v-container class="pa-6">
      <v-form
        ref="form"
       
        v-model="valid"
        lazy-validation
      >
        <v-row>
       
       

          <v-col cols="12" lg="12" sm="12" md="12">
            <div class="pl-3"><strong>Model Name</strong></div>
             
            <v-text-field
              outlined
              solo
              
              v-model="modelName"
            ></v-text-field>
          </v-col>
        </v-row>

      </v-form>
      <v-card-actions class="d-flex align-lg-content-end flex-column">
      <div>
        <v-btn
          dense
          color="background"
          elevation="4"
         
          @click="submit"
          large
          dark
          >Save</v-btn
        >
      </div>
    </v-card-actions>
    </v-container>
    <!-- close and submit button for edi dialog box  -->
    
  </v-card>
</template>

<script>
import ImageViewer from "~/components/ImageViewer.vue";
export default {
  props: [ "currentIns"],
  emits: ["closeDialog"],
  name: "AddModel",
 
  data: vm => ({
    
    icon: "mdi-checkbox-blank-outline",
   
    modal: false,
    model: true,
    valid: true,
    success_message: false,
    success: false,
    modelName:'',
    
    dialog: false,
    hidden: false,
    name: null,
    status: "new",
    imageView: false,
  
  }),
  mounted() {
    
    
    this.setDetails();
  },


  computed: {
    //for responsive image width
    width() {
      switch (this.$vuetify.breakpoint.name) {
        case "xs":
          return 150;
        case "sm":
          return 150;
        case "md":
          return 150;
        case "lg":
          return 200;
        case "xl":
          return 150;
      }
    },
    // for responsive dialog box
    editport() {
      switch (this.$vuetify.breakpoint.name) {
        case "xs":
          return 250;
        case "sm":
          return 350;
        case "md":
          return 450;
        case "lg":
          return 800;
        case "xl":
          return 550;
      }
    },
  },

  watch: {
    // when item passed through prop varies setdetails will we invoked
    editItem(old, newn) {
      this.setDetails();
    },
  },

  methods: {
    // function to set detailes of selected item

    async setDetails() {
      this.modelName = this.editItem.model_name;
    },
    //will be invoked when image orientation changes
   
    //invoked when user clicks close or save button
    closeDialog(message) {
       console.log('emited',message);
      this.$emit("clicked", message);
    },
    
   
    async submit() {
      
        let data = new FormData();
        data.append("name", this.modelName);
         

      
                     for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]);
                    }

         
        const response = await this.$axios.post(
            "models/add",
            data,
            {
              headers: {
                "Content-Type": "multipart/form-data"
              }
            }
          )
        console.log(response)
        if (response.status && response.data.status === 201) {
          console.log("succees")
          this.closeDialog("success");
        } else {
           console.log("failed")
          this.closeDialog("failed");
        }
      }
    }
  
};
</script>

<style>

#no-background-hover::before {
  background-color: transparent !important;
}
.theme--light.v-btn.v-btn--disabled.v-btn--has-bg {
  background-color: white !important;
  cursor: pointer;
}
</style>
