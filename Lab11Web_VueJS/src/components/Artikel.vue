<script>

import axios from 'axios'


export default {


data(){

return{

artikel: [],

judul: '',

isi: '',

editId: null,

showForm:false

}

},



mounted(){

this.loadData()

},



methods:{



api(){


return axios.create({

baseURL:'http://localhost:8080',

headers:{

Authorization:
'Bearer ' + localStorage.getItem('token')

}

})


},





loadData(){


axios.get(
'http://localhost:8080/post'
)


.then(res=>{


this.artikel = res.data.artikel


})


.catch(err=>{

console.log(err)

})


},





simpan(){


let api = this.api()



// EDIT

if(this.editId){


api.put(

'/post/' + this.editId,

{

judul:this.judul,

isi:this.isi

}

)


.then(()=>{


alert('Artikel berhasil diubah')


this.loadData()

this.reset()


})



}



// TAMBAH

else{


api.post(

'/post',

{

judul:this.judul,

isi:this.isi

}

)



.then(()=>{


alert('Artikel berhasil ditambahkan')


this.loadData()

this.reset()


})



}



},






edit(item){


this.editId = item.id

this.judul = item.judul

this.isi = item.isi


this.showForm = true


},





hapus(id){


if(confirm('Yakin ingin menghapus artikel?'))

{


let api=this.api()



api.delete(

'/post/'+id

)



.then(()=>{


alert('Artikel berhasil dihapus')


this.loadData()


})


.catch(err=>{

console.log(err)

})


}


},






reset(){


this.judul=''

this.isi=''

this.editId=null

this.showForm=false


}



}



}

</script>



<template>


<div class="container">



<!-- HEADER -->

<div class="card">


<h2>
Kelola Artikel
</h2>



<button

v-if="!showForm"

@click="showForm=true"

>

+ Tambah Artikel

</button>



</div>





<!-- FORM -->

<div 
class="card"

v-if="showForm"

>


<h3>

{{ editId ? 'Edit Artikel' : 'Tambah Artikel' }}

</h3>



<input

v-model="judul"

placeholder="Judul Artikel"

/>



<textarea

v-model="isi"

rows="5"

placeholder="Isi Artikel"

></textarea>




<button

@click="simpan"

>

{{editId ? 'Update' : 'Simpan'}}

</button>



<button

@click="reset"

>

Batal

</button>



</div>







<!-- LIST ARTIKEL -->

<div class="card">


<h2>
Daftar Artikel
</h2>



<table>


<thead>

<tr>

<th>ID</th>

<th>Judul</th>

<th>Isi</th>

<th>Aksi</th>


</tr>


</thead>




<tbody>


<tr

v-for="item in artikel"

:key="item.id"

>


<td>

{{item.id}}

</td>



<td>

{{item.judul}}

</td>



<td>

{{item.isi}}

</td>



<td>



<button

@click="edit(item)"

>

Edit

</button>




<button

@click="hapus(item.id)"

>

Hapus

</button>



</td>



</tr>



</tbody>


</table>



</div>




</div>



</template>