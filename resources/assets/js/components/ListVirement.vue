<template>
    <div>
        <div class="row">
            <div class="col"><i class="fa fa-arrow-right mr-2"> </i>
                <a class="text-gray-dark" href="" @click.prevent="showFormAddVirement"> Virement </a>
            </div>
        </div>
        <div class="row" v-if="showFormVirement == true">
            <div class="col">
                <form action="">
                    <div class="form-inline ">

                        <label class="mr-4" for="exampleSelect1">Catégorie</label>
                        <select class="form-control fontawesome-select  mr-3" id="exampleSelect1">
                            <option value="icon-home">&#xf015; &nbsp; &nbsp;  Travail</option>
                            <option value="icon-road">&#xf018; &nbsp; &nbsp; rente appartement</option>
                            <option value="icon-road">&#xf018; &nbsp; &nbsp; icon-road</option>
                            <option value="icon-road">&#xf018; &nbsp; &nbsp; icon-road</option>
                            <option value="icon-road">&#xf018; &nbsp; &nbsp; icon-road</option>
                        </select>

                        <label class="mr-4" for="titre">Nom</label>
                        <input type="text" class="form-control mr-4" id="titre">

                        <label class="mr-4" for="somme">Valeur</label>
                        <input type="number" class="form-control mr-4" id="somme">
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary right ">Ajouté</button>
                        </div>

                    </div>


                </form>
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
                showFormVirement:false,
            }
        },
        props:['virement'],
        methods:{
            showFormAddVirement(){
                this.showFormVirement = ! this.showFormVirement;
            },
        },
        mounted() {
            this.data = this.virement;
        }
    }
</script>
