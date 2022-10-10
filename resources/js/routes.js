import LoginComponent from './components/LoginComponent.vue';
import RegisterComponent from './components/RegisterComponent.vue';
import PostComponent from './components/PostComponent.vue';

const routes = [
    {
      path:'/login',
      name:'login',
      component:LoginComponent,
    },
    {
      path:'/register',
      name:'register',
  
      component:RegisterComponent,
    },
    {
      path:'/post',
      name:'post',
      component:PostComponent,
    },
    
  ]
  

export default routes
