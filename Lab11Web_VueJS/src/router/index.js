import {createRouter, createWebHistory} from 'vue-router'


import Home from '../components/Home.vue'

import About from '../components/About.vue'

import Artikel from '../components/Artikel.vue'

import Login from '../components/Login.vue'



const router=createRouter({

history:createWebHistory(),


routes:[


{
path:'/',
component:Home
},


{
path:'/about',
component:About
},


{
path:'/artikel',
component:Artikel
},


{
path:'/login',
component:Login
}


]


})


export default router