<template>
  <div class="row">
      <div class="cell-lg-6 p-10">
          <h1 class="center-text">Form</h1>
        <div class="form-group">
            <label>Title </label>
            <input v-model="title" type="text" placeholder="Enter Title"/>
        </div>
        <div class="form-group">
            <label>Link </label>
            <input v-model="link" type="text" placeholder="Enter Link"/>
        </div>
         <div class="form-group">
            <button @click="post" class="button success">Submit data</button>
        </div>
      </div>
      <div class="cell-lg-6">
          <h1 class="center-text">Table</h1>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                        <tr v-for="movie in movies" :key="movie.id">
                            <td>{{movie.id}}</td>
                            <td>{{movie.title}}</td>
                            <td>{{movie.link}}</td>
                            <td>
                                <button @click="getOne(movie.id)" class="button success outline"><span class="mif-pencil mif-lg fg-green"></span></button>
                            </td>
                            <td>
                                <button onclick="return confirm('Are you sure ?')" @click="deleteOne(movie.id)" class="button alert outline"><span class="mif-bin mif-lg fg-red"></span></button>
                            </td>

                        </tr>

                </tbody>
            </table>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'app',
  data:()=>({
      id:0,
      title:'',
      link:'',
      movies:[]
  }),
  mounted(){
      this.getAll();
  },
  methods:{
      getAll(){
          axios.get(`http://127.0.0.1:8000/api`)
          .then((res)=>
          this.movies = res.data
          )
      },
    getOne(id){
          axios.get(`http://127.0.0.1:8000/api/${id}`)
          .then((res)=>{
            this.id = res.data.id;
            this.title = res.data.title;
            this.link = res.data.link;
          }

          )
      },
         deleteOne(id){
          axios.delete(`http://127.0.0.1:8000/api/${id}`)
          .then(()=>{
            this.getAll();
          })
         }
          ,
         editOne(id){
            axios.put(`http://127.0.0.1:8000/api/${id}`,{title:this.title,link:this.link})
          .then(()=>{
            this.getAll();
          })
         }
         ,
         post(){
             if(this.id == 0){
                    axios.post(`http://127.0.0.1:8000/api`,{title:this.title,link:this.link})
                            .then(()=>{
                                this.getAll();
                            })
             }else{
                 this.editOne(this.id);
             }
                    this.id=0;
                    this.title='';
                    this.link='';

         }
  }
}
</script>

<style>

</style>
