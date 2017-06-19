<template>
    <div class="alert alert-warning" role="alert" v-if="isActif">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-star mr-2"> </i><strong> Bien joué !</strong> Ton compte est <b>actif</b> !</h3>
    </div>
</template>

<script>
    export default {
        data(){
          return{
              status:false,
          }
        },
        props:{
            state:{
                number: Boolean
            }
        },
        computed:{
            isActif(){
                return this.status;
            },

        },
        mounted() {

            Event.$on('userAccountActive', (status)=>{
                this.status = status;
            });
        }
    }
</script>
