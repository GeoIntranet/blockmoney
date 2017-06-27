<template>
    <div>
        <div class="row">
            <div class="col"><i class="fa fa-arrow-right mr-2"> </i>
                <a class="text-gray-dark" href=""> Virement </a>
            </div>
        </div>

        <div class="row pl-4" v-for="prelevement in this.data">
            <div class="col -3">
                <i class="fa fa-home mr-2">
                </i>{{prelevement.name}}  <b class="text-success">+{{prelevement.value}} e </b>  &ndash;  tous les 28 du mois &ndash;
            </div>
        </div>
        <hr>
    </div>

</template>

<script>
    export default {
        data(){
            return{
                data:{},
            }
        },
        props:['virement'],
        mounted() {
            this.data = this.virement;
        }
    }
</script>
