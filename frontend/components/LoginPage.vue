<template>
   <v-app>
      <v-content>
         <v-container fluid fill-height>
            <v-layout align-center justify-center>
               <v-flex xs12 sm8 md4>
                  <v-card class="elevation-12">
                     <v-toolbar dark color="primary">
                        <v-toolbar-title>Admin Dashboard</v-toolbar-title>
                     </v-toolbar>
                     <v-card-text>
                        <v-form ref="form" v-model="valid" lazy-validation>
                           <v-text-field
                              
                              name="email"
                              label="Email"
                                v-model="email"
                                :rules="emailRules"
                              type="text"
                           ></v-text-field>
                           <v-text-field
                              id="password"
                             
                              name="password"
                              label="Password"
                                v-model="password"
                                :rules="passwordRules" 
                              type="password"
                           ></v-text-field>
                            <p class="error-text">{{error}}</p>
                        </v-form>
                     </v-card-text>
                     <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" @click="submit">Login</v-btn>
                     </v-card-actions>
                  </v-card>
               </v-flex>
            </v-layout>
         </v-container>
      </v-content>
   </v-app>
</template>

<script>
export default {
   name: 'Login',
   props: {
      
   },
   data: () => ({
   password: '',
   passwordRules: [(v) => !!v || ''],
     email: '',
    emailRules: [(v) => !!v || ''],
     valid: false,
   }),
   methods:{
       async submit() {
     
      // console.log(this.$refs.form.validate());
      console.log('submited')
      if (this.$refs.form.validate()) {
        let data = new FormData()
        data.append('email', this.email)
        data.append('password', this.password)
      
        for (var pair of data.entries()) {
          console.log(pair[0] + ', ' + pair[1])
        }
        const response = await this.$axios.post(
            "admin/validate",
            data,
            {
              headers: {
                "Content-Type": "multipart/form-data"
              }
            }
          );
          if(response.status&&response.data.status===201)
       {
             
           this.$refs.form.reset();
            console.log(response.data.login_data[0].countl)
            if(parseInt(response.data.login_data[0].countl)>0)
            {
                console.log("true")
                 this.error=" "
                window.location.href = "https://mypitch.xyz/public/employee"
            }
            else{
                 console.log("False");
                 this.error="Invalid Credentials"
            }
       }  
       else
       {
         
           console.log(response)
      }
      }
    },
   }
};
</script>

<style>
.error-text{
  color:red;
}
</style>
