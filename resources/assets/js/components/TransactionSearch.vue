<template>
    <div class="col">
       <h5>{{data.titre}} </h5>
        <div class="row" v-for="trans in data.data">
            <div class="col">
                <i class="fa fa-credit-card mr-2"></i> {{ trans.name }} -  {{ trans.value }}e le {{ trans.created_at}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
                data:{},
          }
        },
        props:['original'],
        mounted() {
            console.log('transaction')
            this.data = this.original;
        }
    }
</script>
