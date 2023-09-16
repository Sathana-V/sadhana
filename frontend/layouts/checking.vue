<template>
 <v-app>


    <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      fixed
      app
      class="navigationbar"
      dark
    >
       <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-h6">
          <v-list-item-avatar>
            <v-icon>mdi-school</v-icon>
          </v-list-item-avatar> Admin
          </v-list-item-title>
          <!-- <v-list-item-subtitle>
           sathana
          </v-list-item-subtitle> -->
        </v-list-item-content>
     
         </v-list-item>
        
      <v-divider></v-divider>
     <v-list dark>
       <div  v-for="(link, i) in links" 
            :key="i">
      <v-list-item  v-if="!link.subLinks" link :to="link.to">
        <v-list-item-icon>
          <v-icon>{{link.icon}}</v-icon>
        </v-list-item-icon>

        <v-list-item-title>{{link.text}}</v-list-item-title>
      </v-list-item>

     
        <v-list-group v-else
           :prepend-icon="link.icon"
           
           dark
           class="white--text"
        >
          <template v-slot:activator>
            <v-list-item-content class="white--text">
              <v-list-item-title>{{link.text}}</v-list-item-title>
            </v-list-item-content>
          </template>

          <v-list-item
             v-for="sublink in link.subLinks"
                     :key="sublink.text"
            dark
            class="white--text"
                    :to="sublink.to"
            link
            
          >
           <v-list-item-icon>
              <v-icon class="padding" >{{sublink.icon}}</v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{sublink.text}}</v-list-item-title>

           
          </v-list-item>
        </v-list-group> 
        </div>
    </v-list>
    </v-navigation-drawer>
    
    <v-app-bar
      light
      color="white"
      :clipped-left="clipped"
      fixed
      app
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title v-text="title" />
      <v-spacer />
   <v-spacer></v-spacer>

      <v-btn light icon>
        <v-icon>mdi-mail</v-icon>
      </v-btn>

      <v-btn light icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>

    
      <v-menu
      light
        bottom
        left
      >
        <template #activator="{ on, attrs }">
          <v-btn
            light
            icon
            v-bind="attrs"
            v-on="on"
          >
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>
    
        <v-list>
          <v-list-item
            v-for="(item, i) in menu"
            :key="i"
            :href="item.href"
          >
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
     <Nuxt />
    <v-navigation-drawer
      v-model="rightDrawer"
      :right="right"
      temporary
      fixed
    >
      <v-list>
        <v-list-item @click.native="right = !right">
          <v-list-item-action>
            <v-icon light>
              mdi-repeat
            </v-icon>
          </v-list-item-action>
          <v-list-item-title>Switch drawer (click me)</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </v-app>
</template>

<script>

export default {
  layout: 'dashboard',
 data () {
    return {
      clipped: false,
      drawer: true,
      fixed: false,
       miniVariant: false,
      right: true,
      rightDrawer: false,
      title: 'SADHANA GARMENTS',
        menu: [
        {
          icon: 'fullscreen_exit',
          href: '/login',
          title: 'Logout'
        }
      ],
      links: [
    {
        to     : '/',
        icon   : 'mdi-view-dashboard',
        text   : 'Dashboard',
    },
  
    // {
    //     icon     : 'mdi-account-tie',
    //     text     : 'Employee',
    //     subLinks : [
    //         {
    //              icon     : 'mdi-account-plus',
    //             text : 'Add new',
    //             to    : '/AddEmployee',
    //         },
    //         {
    //              icon     : 'mdi-database-eye-outline',
    //             text : 'view details',
    //             to    : '/Employee',
    //         },
    //     ]
    // },
    
    {
        to     : '/products',
        icon   :  'mdi-palette-swatch',
        text   : 'Product',
    },
     {
        to     : '/colors',
        icon   : 'mdi-palette',
        text   : 'Colors',
    },
    
],
  }
  }
}
</script>
<style scoped>
.padding
{
  padding-left: 30px;
 
}
 
.v-list .v-list-item--active {
    color: white;
}

.v-list{
  color:white;
}
.v-list-group--active,.v-list-item--active,.v-list-item
{
   color: white;
  background: linear-gradient(145deg, #00b5ad, #17a2b8);
}
.navigationbar
{
  background: linear-gradient(145deg, #00b5ad, #17a2b8);
}


</style>
<style >
.v-toolbar__title .textcolor{
   color:#ec4d4d;
 }
</style>
