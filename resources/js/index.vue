<template>
  <div>

      <nav class="navbar bg-white border-bottom navbar-light">
         
          <router-link class="navbar-brand mr-auto" :to="{name: 'home'}">Project2</router-link> <!--  Here we use the routes name -->
          <router-link class="btn nav-button btn-outline-primary" :to="{name: 'second'}">second</router-link>
      
      </nav>

  <div class="container mt-4 mb-4 pr-4 pl-4">
        <router-view></router-view>
  </div>

    
  </div>
</template>

