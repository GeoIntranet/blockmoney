<template>

    <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">test</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav ">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <div class="col-4 ">
                <div class="row ">

                    <!--Zone de recherche-->
                    <form :class="isActive" >
                        <input
                                autocomplete="off" name="search" v-model="search"
                                @click="inputfocus" @keyup.esc="closeSearch" @focus="inputfocus"  @blur="inputOutfocus"  @keyup.delete="emptySearch" @keyup="autocomplete"
                                class="form-control col-12 " type="text" placeholder="Search">
                    </form>
                    <!--FIN Zone de recherche-->

                    <!--Zone autocomplétion-->
                    <div class="col-12 positionBar" id="scroll" :style="{display:activeComplete}">
                        <div class="row" v-if="hasData">

                            <div class="col" v-if="errorSearch">
                                <h5>{{ errorSearch }}</h5>
                            </div>
                            <div class="col" v-else="">

                                <div class="row" v-if="data.module === 1">
                                    <compteSearch :original="data"></compteSearch>
                                </div>


                                <div class="row" v-if="data.module === 2">
                                    <transactionSearch :original="data"></transactionSearch>
                                </div>
                                <div class="row" v-if="data.module === 999">
                                   <h6>Erreur lors de la recherche</h6>
                                </div>

                                <!--<h5>{{ data.titre }}</h5>-->
                                <!--<div class="row" v-for="account in data.data">-->
                                    <!--<div class="col"> <i class="fa fa-angle-right mr-2 b pt-5"> </i>{{account.name}} - {{account.value}}e le {{account.created_at}}</div>-->
                                <!--</div>-->

                            </div>

                        </div>
                        <div class="row" v-else="">
                            <div class="col">
                                accueil de recherche
                            </div>
                        </div>
                    </div>
                    <!--FIN Zone autocomplétion-->

                </div>
            </div>
        </div>
    </nav>




</template>

<script>
    export default {
        data(){
            return{
                search:'',
                focus:false,
                activeComplete:'none',
                hasData:false,
                data:{},
                errorSearch:'',
            }
        },
        computed: {
            isActive: function () {
                return {
                    'expend form-inline col-8 p-0': this.focus === true,
                    'expend form-inline col-5  p-0': this.focus === false,
                }
            },

        },

        methods:{
            clickSearch(){

            },
            closeSearch(){
                console.log('close');
                this.focus = false;
                this.activeComplete = 'none';
                this.resetData();
            },
            resetData(){
                this.hasData = false;
                this.search = '';
                this.data = {};
            },
            readyForSearch(){
              return this.search !== '' ? false : true;
            },
            inputfocus(){
                this.focus = true;
                this.activeComplete = '';
            },
            emptySearch(){
               if( this.search === '' ){
                   this.resetData();
               }
            },
            inputOutfocus(){
                this.focus = false;
                this.activeComplete = 'none';
                this.resetData();
            },
            autocomplete(){
                if(this.search !== ''){

                    axios.post('/search', {
                        search: this.search,
                    })
                    .then( (response) => {
                        this.hasData = true;
                        this.errorSearch ='';
                        this.data = response.data;
                    })
                    .catch( (response) => {
                        this.hasData = true;
                        this.errorSearch = 'il y\'a un probleme lors de la recherche ';
                    });
                }
            }
        },
        mounted() {
            console.log("navigation bar")
        }
    }
</script>
