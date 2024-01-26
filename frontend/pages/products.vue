<template>
 
 <v-content class="highlight ma-2 mt-4">
      

   
    <div class="datatable mt-4">
     
      <v-card>
        <v-row>
        <v-col lg="4" sm="4" md="4" cols="12">
           <v-text-field
          class="ml-4 pa-4"
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
           single-line
            hide-details
          >  
          </v-text-field>
        </v-col>
      </v-row>
             <v-data-table 
   
    
                 loading-text="Loading... Please wait" 
               :headers="headers" :items="products" :search="search">
                 <template v-slot:top>
      <v-toolbar
        flat>
        <v-toolbar-title>Products</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
          <v-dialog
      v-model="dialog"
      persistent
      max-width="1200px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="warning"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Add Product
        </v-btn>
      </template>
     
       
               <AddProduct @clicked="closeDialog"/>
      
     
    </v-dialog>
      </v-toolbar>
    </template>
               
          <template v-slot:item.SINo="{ index }">
            {{ index + 1 }} </template
          > <template v-slot:item.GivenBy="{ index }">
            Principal </template
          >
          <template v-slot:item.state="{ item }">
            <v-btn
              elevation="2"
              x-small
             v-if="item.status=='Created'"
              class="blue"
              dark
              @click="publishNow(item)"
            >
              Publish</v-btn
            >
             <v-btn
              elevation="2"
              x-small
             v-if="item.status=='Despatched'"
              class="danger"
              dark
             
              @click="unpublishNow(item)"
            >
              Un Publish</v-btn
            >
          </template>
          
          <template v-slot:item.available_colors="{ item }">
           
             <span
                    v-for="(item, index) in item.colors_available"
                     :key="index"
                  >
                     <v-avatar
                        class="ma-1"
                        :style="{ background: item[`hexvalue`] }"
                        size="30"
                      ></v-avatar>
              
            </span>
            

          </template>
           <template v-slot:item.price="{ item }">
            <span
                    v-for="(item, index) in item.price"
                     :key="index"
                  >
                  [ {{item["'label'"]}} - {{item["'price'"]}} ]
              
            </span>
           
           </template>
          <template v-slot:item.Action="{ item }">
         
                    <v-icon v-if="item.status=='Created'" color="primary" @click="editItem(item)">mdi-pencil</v-icon>
           
                    <v-icon v-if="item.status=='Despatched'" color="green" @click="editItem(item)">mdi-eye</v-icon>
           
             
              <v-icon color="red" @click="deleteConfirm(item)">mdi-delete</v-icon>
          </template>
        </v-data-table>
      </v-card>
    </div>
       
        <v-dialog
      v-model="editDialog"
      persistent
      max-width="1200px"
    >
    
       
               <EditProduct :editItem="edit" :currentIns="currentTime" @clicked="editDialogClose"/>
      
     
    </v-dialog>
    
     <v-snackbar
      v-model="success"
      :timeout="timeout"
    >
      {{success_message}}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="blue"
          text
          v-bind="attrs"
          @click="success = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
      
  <v-dialog
      v-model="delete_confirmation"
      width="400"
    >

      <v-card>
        <v-card-title class="text-subheading-1 background white--text" dark>
        Are you sure do you need to delete ?
        </v-card-title>


        <v-divider></v-divider>

        <v-card-actions>
          <v-btn
            color="green"
            text
            @click="deleteNow"
          >
            Yes
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="delete_confirmation = false"
          >
           No
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  
  </v-content>
  
</template>

<script>
export default {
   layout:'dashboard',
      beforeMount(){
        var cook=this.getCookie("username");
        if(cook==null)
                   {
                     console.log("empty")
                        window.location.href = "https://sadhanagarments-admin.netlify.app/loginform"
                     
                     
                   }
      },
mounted() {
    this.details();
   
  },
 
  data :vm => ({
      dialog: false,
      editDialog:false,
      delete_confirmation:false,
      delete_item:null,
      search: "",
      icon:'',
      timeout: 2000,
      success_message:'',
      currentTime:'',
      colorsList:[],
      success:false,
      edit:null,
      headers: [
        { text: "SI.No", value: "SINo",sortable: false},
          { text: "Model Name", value: "model_name" ,width:100},
        { text: "Product Name", value: "product_name" ,width:100},
        { text: "Product Description", value: "product_description" ,width:200},
        { text: "Available size", value: "available_size" ,width:100},
        { text: "Available Colors", value: "available_colors" ,width:300},
        { text: "Prices", value: "price" ,width:200},
        { text: "Status", value: "status" ,width:70},
        { text: "State", value: "state" ,width:70},
        { text: "Action", value: "Action", sortable: false }
      ],
      products: [],
      
    }),

  
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
    // functions for displaying snackbars when edited
    editDialogClose(status)
    {
      
       this.editDialog=false
        if(status=='success')
       {
          this.success=true;
          this.success_message="product Updated successfully";
       }
       else if(status=='failed')
       {
          this.success=true;
          this.success_message="Something went wrong can't Update";
       }
       this.details()
    },
     // functions for displaying snackbars when added
    closeDialog(status)
    {
        this.dialog=false
       if(status=='success')
       {
          this.success=true;
          this.success_message="product Added Successfully";
       }
       else if(status=='failed')
       {
          this.success=true;
          this.success_message="Something went wrong product not added";
       }
        this.details()
    },
    //invoking dialog box for ensuring deletion  
    deleteConfirm(item)
    {
       this.delete_confirmation=true
       this.delete_item=item
    },
    //fucntion for deleting record from table(ui)
    async deleteNow(){
         var e=this.delete_item
        this.delete_confirmation=false
        const response=await this.$axios.post("product/update/"+e.product_id,{operation:'Delete'})
    
       if(response.status&&response.data.status===201)
       {
           this.success=true;
           this.success_message='Deleted Successfully';    
           this.details();
       }
       else
       {
         this.success=true;
           this.success_message="Something Went wrong try again";    
           this.details();
       }
       
       
    },
     //fucntion for Publishing record 
    async publishNow(e) {
     
      const response=await this.$axios.post("product/update/"+e.product_id,{operation:'Publish'})
      console.log(response)
       if(response.status&&response.data.status===201)
       {
           this.success=true;
           this.success_message='Published Successfully';   
           this.details()
       }  
       else
       {
         this.success=true;
           this.success_message="Something Went wrong try again";    
           this.details();
       }
    },
    async unpublishNow(e) {
     
      const response=await this.$axios.post("product/update/"+e.product_id,{operation:'unPublish'})
      console.log(response)
       if(response.status&&response.data.status===201)
       {
           this.success=true;
           this.success_message='Published Successfully';   
           this.details()
       }  
       else
       {
         this.success=true;
           this.success_message="Something Went wrong try again";    
           this.details();
       }
    },
    // set edit dialog box to true
    editItem(item)
    {
     
      this.edit=item
      this.editDialog=true
      this.currentTime=new Date();
    },
    getColor(item)
    {
       const testJSON = JSON.parse(JSON.stringify(item));
      console.log(testJSON)
      return testJSON
      
      
    },
    // function to fetch records from database
    async details() {
      await this.$axios
        .get("/Product")
        .then(res => {
          this.products = res.data.Product_Data;
          console.log(this.products)
         
         
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};

</script>

<style>

</style>