<template>
  <v-content class="highlight">
    <v-container class="ma-5 mt-0">
      <v-container>
       <v-card
  elevation="9"
  width="50%"
  
>
<v-card-title background-color="deep-purple accent-4">
    Login
</v-card-title>
<v-card-text>
    <v-col
          cols="12"
          sm="6"
          md="4"
          lg="12"
        >
          <v-text-field
            dense
            label="Username"
          ></v-text-field>
        </v-col>

         <v-col
          cols="12"
          sm="6"
          md="4"
           lg="12"
        >
          <v-text-field
            dense
            label="Password"
          ></v-text-field>
        </v-col>
</v-card-text>
</v-card>
      </v-container>
    </v-container>
  </v-content>
</template>

<script>
export default {

  mounted() {
   
  },
  data: () => ({
    
  }),
  
}
</script>

<style>
.highlight {
  background-color: rgba(255, 255, 255, 0.26);
}

.background {
  background: linear-gradient(145deg, #00b5ad, #17a2b8);
  color: white;
}
.marginTop {
  margin-top: 13%;
  margin-bottom: 10%;
}
.border {
  border: 2px solid black;
  height: 200px;
}
.moveright
{
  margin-right:-1%;
}
.firstrow {
  height: 120px;
}

.buttons {
  box-shadow: none;
  background: none;
}
.darkgrey
{
  background: rgb(50, 54, 57);
}
</style>
