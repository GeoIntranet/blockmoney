<template>
    <div>
         <div class="row">
             <div class="col">
                 <i class="fa fa-user-circle mr-2"> </i> Général
             </div>
         </div>
        <div class="row ">
            <div class="col">
                Compte
                : {{data.description}}
            </div>
            <div class="col">
              Description : {{data.nom}}
            </div>

            <div class="col" v-if="hasSolde">
               Solde :
                <span class="b text-success" v-if="money.value > 0"> {{money.value}} e </span>
                <span class="b text-danger" v-else> {{money.value}} e  </span>
            </div>

            <div class="col" v-else>
                Solde :
                <span class="b text-danger">non renseigné</span>
            </div>

        </div>
        <hr>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                data: {},
                money: {},
                hasSolde: false,
            }
        },
        props: ['account','solde'],
        mounted() {
            this.data = this.account;
            this.hasSolde = this.solde.length > 0 ? true : false;
            this.money = this.solde[0];
        }
    }
</script>
