<template>
    <div >
        <calendar></calendar>
    </div>
</template>

<script>
    export default {
        components:{Date},
        data(){
            return{
                session:'',
                events:[],
                transaction:{},
                solde:0,
            }
        },
        mounted() {

        },
        methods:{

            getMovement(date){
                axios.get('/home/movement/'+date).then( response =>{
                    this.transaction = response.data.transaction;
                    this.session = response.data.session;
                });
            }
        }
    }
</script>
