<template>

<div class="container my-5 p-2 w-50 order border-1 rounded rounded-1 " style="background-color:#fff;">
    <div class="row">
        <div class="col-md-8 mx-auto p-2">
            
            <form  @submit.prevent="register">

                <h2 class="text-center text-primary ">Register User</h2>

                <div class="form-group w-50 mx-auto mb-3">
                    <label  for="name">Name:</label>
                    <input  type="text" class='form-control' v-model="user.name"  required id="name" placeholder="Enter name">
                   
                  
                </div>

                <div class="form-group w-50 mx-auto mb-3">
                    <label   for="email">Email:</label>
                    <input  type="email" class="form-control" v-model="user.email"  required id="email" placeholder="Enter email">
                    
                </div>

                <div class="form-group w-50 mx-auto mb-3">
                    <label   for="pwd">Password:</label>
                    <input  type="password" class="form-control" v-model="user.password"  required id="pwd" placeholder="Enter password">
                   
                </div>

                <div class="form-group w-50 mx-auto mb-3 my-2">
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            user : {
                name:'',
                email:'',
                password:'',
                // passwordConfirm:'',
            },
            errors : [],
       
        }
    },
    methods : {

        register(){

            axios.post('api/register',this.user)
            .then(response =>{
                if(response.data.status == "error"){

                    this.errors = response.data.errors;

                }else if(response.data.status == "success"){

                     Toast.fire({
                        icon: 'success',
                        title: 'user registred  successfully'
                        })
                    // clear fields 
                    this.errors = []  
                    this.user =  {
                        name:'',
                        email:'',
                        password:''
                    }
                }
            })
           
        }
    }
}
</script>

<style>

</style>