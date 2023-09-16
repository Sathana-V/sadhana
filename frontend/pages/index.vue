<template>
 <v-content class="highlight ma-2 mt-4">
      

   
    <div class="datatable mt-4">
     
      

   
   
         <v-row>
          <v-card class="ml-8">
          <v-col  lg="12" sm="12" md="12" xs="12">
          <v-row>

          

            <v-col lg="4" sm="12" md="12" xs="12">
            <h3>Total Products</h3>
             <v-avatar
                        class="ma-9"
                        color="primary avatar"
                        size="100"
                      >{{productCount}}</v-avatar>
          </v-col>
          <v-col lg="8" sm="12" md="12" xs="12">
            <v-data-table 
                class="ma-7"
    
                 loading-text="Loading... Please wait" 
               :headers="headers" :items="models" :search="search">
                 <template v-slot:top>
      <v-toolbar
        flat>
        <v-toolbar-title>Models</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
          <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="warning"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Add
        </v-btn>
      </template>
     
       
              <AddModel
       
        :currentIns="currentTime"
         @clicked="editDialogClose"
      />
     
    </v-dialog>
      </v-toolbar>
    </template>
                <template v-slot:item.Action="{ item }">
         
      
             
              <v-icon v-if="item.model_status=='active'" color="red" @click="deleteConfirm(item)">mdi-delete</v-icon>
              <p  v-if="item.model_status=='Deleted'">unactive</p>
          </template>
      
        </v-data-table>
          </v-col>
            </v-row>
          </v-col>
        
          
    
       </v-card>
         
         </v-row>
                   

        
       
     
    </div>
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
import AddModel from '~/components/AddModel.vue';
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
          delete_confirmation:false,
      delete_item:null,
        delete_confirmation: false,
        delete_item: null,
        search: "",
        productCount:'',
        icon: "",
        timeout: 2000,
        success_message: "",
        currentTime: "",
        success: false,
        edit: null,
        headers: [
            { text: "SI.No", value: "model_id"},
            { text: "Model Name", value: "model_name" },
            
             { text: "Action", value: "Action" },
             
        ],
        models: [],
    }),
    methods: {
        setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
},
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
 eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
},
        // functions for displaying snackbars when edited
        editDialogClose(status) {
            this.dialog = false;
            if (status == "success") {
               console.log("p succeess")
                this.success = true;
                this.success_message = "Circular Updated successfully";
            }
            else if (status == "failed") {
               console.log("p fail")
                this.success = true;
                this.success_message = "Something went wrong can't Update";
            }
            this.details();
            console.log(this.dialog)
        },
        // functions for displaying snackbars when added
        closeDialog(status) {
            this.dialog = false;
          
            if (status == "success") {
              console.log("p succeess")
                this.success = true;
                this.success_message = "Circular Added Successfully";
            }
            else if (status == "failed") {
              console.log("p fail")
                this.success = true;
                this.success_message = "Something went wrong circular not added";
            }
            console.log(this.dialog)
            this.details();
        },
        //invoking dialog box for ensuring deletion  
        deleteConfirm(item) {
            this.delete_confirmation = true;
            this.delete_item = item;
        },
        //fucntion for deleting record from table(ui)
        async deleteNow() {
            var e = this.delete_item;
            this.delete_confirmation = false;
            const response = await this.$axios.post("models/update/" + e.model_id, { operation: "Delete" });
            console.log(response)
            if (response.status && response.data.status === 201) {
                this.success = true;
                this.success_message = "Deleted Successfully";
                this.details();
            }
            else {
                this.success = true;
                this.success_message = "Something Went wrong try again";
                this.details();
            }
            
        },
        //fucntion for Publishing record 
        async publishNow(e) {
            const response = await this.$axios.put("Circular/" + e.id, { operation: "Publish" });
            if (response.status && response.data.status === 201) {
                this.success = true;
                this.success_message = "Published Successfully";
                this.details();
            }
            else {
                this.success = true;
                this.success_message = "Something Went wrong try again";
                this.details();
            }
        },
        // set edit dialog box to true
        editItem(item) {
            this.edit = item;
            this.editDialog = true;
            this.currentTime = new Date();
        },
       
        // function to fetch records from database
        async details() {
            await this.$axios
                .get("/models")
                .then(res => {
                  console.log('guyioui', res);
                this.models = res.data.Model_Data;
            })
                .catch(err => {
                console.log(err);
            });
             const response2 = await this.$axios.get("/product/count");
             console.log(response2.data['ProductCount'][0])
             this.productCount=response2.data['ProductCount'][0]
        }
    },
    components: { AddModel }
};
</script>
<style>
.v-application a {
  color: white;
  text-decoration: none;
}
.default
{
  background-color:'#A52A2A';
  color:'#A52A2A';
}
.datatable .v-input__slot{
  width:100%;
}

 .v-slide-group__prev {
    margin-right:10px;
    min-width: 10px;
}
   
.v-slide-group__next{
  margin-left:10px;
  min-width: 10px;
}

.v-slide-group__next .v-icon.v-icon, .v-slide-group__prev .v-icon.v-icon {
    /* font-size: 2rem; */
   
    font-size: 35px;
   
    color:white;
    background-color: lightgray;
    border-radius:20px;
   
}
h3 {
margin-left:6%;
}
.v-application .ma-9 {
    margin: 36px !important;
    color: white;
    text-align:center;
    font-size: 30px;
}
</style>
