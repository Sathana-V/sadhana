<template>
  <v-card>
    <v-card-title class="background white--text text-h5 pa-2">
      <div class="ml-3 pl-6">
        <h5 style="text-align: center">ADD PRODUCT</h5>
      </div>
    </v-card-title>

    <v-container class="pa-6">
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-row>
          <v-col cols="12" lg="4" sm="6" md="6" class="mt-4">
            <h4 class="mb-2">Model Name</h4>
            <v-autocomplete
              ref="model"
              outlined
              v-model="model"
              :rules="modelRules"
              :items="modelList"
              item-text="model_name"
              item-value="model_id"
              return-object
            >
            </v-autocomplete>
          </v-col>

          <v-col cols="12" lg="4" sm="6" md="6" class="mt-4">
            <h4>Product Name</h4>
            <v-text-field
              outlined
              class="mt-2"
              ref="products_name"
              :rules="productRules"
              v-model="product_name"
            ></v-text-field>
          </v-col>

          <v-col cols="12" lg="4" sm="6" md="6">
            <div class="pl-3 mb-1 mt-5"><strong>Status</strong></div>
            <v-text-field
              label="Status"
              solo
              readonly
              v-model="status"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row
          ><v-col lg="12" sm="12" md="12" xs="12">
            <h4>Colors Available</h4>
            <v-autocomplete
              key=""
              ref="model"
              outlined
              v-model="color"
              :rules="colorRules"
              :items="colorList"
              chips
              clearable
              deletable-chips
              multiple
              small-chips
              item-text="color_name"
              item-value="color_id"
              return-object
            >
            </v-autocomplete>
          </v-col>
        </v-row>
        <v-row class="">
          <v-col cols="12" lg="6" sm="6" md="6" class="mt-4">
            <h4>Product Description</h4>
            <v-textarea
              name="input-8-4"
              ref="product_description"
              outlined
              rows="5"
              :rules="descripRules"
              v-model="product_description"
            ></v-textarea>
          </v-col>
          <v-col cols="12" lg="6" sm="12" md="12">
            <v-row>
              <v-col cols="12" lg="12" sm="12" md="12" class="mt-4">
                <h4 class="mb-2">Available Size</h4>
                <v-radio-group
                  :rules="typeRules"
                  ref="type"
                  @change="chartChanged"
                  v-model="sizeType"
                  row
                >
                  <v-radio label="Size Chart" value="size"></v-radio>
                  <v-radio label="In centimeter" value="cm"></v-radio>
                </v-radio-group>
              </v-col>
            </v-row>
            <v-row>
              <v-col
                v-if="sizeType == 'size'"
                cols="12"
                lg="12"
                sm="12"
                md="12"
              >
                <v-autocomplete
                  key=""
                  ref="model"
                  outlined
                  v-model="sizeChart"
                  @change="generatePrice"
                  :items="sizeList"
                  chips
                  clearable
                  deletable-chips
                  multiple
                  small-chips
                  item-text="size_label"
                  item-value="size_rank"
                  return-object
                >
                </v-autocomplete>
              </v-col>
              <v-col v-if="sizeType == 'cm'" cols="12" lg="12" sm="12" md="12">
                <v-autocomplete
                  key=""
                  ref="model"
                  outlined
                  v-model="cmChart"
                  :rules="sizeRules"
                  :items="cmList"
                  chips
                  @change="generatePrice"
                  clearable
                  deletable-chips
                  multiple
                  small-chips
                  item-text="size"
                  item-value="size"
                  return-object
                >
                </v-autocomplete>
              </v-col>
            </v-row>
          </v-col>
        </v-row>

        <v-row>
          <v-col v-if="tableShow == true" lg="12" sm="12" md="12" xs="12">
            <v-data-table
              :hide-default-footer="true"
              loading-text="Loading... Please wait"
              :headers="headers"
              :items="priceTag"
              :search="search"
            >
              <template
                v-if="sizeType == 'size'"
                v-slot:item.agegroup="{ item }"
              >
                <v-text-field
                  class="ma-2"
                  solo
                  placeholder="10-15"
                  v-model="item.agegroup"
                  @click="editInput(item)"
                >
                </v-text-field>
              </template>
              <template v-slot:item.price="{ item }">
                <v-text-field
                  class="ma-2"
                  solo
                  v-model="item.price"
                  @click="editInput(item)"
                >
                </v-text-field>
              </template>
            </v-data-table>
          </v-col>
        </v-row>

        <v-row>
          <v-col lg="12" sm="12" md="12" xs="12">
            <template>
              <v-sheet class="mx-auto" elevation="8" max-width="1300">
                <div class="d-flex justify-space-between">
                  <h3 class="ml-3 mt-2">Attachment(s)</h3>
                  <v-btn
                    v-show="!hidden"
                    color="red"
                    fab
                    dark
                    small
                    class="mr-3 mt-3 mx-2"
                    top
                    right
                    @click="dialog = !dialog"
                  >
                    <v-icon>mdi-plus</v-icon>
                  </v-btn>
                </div>

                <v-slide-group
                  v-model="model"
                  class="pa-4 mt-6"
                  active-class="success"
                  show-arrows
                >
                  <v-slide-item
                    v-for="(item, index) in preview_list"
                    :key="index"
                  >
                    <v-card
                      class="white ma-4"
                      elevation="4"
                      :height="Number(width) + 55"
                      :width="width"
                    >
                      <v-row
                        class="fill-height"
                        align="center"
                        justify="center"
                      >
                        <v-scale-transition>
                          <v-img
                            class="grey lighten-4 ml-4 mt-4 mr-4"
                            :width="width"
                            :height="width + 5"
                            :src="item"
                          >
                          </v-img>
                        </v-scale-transition>

                        <v-icon
                          dark
                          @click="
                            editImage(
                              item,
                              index,
                              image_list[index].name,
                              image_list[index].size / 1024
                            )
                          "
                          color="blue"
                          class="mt-2 pa-0 text-sm-h5 text-lg-h4"
                          >mdi-image-edit</v-icon
                        >
                        <v-icon
                          dark
                          @click="
                            deleteImage(
                              index,
                              image_list[index].name,
                              image_list[index].size / 1024
                            )
                          "
                          color="red"
                          class="mt-2 ml-4 pa-0 text-sm-h5 text-lg-h4"
                          >mdi-delete</v-icon
                        >
                      </v-row>
                    </v-card>
                  </v-slide-item>
                </v-slide-group>
                <div
                  v-if="filecount > 0"
                  class="mt-4 pb-3 d-flex justify-space-around"
                >
                  <h4>
                    Total No. Of Attachments :
                    <strong class="red--text">{{ filecount }}</strong>
                  </h4>
                </div>
              </v-sheet>
            </template>

            <v-dialog
              v-model="imageView"
              persistent
              content-class="v-dialog--custom"
              scrollable
              :height="editport + 300"
              :width="editport + 100"
            >
              <Image-viewer :files="propi" :name="name" @clicked="edited" />
            </v-dialog>

            <v-dialog v-model="dialog" max-width="500px">
              <v-card>
                <v-card-text class="mt-4 pt-3">
                  <v-file-input
                    v-model="files"
                    accept="image/*"
                    label="Attach Images"
                    multiple
                    prepend-icon="mdi-paperclip"
                  >
                    <template v-slot:selection="{ text }">
                      <v-chip small label color="primary">
                        {{ text }}
                      </v-chip>
                    </template>
                  </v-file-input>
                </v-card-text>

                <v-card-actions>
                  <v-btn text color="primary" @click="previewMultiImage">
                    Upload
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </v-col>
        </v-row>

        <v-dialog v-model="success" width="350">
          <v-card>
            <v-card-title class="text-h6 background white--text" dark>
              {{ success_message }}
            </v-card-title>

            <v-divider></v-divider>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="primary" text @click="success = false"> OK </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-form>
    </v-container>
    <v-card-actions class="d-flex align-lg-content-end flex-column">
      <div>
        <v-btn
          class="white pa-4 black--text"
          dense
          elevation="4"
          large
          @click="closeDialog"
          >Cancel</v-btn
        >
        <v-btn
          dense
          color="background ml-6  pl-6 pr-6"
          elevation="4"
          @click="submit"
          large
          dark
          >Save</v-btn
        >
      </div>
    </v-card-actions>
  </v-card>
</template>

<script>
import ImageViewer from "~/components/ImageViewer.vue";
const sorter2 = (sortBy) => (a, b) =>
  a[sortBy].toLowerCase() > b[sortBy].toLowerCase() ? 1 : -1;

export default {
  emits: ["closeDialog"],
  name: "AddProduct",
  components: { ImageViewer },

  data: (vm) => ({
    date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
      .toISOString()
      .substr(0, 10),
    dateFormatted: vm.formatDate(
      new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10)
    ),
    icon: "mdi-checkbox-blank-outline",
    menu1: false,
    tableShow: false,
    toggle: false,
    modal: false,
    model: true,
    valid: false,
    success_message: false,
    success: false,
    menu2: false,
    sizeChart: [],
    cmChart: [],
    dialog: false,
    hidden: false,
    name: null,
    status: "new",
    imageView: false,
    today: new Date().toJSON().slice(0, 10),
    category: null,
    preview_list: [],
    image_list: [],
    model: null,

    files: [],
    cmList: ["70", "75", "80", "85", "90", "95", "100"],
    passFile: [],
    size: "",
    sizeList: [],
    sizeRules: [(v) => !!v || "Required"],
    color: [],
    colorList: [],
    colorRules: [(v) => !!v || "Required"],
    categoryFilter: null,
    propi: null,
    sizefinallist: [],
    designation: "",
    product_description: "",

    selected: [],
    product_name: "",
    price: "",
    sizeType: "size",
    search: "",
    tas: "",
    productRules: [(v) => !!v || "Required"],
    categoryRules: [(v) => !!v || "Required"],
    dateRules: [(v) => !!v || "Required"],
    typeRules: [(v) => !!v || "Required"],
    desigRules: [(v) => !!v || "Required"],
    modelRules: [(v) => !!v || "Required"],
    priceRules: [(v) => !!v || "Required"],

    descripRules: [
      (v) => !!v || "Required",
      (v) =>
        (v && v.length <= 2500) ||
        "Description must be less than 2500 characters",
    ],
    modelList: [],
    headers: [],
    cmheaders: [
      { text: "Label", value: "label", sortable: false, width: 10 },
      { text: "Price", value: "price", sortable: false, width: 20 },
    ],
    sizeheaders: [
      { text: "Label", value: "label", sortable: false, width: 10 },
      { text: "Age Group", value: "agegroup", sortable: false, width: 30 },
      { text: "Price", value: "price", sortable: false, width: 30 },
    ],
    priceTag: [],
  }),
  mounted() {
    this.Details();
    this.valid = false;
  },

  created: function () {
    this.valid = false;
  },

  computed: {
    fontSize() {
      switch (this.$vuetify.breakpoint.name) {
        case "xs":
          return "3em";
        default:
          return "5em";
      }
    },
    computedDateFormatted() {
      return this.formatDate(this.date);
    },
    // for responsive image width
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
    filecount() {
      return this.preview_list.length;
    },
    // for responsive dialog width
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
    date(val) {
      this.dateFormatted = this.formatDate(this.date);
    },
    //Filtering models based on Category
    category(val) {
      if (this.category == "Teaching") {
        this.categoryFilter = "no";
      } else if (this.category == "Non Teaching") {
        this.categoryFilter = "yes";
      } else if (this.category == "All") {
        this.categoryFilter = "All";
      }
    },
  },

  methods: {
    chartChanged() {
      this.tableShow = false;
      if (this.sizeType === "size") {
        this.cmChart = [];
      } else if (this.sizeType === "cm") {
        this.sizeChart = [];
      }
    },
    editInput(item) {
      console.log(item);
      let resulti = this.priceTag;
      let obj = resulti.find((o) => o["label"] === item.label);
      console.log(obj);
    },
    generatePrice() {
      console.log(typeof this.cmChart);
      console.log(this.cmChart);
      this.priceTag = [];
      if (this.sizeType === "size") {
        this.headers = this.sizeheaders;
        console.log(this.sizeChart);
        for (const element of this.sizeChart) {
          this.sizefinallist.push(element.size_label);
          this.priceTag.push({
            label: element.size_label,
            rank: element.size_rank,
            agegroup: "",
            price: 0,
          });
        }
        let objs = this.priceTag;
        objs.sort(sorter2("rank"));
        this.priceTag = objs;
      } else if (this.sizeType === "cm") {
        this.headers = this.cmheaders;
        for (const element of this.cmChart) {
          this.sizefinallist.push(element);
          this.priceTag.push({ label: element, price: 0 });
        }
        let objs = this.priceTag;
        objs.sort(sorter2("label"));
        this.priceTag = objs;
      }
      this.tableShow = true;
      console.log(this.priceTag);
    },
    //function to close add dialog box
    closeDialog(status) {
      this.reset();
      this.valid = false;
      this.$emit("clicked", status);
    },
    //function for fetching model details
    async Details() {
      console.log("haiii");
      const response = await this.$axios
        .get(`models`)
        .then((res) => {
          var i = 0;

          console.log(res.data.Model_Data.length);
          for (i; i < res.data.Model_Data.length; i++) {
            this.modelList.push(res.data.Model_Data[i]);
          }
        })
        .catch((err) => {
          console.log(err);
        });
      this.colorList = [];
      const response2 = await this.$axios
        .get(`colors`)
        .then((res) => {
          var i = 0;

          console.log(res.data.Color_Data.length);
          for (i; i < res.data.Color_Data.length; i++) {
            this.colorList.push(res.data.Color_Data[i]);
          }
        })
        .catch((err) => {
          console.log(err);
        });
      const response3 = await this.$axios
        .get(`size`)
        .then((res) => {
          var i = 0;

          console.log(res.data.Size_Data.length);
          for (i; i < res.data.Size_Data.length; i++) {
            this.sizeList.push(res.data.Size_Data[i]);
          }
        })
        .catch((err) => {
          console.log(err);
        });

      console.log(this.sizeList);
    },
    //called when we click edit icon
    editImage(file, index) {
      this.imageView = !this.imageView;
      this.propi = file;
      this.name = index;
    },
    //for removing image from attachments
    deleteImage(b, c, d) {
      this.preview_list.splice(b, 1);
      this.image_list.splice(b, 1);
      this.passFile.splice(b, 1);
    },
    //invoked when image is rotated
    edited(file, index) {
      this.preview_list.splice(index, 1, file);
      this.changeImage(index, file);
      this.imageView = !this.imageView;
    },
    changeImage(index, dataUrl) {
      var imgname = this.passFile[index].name;

      var fileData = this.dataURLtoFile(dataUrl, imgname);

      this.passFile.splice(index, 1, fileData);
    },
    //changing dataurl to file object
    dataURLtoFile(dataurl, filename) {
      var arr = dataurl.split(","),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);
      while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
      }
      return new File([u8arr], filename, { type: mime });
    },
    //invoked when images added in file upload buton
    previewMultiImage: function (event) {
      this.dialog = false;

      var count = this.files.length;

      var index = 0;

      if (this.files) {
        while (count--) {
          var reader = new FileReader();
          reader.onload = (e) => {
            this.preview_list.push(e.target.result);
          };
          this.image_list.push(this.files[index].name);
          this.passFile.push(this.files[index]);

          reader.readAsDataURL(this.files[index]);
          index++;
        }
        this.files = [];
      }
    },
    //formatting date to date-month-year
    formatDate(date) {
      if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
    },
    parseDate(date) {
      if (!date) return null;
      const [day, month, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    },
    //form is reseted when user clicks cancel button
    reset() {
      console.log("callled");
      this.date = this.today;
      this.product_name = "";
      this.tableShow = false;
      this.priceTag = [];
      this.product_description = "";
      this.color = [];
      this.cmChart = [];
      this.sizeChart = [];
      this.sizeType = "size";
      this.valid = true;
      this.menu2 = false;
      this.dialog = false;
      this.hidden = false;
      this.name = null;
      this.imageView = false;
      this.category = null;
      this.preview_list = [];
      this.image_list = [];
      this.model = null;
      this.files = [];
      this.propi = null;
      this.passFile = [];
    },
    //invokes when submit button is clicked
    async submit() {
      this.$refs.form.validate();
      console.log(this.$refs.form.validate());
      console.log("color");
      console.log(this.color);
      if (this.$refs.form.validate()) {
        let data = new FormData();
        console.log("priceTag", this.priceTag);
        data.append("product_name", this.product_name);
        data.append("product_description", this.product_description);
        data.append("status", this.status);

        this.image_list.forEach((item) => data.append("file_names[]", item));
        this.preview_list.forEach((item) => data.append("files_array[]", item));
        
          for (var index = 0; index < this.priceTag.length; index++) {
            data.append(`available_size[${index}]`, this.priceTag[index].label);
          }
 
        for (var index = 0; index < this.priceTag.length; index++) {
          data.append(`available_size[${index}]`, this.priceTag[index].label);
        }
        for (var index = 0; index < this.color.length; index++) {
          data.append(`available_colors[${index}]`, this.color[index].color_id);
        }
        if (this.sizeType == "size") {
          for (var index = 0; index < this.priceTag.length; index++) {
            data.append(
              `pricelist[${index}]['label']`,
              this.priceTag[index].label
            );
            data.append(
              `pricelist[${index}]['price']`,
              this.priceTag[index].price
            );
            data.append(
              `pricelist[${index}]['agegroup']`,
              this.priceTag[index].agegroup
            );
          }
        } else if (this.sizeType == "cm") {
          for (var index = 0; index < this.priceTag.length; index++) {
            data.append(
              `pricelist[${index}]['label']`,
              this.priceTag[index].label
            );
            data.append(
              `pricelist[${index}]['price']`,
              this.priceTag[index].price
            );
          }
        }
        data.append("price", this.priceTag);
        data.append("sizetype", this.sizeType);
        data.append("model_name", this.model.model_name);
        data.append("file_count", this.filecount);
        data.append("model_id", this.model.model_id);
        var files1 = this.passFile;
        var totalfiles = this.passFile.length;
        for (var index = 0; index < totalfiles; index++) {
          data.append("files[]", files1[index]);
        }
        for (var pair of data.entries()) {
          console.log(pair[0] + ", " + pair[1]);
        }
        await this.$axios

          .post("product/add", data, {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          })
          .then((res) => {
            console.log(res);
            if (res.data.error) {
              console.log(res.data.messages);
              this.closeDialog("failed");
            } else {
              console.log(res.data.messages);
              this.closeDialog("success");
            }
          })

          .catch((err) => {
            console.log(err);
          });
      }
    },
  },
};
</script>

<style scoped>
.theme--light.v-data-table {
  background-color: #ffffff;
  color: rgba(0, 0, 0, 0.87);
  border: 1px solid darkgray;
}
tr {
  margin-bottom: -10%;
  padding-bottom: -10%;
}
.v-dialog--custom {
  overflow: unset;
}
.v-application .text-h5 {
  font-size: 1.5rem !important;
  font-weight: 400;
  font-size: 40px;
  text-align: center;
  line-height: 4rem;
  letter-spacing: normal !important;
  font-family: "Roboto", sans-serif !important;
}
.v-application .background {
  background-color: #17a2b8 !important;
  border-color: #17a2b8 !important;
}
</style>
