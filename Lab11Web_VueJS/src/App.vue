<script>

export default {


data(){

return{

isLogin: localStorage.getItem('login')

}

},


methods:{


logout(){

localStorage.removeItem('token')

localStorage.removeItem('login')


this.isLogin = false


this.$router.push('/login')


},


loginBerhasil(){


this.isLogin = true


this.$router.push('/')


}


},


mounted(){


this.isLogin = localStorage.getItem('login')


}


}

</script>



<template>


<div>


<!-- NAVBAR HANYA JIKA LOGIN -->

<nav 
v-if="isLogin"
class="nav-menu"
>


<router-link to="/">
Beranda
</router-link>


<router-link to="/artikel">
Kelola Artikel
</router-link>


<router-link to="/about">
About
</router-link>



<button @click="logout">

Logout

</button>


</nav>



<router-view
@login="loginBerhasil"
/>


</div>


</template>