<template>
   <div class="container w-50 m-5 mx-auto border border-1 bg-light p-4 rounded rounded-1">

      <div v-if="error" class="alert alert-danger text-danger w-100">
                  Username or password Incorrect !
      </div>
      <div class="row">
         <div class="col-md-8 mx-auto">
           
            <h1 class="text-center text-success">Login</h1>
            <!-- login -->
               <div class="form-floating mb-3">
                  <!-- add red border if there is an error  -->
                  <input  type="email" class='form-control' v-model="user.email"  >
                  <label for="email">Email</label>
               
               </div>

               <div class="form-floating mb-3 ">

                  <input  type="password" class='form-control' v-model="user.password"/>
                  <label for="password">Password</label>
                  
               </div>

               <div class="mb-3">

                  <!-- LOGIN -->
                  <button class="btn btn-md btn-success" @click="login" >Log In</button>
                  
               </div>
         </div>
      </div>
</div>
  
</template>

<script>
import routes from '../routes';

export default {
   data(){
      return {
         user : {
            email :"",
            password :"",
         },
         error:false
      }
   },
   methods : {
      login(){

         axios.post('api/login',this.user)
               .then(response=>{
                  if(response.data.status == "success"){
                     let token = response.data.token;
                     localStorage.setItem('token',token);
                     
                     this.error = false;
                  }else{
                     this.error = true;

                     // setTimeout(() => {
                     //    this.error = false;
                     // }, 1500);
                  }
                     
               }).catch(err=>console.log(err));
      }
   }
}
</script>

<style>

</style>