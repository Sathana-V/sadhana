<template>
  <v-card>
    <v-card-title class="background white--text text-h5 pa-2">
      <div class=" ml-3 pl-6">
        Add Product
      </div>
    </v-card-title>

    <v-container class="pa-6">
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-row>
          <v-col cols="12" lg="4" sm="6" md="6" class="mt-4 ">
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
              rows="8"
              
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
          <v-col
            v-if="sizeType == 'cm'"
            cols="12"
           
            lg="12"
            sm="12"
            md="12"
          >
           
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
    
         <v-row
          >
          <v-col v-if="tableShow==true" lg="12" sm="12" md="12" xs="12">
             <v-data-table 
                 :hide-default-footer="true"
                
                 loading-text="Loading... Please wait" 
               :headers="headers" :items="priceTag" :search="search">
                <template v-if="sizeType=='size'" v-slot:item.agegroup="{ item }">
              <v-text-field  class="ma-2" solo placeholder="10-15" v-model="item.agegroup" @click="editInput(item)">
           
              </v-text-field>
          </template>
                <template v-slot:item.price="{ item }">
              <v-text-field  class="ma-2" solo  v-model="item.price" @click="editInput(item)">
           
              </v-text-field>
          </template>
               </v-data-table>
            </v-col>
            </v-row>
             
        <v-row>
           
          <v-col lg="12" sm="12" md="12" xs="12">
            <template>
              <v-sheet class="mx-auto" elevation="8" max-width="1300">
                <div class=" d-flex justify-space-between">
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
                          class=" mt-2 ml-4 pa-0 text-sm-h5 text-lg-h4"
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
              <v-btn color="primary" text @click="success = false">
                OK
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-form>
    </v-container>
    <!-- close and submit button for edi dialog box  -->
    <v-card-actions class="d-flex align-lg-content-end flex-column">
      <div>
        <v-btn
          class="white pa-4 black--text"
          dense
          elevation="4"
          large
          @click="closeDialog('close')"
          >Cancel</v-btn
        >
        <v-btn
          dense
          color="background ml-6  pl-6 pr-6"
          elevation="4"
          :disabled="shouldDisable"
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
const sorter2 = (sortBy) => (a, b) => a[sortBy].toLowerCase() > b[sortBy].toLowerCase() ? 1 : -1;

export default {
  props: ["editItem", "currentIns"],
  emits: ["closeDialog"],
  name: "EditProduct",
  components: { ImageViewer },

  data: vm => ({
    date: "",
    icon: "mdi-checkbox-blank-outline",
    menu1: false,
    dateFormatted: null,
    toggle: false,
    modal: false,
    model: [],
    valid: true,
    success_message: false,
    success: false,
    menu2: false,
    shouldDisable: true,
    dialog: false,
    hidden: false,
    name: null,
    status: "new",
    imageView: false,
   
    category: "",
    preview_list: [],
    image_list: [],
    test: null,
   
   
    files: [],
    passFile: [],
    categoryFilter: null,
    attachedImages: null,
    propi: null,
    
    tableShow:false,
   
    sizeChart:[],
    cmChart:[],
  
    
  
    
   
    cmList: ["70", "75", "80", "85", "90", "95", "100"],
   
    size: "",
    sizeList: [],
    sizeRules: [v => !!v || "Required"],
     color: [],
    colorList: [],
    colorRules: [v => !!v || "Required"],
   
  
    sizefinallist:[],
   
    product_description: "",
   
    selected: [],
    product_name: "",
    price: "",
    sizeType: "size",
    search:"",
    tas: "",
    productRules: [v => !!v || "Required"],
    categoryRules: [v => !!v || "Required"],
    descripRules: [v => !!v || "Required"],
    typeRules: [v => !!v || "Required"],
    desigRules: [v => !!v || "Required"],
    modelRules: [v => !!v || "Required"],
    priceRules: [v => !!v || "Required"],
   
    modelList: [],
     headers:[],
      cmheaders: [
        { text: "Label", value: "label",sortable: false,width:10},
        { text: "Price", value: "price",sortable: false,width:20},
      ],
       sizeheaders: [
        { text: "Label", value: "label",sortable: false,width:10},
         { text: "Age Group", value: "agegroup",sortable: false,width:30},
        { text: "Price", value: "price",sortable: false,width:30},
      ],
      priceTag: [],
   
  }),
  async mounted() {
    
    this.Details();
    this.setDetails();
    this.valid = true;
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
    filecount() {
      return this.preview_list.length;
    }
  },

  watch: {
    // when item passed through prop varies setdetails will we invoked
    editItem(old, newn) {
      this.setDetails();
    },
   
    //filtering department based on category
    
  },

  methods: {
    // function to set detailes of selected item
 chartChanged()
    {
     
      this.tableShow=false
      if(this.sizeType==='size')
      {
      this.cmChart=[]
      
      }
      else if(this.sizeType==='cm')
      {
      this.sizeChart=[]

      }
    },
    editInput(item){
            
            let resulti=this.priceTag;
             let obj = resulti.find(o => o['label'] === item.label);
            
    },
    initialGeneratePrice()
    {
      
     
      this.priceTag=[];
      if(this.sizeType==='size')
      { 
        this.headers=this.sizeheaders;
        
        for(var i=0;i<this.sizeChart.length;i++)
        {
          var agegroup=this.editItem.price[i]["'agegroup'"];
          var price=this.editItem.price[i]["'price'"];
          var obj={'label':this.sizeChart[i].size_label,'rank':this.sizeChart[i].size_rank,'agegroup':agegroup,'price':price};
         
           this.priceTag.push(obj)
        }
         let objs = this.priceTag;
         objs.sort(sorter2('rank'));
         this.priceTag=objs;
      }
           
      else if(this.sizeType==='cm')
      {
        this.headers=this.cmheaders
        for(var i=0;i<this.cmChart.length;i++)
        {
          this.priceTag.push({'label':this.cmChart[i],'price':this.editItem.price[i]["'price'"]})
        }
          let objs = this.priceTag;
          objs.sort(sorter2('label'));
          this.priceTag=objs;
      }
      this.tableShow=true
      // console.log(this.priceTag)
    },
    generatePrice()
    {
     
      // console.log(this.sizeType)
      this.priceTag=[];
      if(this.sizeType==='size')
      { 
        this.headers=this.sizeheaders;
        // console.log(this.sizeChart)
        for(const element of this.sizeChart)
        {
          this.sizefinallist.push(element.size_label);
          this.priceTag.push({'label':element.size_label,'rank':element.size_rank,'agegroup':'','price':0})
        }
         let objs = this.priceTag;
         objs.sort(sorter2('rank'));
         this.priceTag=objs;
      }
           
      else if(this.sizeType==='cm')
      {
        this.headers=this.cmheaders
          for(const element of this.cmChart)
          {
             this.sizefinallist.push(element);
            this.priceTag.push({'label':element,'price':0})
          }
          let objs = this.priceTag;
          objs.sort(sorter2('label'));
          this.priceTag=objs;
      }
      this.tableShow=true
      // console.log(this.priceTag)
    },
    async setDetails() {
        // console.log("heweoauiu")
        // console.log("count",this.editItem.colors_available.length)
        this.cmChart=[];
        this.color=[];
        this.sizeChart=[];
        this.model=[];
      this.product_description = this.editItem.product_description;
      this.product_name = this.editItem.product_name;
      this.status = this.editItem.status;
      // this.color = this.editItem.colors_available;
        for(let i=0;i<this.editItem.colors_available.length;i++)
        {
          // console.log("i = ",i);
          var id=this.editItem.colors_available[i]["id"];
          var name=this.editItem.colors_available[i]["name"];
          var hexvalue=this.editItem.colors_available[i]["hexvalue"];
          var newobj={'color_id':id,'color_name':name,'color_hexvalue':hexvalue};
          // console.log(newobj)
            this.color.push(newobj)
        }
         
      if(this.editItem.sizetype=='cm')
      {
      for (var i = 0; i < this.editItem.price.length; i++) {
          this.cmChart.push(this.editItem.price[i]["'label'"])
        
      }
      }
      if(this.editItem.sizetype=='size')
      {
      for (var i = 0; i < this.editItem.price.length; i++) {
         var label=this.editItem.price[i]["'label'"];
         for(const element of this.sizeList)
        {
         
          if(element.size_label==label)
          {
                this.sizeChart.push(element)
          }
          
        }
      }
      }
      this.available_size = this.editItem.available_size;
      this.price = this.editItem.price;
      this.sizetype = this.editItem.sizetype;
      this.model = {'model_id':this.editItem.model_id,'model_name':this.editItem.model_name,'status':'active'};
       console.log("model=>",this.model)
     this.sizeType=this.editItem.sizetype;
      
      this.tableShow=true;
      this.status = this.editItem.status;
      this.attachedImages = this.editItem.attached_images;
      console.log(this.attachedImages);
      if (this.status == "Created") {
        this.shouldDisable = false;
      } else if (this.status == "Despatched") {
        this.shouldDisable = true;
      }

      this.passFile = [];
      this.preview_list = [];
      this.passFile = [];
      //loop to fetch images from local storage
      for (var i = 0; i < this.attachedImages.length; i++) {
        try {
          let url = require("../../backend/public/uploads/" +
            this.attachedImages[i]);

          //converting image to data url
          const toDataURL = url =>
            fetch(url)
              .then(response => response.blob())
              .then(
                blob =>
                  new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onloadend = () => resolve(reader.result);
                    reader.onerror = reject;
                    reader.readAsDataURL(blob);
                  })
              );
          let imgname = this.attachedImages[i];
          toDataURL(url).then(dataUrl => {
            this.preview_list.push(dataUrl);
            // console.log('name',imgname)
            var fileData = this.dataURLtoFile(dataUrl, imgname);

            this.passFile.push(fileData);
            this.image_list.push(fileData.name);
          });
        } catch (e) {}
      }
      // console.log(this.preview_list)
      this.designation = this.editItem.designation_id;
      this.selectedDesignation = this.editItem.designation_id;
      this.initialGeneratePrice();
    },
    //will be invoked when image orientation changes
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
    // changing url to file data
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
    //invoked when user clicks close or save button
    closeDialog(message) {
      // console.log('emited',message);
      this.$emit("clicked", message);
      this.preview_list = [];
      this.image_list = [];
      this.passFile = [];
    },
    //for fetching department and designation details
    async Details() {
      const response = await this.$axios
        .get(`models`)
        .then(res => {
          var i = 0;

          console.log(res.data.Model_Data.length);
          for (i; i < res.data.Model_Data.length; i++) {
            this.modelList.push(res.data.Model_Data[i]);
          }
        })
        .catch(err => {
          console.log(err);
        });
        this.colorList=[]
 const response2 = await this.$axios
        .get(`colors`)
        .then(res => {
          var i = 0;

          console.log(res.data.Color_Data.length);
          for (i; i < res.data.Color_Data.length; i++) {
            this.colorList.push(res.data.Color_Data[i]);
          }
        })
        .catch(err => {
          console.log(err);
        });
const response3 = await this.$axios
        .get(`size`)
        .then(res => {
          var i = 0;

          console.log(res.data.Size_Data.length);
          for (i; i < res.data.Size_Data.length; i++) {
            this.sizeList.push(res.data.Size_Data[i]);
          }
        })
        .catch(err => {
          console.log(err);
        });

      console.log(this.sizeList);
    },
    //for opening edit dialog box
    editImage(a, b, c, d) {
      // console.log("edit");
      this.imageView = !this.imageView;
      this.propi = a;
      this.name = b;
    },
    //deletes iamage from attachments
    deleteImage(b, c, d) {
      this.preview_list.splice(b, 1);
      this.image_list.splice(b, 1);
      this.passFile.splice(b, 1);
    },
    //when image loads in file input this method will be invoked
    previewMultiImage: function(event) {
      this.dialog = false;

      var count = this.files.length;

      var index = 0;

      if (this.files) {
        while (count--) {
          var reader = new FileReader();
          reader.onload = e => {
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
    //to format date in date-month-year format
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
    //runs when click on submit button
   
    async submit() {
      console.log(this.$refs.form.validate());

      
      if (this.$refs.form.validate()) {
         let data = new FormData();
         
         data.append("product_name", this.product_name);
        data.append("product_description", this.product_description);
        data.append("status", this.status);
       
       
             for (var index = 0; index < this.priceTag.length; index++) {
            data.append(`available_size[${index}]`, this.priceTag[index].label);
            
        }
        for (var index = 0; index < this.color.length; index++) {
            data.append(`available_colors[${index}]`, this.color[index].color_id);
            // data.append(`available_colors[${index}]['name']`, this.color[index].color_name);
            // data.append(`available_colors[${index}]['hexvalue']`, this.color[index].color_hexvalue);
            
        }
        if(this.sizeType=='size')
        {
        for (var index = 0; index < this.priceTag.length; index++) {
            data.append(`pricelist[${index}]['label']`, this.priceTag[index].label);
            data.append(`pricelist[${index}]['price']`, this.priceTag[index].price);
            data.append(`pricelist[${index}]['agegroup']`, this.priceTag[index].agegroup);
            
        }
        }
        else if(this.sizeType=='cm')
        {
          for (var index = 0; index < this.priceTag.length; index++) {
            data.append(`pricelist[${index}]['label']`, this.priceTag[index].label);
            data.append(`pricelist[${index}]['price']`, this.priceTag[index].price); 
         }
        }
        data.append("price", this.priceTag);
       data.append("sizetype", this.sizeType);
        data.append("model_name", this.model.model_name);
        data.append("model_id", this.model.model_id);
        data.append("status", this.status);
        data.append("operation","Update");

        data.append("attached_images", this.attachedImages);
        data.append("removecount", this.attachedImages.length);
        data.append("file_count", this.filecount);
         data.append("id", this.editItem.product_id);
        var files1 = this.passFile;
        var totalfiles = this.passFile.length;

        for (var index = 0; index < totalfiles; index++) {
          data.append("files[]", files1[index]);
        }

        var oldFiles = this.attachedImages;
        var totalAttached = this.attachedImages.length;

        for (var index = 0; index < totalAttached; index++) {
          data.append("oldfiles[]", oldFiles[index]);
        }

                     for (var pair of data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]);
                    }

      
        const response = await this.$axios.post(
          "product/update/" + this.editItem.product_id,
          data,
          {
            headers: {
              "Content-Type": "multipart/form-data"
            }
          }
        );
        console.log(response)
        if (response.status && response.data.status === 201) {
          this.closeDialog("success");
        } else {
          this.closeDialog("failed");
        }
      }
    }
  }
};
</script>

<style>
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
  
  background-color:  #17a2b8 !important;
  border-color:  #17a2b8 !important;
}
#no-background-hover::before {
  background-color: transparent !important;
}
.theme--light.v-btn.v-btn--disabled.v-btn--has-bg {
  background-color: white !important;
  cursor: pointer;
}
</style>
