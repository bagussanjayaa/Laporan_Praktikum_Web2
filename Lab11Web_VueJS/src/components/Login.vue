<script>

import axios from 'axios'


export default {


data(){

return{

username:'',
password:''

}


},


methods:{


login(){


axios.post(
'http://localhost:8080/api/login',
{
 useremail:this.username,
 userpassword:this.password
},
{
 headers:{
   'Content-Type':'application/json'
 }
}
)

.then(res=>{


localStorage.setItem(
'token',
res.data.data.token
)


localStorage.setItem(
'login',
'true'
)


alert('Login berhasil')


this.$emit('login')


})


.catch(()=>{


alert('Login gagal')


})


}


}


}

</script>



<template>


<div class="login">


<h2>Login</h2>


<input
v-model="username"
placeholder="Email"
/>


<br>


<input
type="password"
v-model="password"
placeholder="Password"
/>


<br>


<button @click="login">

Login

</button>


</div>


</template>