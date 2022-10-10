<template>

<div>

<nav class="navbar navbar-expand-lg py-3 navbar-light bg-light">
  <a class="navbar-brand mx-4 " href="/">Med Blog </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse mx-5 " id="navbarNav">
    <ul class="navbar-nav ms-auto  ">
      <li class="nav-item active">
        <router-link to="/login" class="text-dark mx-2" style="text-decoration:none;">Login  </router-link>

      </li>
      <li class="nav-item">
        <router-link to="/register" class="text-dark mx-2" style="text-decoration:none;">Register</router-link>
      </li>

      
        <li class="nav-item  ">
          <router-link to="/post" class="btn btn-dark btn-sm ml-1">Make Post</router-link>
        </li>
        <li class="nav-item  ">
          <button class="btn btn-secondary btn-sm mx-2 text-white" @click="logout">Log Out</button>
        </li>

     
     
    </ul>
  </div>
 
</nav>

</div>
</template>

<script >

export default {
  data(){
    return {

    }
  },
  methods : {
    logout(){
      let token = localStorage.getItem('token');
        axios.post('api/logout?token='+token)
        .then(response => {
           localStorage.setItem('token','');
        });
    }
  }
}
</script>