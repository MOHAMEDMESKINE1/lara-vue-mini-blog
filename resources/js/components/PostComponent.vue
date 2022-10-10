<template>
  <div>
   
  <!-- Button trigger modal -->
  <div class="my-5">
    <button type="button" class="btn btn-info text-white shadow float-end mb-5 mx-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">
    New Post
  </button>
  </div>
 <!-- Button trigger modal -->

<!-- Posts Lists -->
<div class="container my-5 ">
    <div class="row ">
        <!-- <div class="col-md-6 col-xs-3 col-sm-6" v-for="post in posts.data" :key="post.id" > -->
        <div class="col-md-6 col-xs-3 col-sm-6" v-for="post in posts" :key="post.id" >
            <div class="card p-3 mb-2 shadow" >
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center w-100">
                            <div class="card-header w-100">
                                <h3>{{post.title}}</h3>
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-lead">
                            {{post.body}}
                        </p>                    
                    </div>
                    <div>
                        <!-- edit Post -->
                        <button 
                        type="button" 
                        class="btn btn-primary my-2 mr-4 " 
                        data-bs-toggle="modal" 
                        data-bs-target="#exampleModal"
                        @click="editPost(post)"
                        >
                            Edit Post
                        </button>
                        <!-- delete Post -->
                        <button 
                        type="button" 
                        class="btn btn-danger my-2 mr-4 " 
                        @click="deletePost(post.id)"
                        >
                            Delete Post
                        </button>
                    </div>
            </div>
        </div>
    </div>  
    <!--pagination  -->
    <!-- <pagination :data="posts" @pagination-change-page="getPosts"></pagination> -->
</div> 
<!-- Posts Lists -->

<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" v-if="edit" id="exampleModalLabel">  Update  Post </h5>
          <h5 class="modal-title" v-else id="exampleModalLabel">  Create a Post </h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <!-- added alert -->
            <div v-if="success" class=" my-1  alert alert-success text-success" role="alert">
                   Post has been created successfully <i class=" mx-5 fas fa-check"></i>
            </div>
            <!-- updated alert -->
            <div v-if="update" class=" my-1  alert alert-success text-success" role="alert">
                   Post has been updated successfully <i class=" mx-5 fas fa-check"></i>
            </div>
            <!-- form  -->
                <form >


                    <div class="form-floating mb-3">
                        <!-- add red border if there is an error  -->
                        <input  type="text" :class="['form-control', errors.title ? 'is-invalid' : '' ]" v-model="post.title" id="title" placeholder="name@example.com">
                        <label for="title">Title</label>
                        <!-- display errors -->
                        <small v-if="errors.title " class="text-danger fw-bold">
                            {{errors.title[0]}}
                        </small>
                    </div>

                    <div class="form-floating mb-3 ">

                        <textarea :class="['form-control', errors.body ? 'is-invalid' : '' ]"  v-model="post.body" placeholder="Leave a comment here" id="body" style="height: 100px;"></textarea>
                        <label for="body">Body </label>
                        <!-- display errors -->
                        <small v-if="errors.body " class="text-danger fw-bold">
                            {{errors.body[0]}}
                        </small>
                    </div>

                    <div class="mb-3">

                        <!-- update -->
                        <button type="submit" v-if="edit" class="btn btn-md btn-success" @click.prevent="updatePost" >Update</button>
                       
                        <!-- create -->
                        <button type="submit" v-else class="btn btn-md btn-success" @click.prevent="createPost">Create</button>
                       
                        <!-- close -->
                        <button type="button" class="btn btn-md btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </form>
        </div>
       
      </div>
    </div>
  </div>
<!-- Modal -->

</div>
</template>

<script>

export default {
    
    data(){
        return {
            posts: {},
            post : {
                id:'',
                title:'',
                body:'',
            },
            success:false,
            update:false,
            errors : [],
            edit:false,
           
          
        }
    },
    created (){

        this.getPosts();

    },  
    methods : {

        // getPosts(page=1){

        //     axios.get('api/posts?page='+page)
        //     .then(response=>this.posts = response.data)
        //     .catch(err=>console.log(err))
        
        // },
        getPosts(){

            axios.get('api/posts')
            .then(response=>this.posts = response.data)
            .catch(err=>console.log(err))
        
        },
        editPost(post){
            
            this.post = post
            this.edit=true
           
        },
        updatePost(){
            let token = localStorage.getItem('token')

          
                axios.put('api/updatepost/'+this.post.id +'?token='+token,this.post)
            .then(response =>{

       
            if(response.data.status == "error"){

                this.errors = response.data.errors ; 
                console.log(response.data.message);
            
            }else if(response.data.status == "success"){
                
                    // Toast.fire({
                    // icon: 'success',
                    // title: 'created  successfully'
                    // })
                    this.update = true;
                    setTimeout(() => {
                        this.update = false;
                    }, 2000);
                    // clear errors after submit

                   this.refresh();
                }
            })

            
          
        }
        ,
        deletePost(id){
            try {
                let token = localStorage.getItem('token')
                Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'

                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                            'Deleted!',
                            'Your post has been deleted.',
                            'success'
                            )

                            axios.delete('api/posts/'+id +'?token='+ token)
                            .then(response =>{

                    
                            if(response.data.status == "error"){

                                this.errors = response.data.errors ; 
                               
                            }else if(response.data.status == "success"){
                               
                                this.refresh();
                               
                            }
                            })
                        }
                    })
            } catch (error) {
                    console.log(error.message);
            }
        },
        createPost(){

            // secure routes 
            let token = localStorage.getItem('token')

            axios.post('api/createpost?token='+token,this.post)
            .then(response =>{

                // hide update button
                this.edit=false;
               

                if(response.data.status == "error"){

                    this.errors = response.data.errors ; 
                
                }else if(response.data.status == "success"){
                     
                        // Toast.fire({
                        // icon: 'success',
                        // title: 'created  successfully'
                        // })
                        this.success = true;
                        setTimeout(() => {
                            this.success = false;
                        }, 2000);
                 
                        
                        this.refresh();
                }
            })
  
        },
        refresh(){

              // clear errors after submit
                this.erros = []  

                this.post =  {
                    title:'',
                    body:''
                }

                this.getPosts();

        }
    },
   
}
</script>

<style>

</style>