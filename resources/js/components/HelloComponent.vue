<template>
    <div>
        <p>hello component</p>
        <li v-for ="user in users" :key="user.name">{{ user.name }}</li>
    </div>
</template>

<script>
// import axios from "axios"; 

    export default {
        data() {
            return{
                users: []
            };
        },
        created(){
         //表示後にやりたいことはここに書ける
        //  this.sayHello();
         axios.get('/users')
         .then(responce => this.users = responce.data)
         .catch(error => {
            console.info(error);
            });
        //  console.log(this.users);
      }
        // mounted() {
        //     console.log('Component mounted.');
        // }
    };
</script>