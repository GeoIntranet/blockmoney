<template>
    <transition name="fade">
        <div class="alert alert-warning" role="alert" v-if="isShow">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3><i class="fa fa-star mr-2"> </i><strong> Bien joué !</strong> Ton compte est <b>actif</b> !</h3>
        </div>
    </transition>

</template>

<script>
    export default {
        data(){
          return{
              show:false,
              status:false,
          }
        },
        // props STATE = bool = false => 0 | true => 1 ---------------------
        props:{
            state:{
                number: Boolean
            }
        },
        computed:{
            isShow(){
                return this.show;
            },
        },
        methods:{
            close(){
                this.show = false;
            },
        },
        mounted() {

            this.status = this.state === 1 ? true : false;

            Event.$on('isActiveUser', (status)=>{

                if( (this.status === false) && (status === true )){
                    this.show = true;
                }
                this.status = status;
            });

            Event.$on('removeAccount', (data) =>{
                this.status = data.status;
                if(data.status === false) this.show = false;
            });
        }
    }
</script>
