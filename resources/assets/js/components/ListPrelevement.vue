<template>
    <div>
        <div class="row">
            <div class="col"><i class="fa fa-arrow-right mr-2"> </i>
                <a class="text-gray-dark" href="" @click.prevent="showFormAddPrelevement"> <b>PRELEVEMENT</b> </a>
            </div>
        </div>
        <div class="row" v-if="showFormPrelevement == true">
            <div class="col">
                <form action="/home/recursives" method="post" @submit.prevent="addPrelevement">
                    <input type="hidden" name="account" :value="account.id">
                    <input type="hidden" name="type" value="0">
                    <input type="hidden" name="icone" value="1">

                    <input type='hidden' name='_token' :value='token'>

                    <div class="form-group row ml-3">

                        <div class="col-lg-4 col-md-6 col-sm-6 ">
                            <div class="form-group fd fdrt">
                                <label for="exampleSelect1">Catégorie</label>
                                <select class="form-control fontawesome-select" id="exampleSelect1" name="categorie">
                                    <option value="home">&#xf015; &nbsp; &nbsp; Travail</option>
                                    <option value="star">&#xf018; &nbsp; &nbsp; rente appartement</option>
                                    <option value="plus">&#xf018; &nbsp; &nbsp; icon-road</option>
                                    <option value="road">&#xf018; &nbsp; &nbsp; icon-road</option>
                                    <option value="road">&#xf018; &nbsp; &nbsp; icon-road</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3 col-sm-3 gdgfdg">
                            <div class="form-group">
                                <label class="mr-2" for="titre">Nom</label>
                                <input v-model="name" type="text" class="form-control " id="titre" name="nom" required>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3 col-sm-3">
                            <div class="form-group">
                                <label class="mr-2" for="somme">Valeur</label>
                                <input v-model="value" type="number" class="form-control" id="somme" name="valeur"
                                       required>
                            </div>
                        </div>

                    </div>

                    <div class="form-group row ml-3 align-middle ">

                        <div class="col-lg-4 col-md-6 col-sm-4 ">
                            <div class="form-group">
                                <label class="" for="per">Periode</label>
                                <select v-model="periode" class="form-control fontawesome-select" id="per"
                                        name="periode">
                                    <option :value="period" v-for="period in listePeriode">
                                        &#xf105; &nbsp; &nbsp; {{period}}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3 col-sm-4 ">
                            <div class="form-group">
                                <label class="" for="datechoice">Le</label>
                                <select v-model="precise" class="form-control fontawesome-select" id="datechoice"
                                        name="precise">
                                    <option :value="precis" v-for="precis in checkListe">
                                        &#xf105; &nbsp; &nbsp; {{precis}}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12   right ">
                            <button type="submit" class="btn btn-primary ">Ajouté</button>
                        </div>
                    </div>

                </form>
            </div>
            <br>
            <br>
            <br>
        </div>

        <div class="row pl-4" v-for="prelevement in this.data">
            <div class="col -3">
                <i class="fa fa-home mr-2">
                </i>{{prelevement.name}}  <b class="text-danger">-{{prelevement.value}} e </b>
                &ndash; {{prelevement.readable_date}} &ndash;
            </div>
        </div>
        <hr>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                data: [],
                name: '',
                value: '',
                icone: '',
                token: '',
                account: '',
                showFormPrelevement: false,
                precise: '1er jour',
                periode: 'Mois',
                listePeriode: ['Mois', 'Semaine', 'Jour', 'Année'],
                listePrecise: []
            }
        },
        props: ['virement', 'compte'],
        computed: {
            checkListe(){
                if (this.periode === 'Mois') {
                    this.precise = '1er jour';
                    return ['1er jour', '5ème jour', '10ème jour', '15ème jour', '20ème jour', '25ème jour', 'Dernier jour'];
                }
                else if (this.periode === 'Semaine') {
                    this.precise = 'Lundi';
                    return ['Lundi', 'Mardi', 'Mercredi', 'Samedi', 'Dimanche'];
                }
                else if (this.periode === 'Jour') {
                    this.precise = '8h';
                    return ['8h', '10h', '12h', '14h', '16h', '18h', '20h'];
                }
                else if (this.periode === 'Année') {
                    this.precise = 'Janvier';
                    return [
                        'Janvier', 'Fevrier', 'Mars', 'Avril',
                        'Mai', 'Juin', 'Juillet', 'Aout',
                        'Septembre', 'Octobre', 'Novembre', 'Decembre',
                    ];
                }
                else {
                    this.precise = '1er jour';
                    return ['1er jour', '5ème jours', '10ème jour', '15ème jour', '20ème jour', '25ème jour', 'dernier jour'];
                    ;
                }
            },

        },
        methods: {
            addPrelevement(){
                axios.post('/home/recursives', {
                    account: this.account.id,
                    valeur: this.value,
                    nom: this.name,
                    type: 0,
                    icone: 1,
                    periode: this.periode,
                    precise: this.precise,
                })
                    .then(data => {

                        this.data.push( {
                            name: this.name,
                            value: this.value,
                            readable_date: data.data[0].readable_date
                        });

                        this.name = '';
                        this.value = '';
                        this.showFormPrelevement = false;
                    })
                    .catch(error => console.log(error));
            },
            showFormAddPrelevement(){
                this.showFormPrelevement = !this.showFormPrelevement;
            },
        },
        mounted() {
            this.data = this.virement;
            this.token = money.csrfToken;
            this.account = this.compte;
        }
    }
</script>
