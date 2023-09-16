<template>
  <v-content>
    <v-container>
      <div class="datatable mt-4">
        <v-card>
          <v-row>
            <v-col cols="12" lg="4" md="12" sm="12">
              <v-color-picker
                class="ma-2"
                v-model="color"
                @input="showColorName"
                mode="hexa"
                show-swatches
                swatches-max-height="300px"
              ></v-color-picker>
            </v-col>
            <v-col cols="12" lg="8" md="12" sm="12">
              <v-row>
                <v-col cols="12" lg="6" md="12" sm="12">
                  <h4>Color</h4>
                  <v-text-field
                    name="input-7-4"
                    :prepend-inner-icon="iconStatus"
                    outlined
                    @blur="findColor"
                    v-model="colorName"
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="12" lg="3" md="12" sm="12">
                  <v-btn class="primary" block @click="findColor">
                    Check
                  </v-btn>
                </v-col>
                <v-col cols="12" lg="3" md="12" sm="12">
                  <v-btn class="success" block @click="submit">
                    Add To Table
                  </v-btn>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12" lg="8" md="12" sm="12">
                  <v-data-table
                    class="ml-4"
                    loading-text="Loading... Please wait"
                    :headers="headers"
                    :items="colors"
                    :search="search"
                  >
                    <template v-slot:top>
                      <v-toolbar flat>
                        <v-dialog v-model="dialog" persistent max-width="700px">
                        </v-dialog>
                      </v-toolbar>
                    </template>
                    <template v-slot:item.HexValue="{ item }">
                      <v-avatar
                        :style="{ background: item.color_hexvalue }"
                        size="30"
                      ></v-avatar>
                    </template>

                   
                       
                    <template v-slot:item.Action="{ item }">
                    <v-icon  color="primary" @click="editItem(item)">mdi-pencil</v-icon>
                      <v-icon color="red" @click="deleteNow(item)"
                        >mdi-delete</v-icon
                      >
                    </template>
                  </v-data-table>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-card>
      </div>
    </v-container>
    <v-dialog v-model="editDialog" persistent max-width="600px">
      <EditColor
        :editItem="edit"
        :currentIns="currentTime"
        @clicked="editDialogClose"
      />
    </v-dialog>

    <v-snackbar v-model="success" :timeout="timeout">
      {{ success_message }}

      <template v-slot:action="{ attrs }">
        <v-btn color="blue" text v-bind="attrs" @click="success = false">
          Close
        </v-btn>
      </template>
    </v-snackbar>

    <v-dialog v-model="delete_confirmation" width="400">
      <v-card>
        <v-card-title class="text-subheading-1 background white--text" dark>
          Are you sure do you need to delete ?
        </v-card-title>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn color="green" text @click="deleteNow">
            Yes
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="delete_confirmation = false">
            No
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-content>
</template>
<script src="http://localhost/sadhana/dashboard/frontend/api/ntc.js"></script>
<script>
import ntc from "~/api/ntc";
export default {
   layout:'dashboard',
      beforeMount(){
        var cook=this.getCookie("username");
        if(cook==null)
                   {
                     console.log("empty")
                        window.location.href = "http://localhost:3000/loginform"
                     
                     
                   }
      },
  mounted() {
    this.details();
  },

  data: vm => ({
    dialog: false,
    editDialog: false,
    delete_confirmation: false,
    delete_item: null,
    search: "",
    icon: "",
    timeout: 2000,
    success_message: "",
    colorName: "",
    currentTime: "",
    iconStatus: "mdi-eye",
    color: "",
    success: false,
    edit: null,
    headers: [
      { text: "SI.No", value: "color_id", width: 50 },

      { text: "", value: "HexValue", sortable: false, width: 50 },
      { text: "Color", value: "color_name", sortable: false, width: 200 },
      { text: "Action", value: "Action", sortable: false }
    ],
    colors: []
  }),

  computed: {
    color: {
      get() {
        return this[this.type];
      },
      set(v) {
        this[this.type] = v;
      }
    },
    showColor() {
      if (typeof this.color === "string") return this.color;

      return JSON.stringify(
        Object.keys(this.color).reduce((color, key) => {
          color[key] = Number(this.color[key].toFixed(2));
          return color;
        }, {}),
        null,
        2
      );
    },
    showColorName() {
      console.log("hai");
      let value = this.showColor;
      value = value.slice(0, value.length - 2);
      let result = ntc.name(value);
      console.log(value);
      let rgb_value = result[0]; // #6495ed         : RGB value of closest match
      let specific_name = result[1]; // Cornflower Blue : Color name of closest match
      let is_exact_match = result[2];
      console.log(rgb_value);
      console.log(specific_name);

      this.colorName = specific_name;

      this.iconStatus = "mdi-check";
    }
  },
  methods: {
     getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
},
    getvalue(item) {
      console.log(item);
      return item;
    },
    findColor() {
      let value = this.colorName;
      let resulti = ntc["names"];
      let obj = resulti.find(o => o[1].toLowerCase() === value.toLowerCase());
      console.log(obj);
      if (obj) {
        this.color = obj[0];
        this.iconStatus = "mdi-check";
      } else {
        this.iconStatus = "mdi-close";
      }
    },
    async submit() {
      if (this.iconStatus == "mdi-check") {
        let value = this.color;
        value = value.slice(0, value.length - 2);
        let data = new FormData();
        data.append("name", this.colorName);
        data.append("value", value);

        for (var pair of data.entries()) {
          console.log(pair[0] + ", " + pair[1]);
        }
        await this.$axios

          .post("Colors", data, {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          })
          .then(res => {
            console.log(res.data);
            if (res.data.error) {
              console.log(res.data.messages);
            } else {
              this.details();
              console.log(res.data.messages);
            }
          })

          .catch(err => {
            console.log(err);
          });
      }
    },
    // functions for displaying snackbars when edited
    editDialogClose(status) {
      this.editDialog = false;
      if (status == "success") {
        this.success = true;
        this.success_message = "Circular Updated successfully";
      } else if (status == "failed") {
        this.success = true;
        this.success_message = "Something went wrong can't Update";
      }
      this.details();
    },
    // functions for displaying snackbars when added
    closeDialog(status) {
      this.dialog = false;
      if (status == "success") {
        this.success = true;
        this.success_message = "Circular Added Successfully";
      } else if (status == "failed") {
        this.success = true;
        this.success_message = "Something went wrong circular not added";
      }
      this.details();
    },
    //invoking dialog box for ensuring deletion

    //fucntion for deleting record from table(ui)
    async deleteNow(e) {
      console.log(e);
      const response = await this.$axios.delete("colors/delete/" + e.color_id);

      if (response.status && response.data.status === 201) {
        this.success = true;
        this.success_message = "Deleted Successfully";
        this.details();
      } else {
        this.success = true;
        this.success_message = "Something Went wrong try again";
        this.details();
      }
    },
    //fucntion for Publishing record
    async publishNow(e) {
      const response = await this.$axios.put("Circular/" + e.id, {
        operation: "Publish"
      });

      if (response.status && response.data.status === 201) {
        this.success = true;
        this.success_message = "Published Successfully";
        this.details();
      } else {
        this.success = true;
        this.success_message = "Something Went wrong try again";
        this.details();
      }
    },
    // set edit dialog box to true
    editItem(item) {
      console.log(item)
      this.edit = item;
      this.editDialog = true;
      this.currentTime = new Date();
    },
    // function to fetch records from database
    async details() {
      await this.$axios
        .get("/colors")
        .then(res => {
          this.colors = res.data.Color_Data;
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>
<style>
.v-application a {
  color: white;
  text-decoration: none;
}
.default {
  background-color: "#A52A2A";
  color: "#A52A2A";
}
.datatable .v-input__slot {
  width: 100%;
}

.v-slide-group__prev {
  margin-right: 10px;
  min-width: 10px;
}

.v-slide-group__next {
  margin-left: 10px;
  min-width: 10px;
}

.v-slide-group__next .v-icon.v-icon,
.v-slide-group__prev .v-icon.v-icon {
  /* font-size: 2rem; */

  font-size: 35px;

  color: white;
  background-color: lightgray;
  border-radius: 20px;
}
</style>
