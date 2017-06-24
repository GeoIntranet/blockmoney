<template>
    <div>
        <div class="row">
            <div class="col  pl-2">
                <span class=" align-middle fa-stack " @click.prevent="showAccountForm" style="margin-top: 4px;">
                   <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                </span>
                <span class=" align-middle pb-1 " style="font-size: 1.8em">
                    Compte
                </span>


            </div>
        </div>


        <transition name="fade">
            <div class="row" v-if="accountForm">
                <div class="col">
                    <div class="container">
                        <form @submit.prevent="addAccount">
                            <div class="form-group row">
                                <label for="accountName" class="col-sm-2 col-form-label">Nom du compte</label>
                                <div class="col-sm-10">

                                    <input v-model="form.description" name="description" id="accountName" type="text"
                                           class="form-control" placeholder="Crédit agricole ... " autofocus>
                                    <div class="form-control-feedback text-danger" v-if="form.errors.has('description')"
                                         v-text="form.errors.get('description')"></div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="accountValue" class="col-sm-2 col-form-label">Compte</label>
                                <div class="col-sm-10">
                                    <input v-model="form.nom" name="nom" type="number" class="form-control"
                                           id="accountValue" placeholder="0845213256 ...">
                                    <div class="form-control-feedback text-danger" v-if="form.errors.has('nom')"
                                         v-text="form.errors.get('nom')"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10 right">
                                    <button type="submit" class="btn btn-primary">Ajouté</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </transition>

        <div class="row"  v-if="hasAccount">
            <div class="col">
                <account :details="account" v-for="account in accounts " :key="account.id"></account>
            </div>
        </div>

    </div>


</template>

<script>

    export default {
        data(){
            return {
                accountData: this.accounts,
                accountStatus :false,
                form : new Form({
                    description:'',
                    nom:'',
                }),
                accountForm: false,
            }
        },
        props:['accounts'],
        computed:{
            hasAccount(){
                return this.accountData.length > 0;
            },
            
        },
        methods:{
            showAccountForm(){
                this.accountForm = !this.accountForm
            },
            addAccount(){
                this.form.submit('post','/home/account')
                    .then(data => {
                        this.accountStatus = data.userAccountActive;
                        this.accountData.push({
                            id : data.id,
                            description : this.form.description,
                            nom : this.form.nom,
                        })
                        this.form.reset();
                        this.accountForm = false;



                    })
                    .catch(error => console.log(error));

                Event.$emit('isActiveUser',this.accountStatus);
            },
            getIndex(id){
                return this.accountData.findIndex( (el) => el.id === id );
            },

        },
        mounted() {
            Event.$on('removeAccount',(data)=>{
                this.accountData.splice(this.getIndex(data.id),1);
            })

            Event.$on('editAccount',(data)=>{
                let id = this.getIndex(data.id);
                this.accountData[id].nom = data.nom;
                this.accountData[id].description = data.description;
            })
        },

    }

    class Errors{

        constructor(){
            this.errors = {}
        }

        get(field){
            if(this.errors[field]){
                return this.errors[field][0] ;
            }
        }

        record(errors){
            this.errors = errors;
        }

        clear(field){
            if(field) delete this.errors[field];
            delete this.errors[field];
        }

        has(field){
            return this.errors.hasOwnProperty(field);
        }

        any(){
            return Object.keys(this.errors).length > 0;
        }
    }

    class Form {

        constructor(data){
            this.originalData =data;

            for (let field in data){
                this[field]= data[field];
            }

            this.errors = new Errors();
        }
        data(){
            let data = Object.assign({}, this);

            delete data.originalData;
            delete data.errors;

            return data;
        }
        reset(){
            for(let field in this.originalData){
                this[field] = '';
            }
            this.errors.clear();
        }
        submit(requestType, url)
        {
            return new Promise((resolve,reject) => {
                axios[requestType]( url, this.data() )
                    .then(response => {
                        this.onSucess(response.data);
                        resolve(response.data);
                    })
                    .catch(error => {
                        this.onFail(error.response.data);

                        reject(error.response.data);
                    });
            });

        }
        onSucess(response){
//            /this.reset();
        }
        onFail(errors){
            this.errors.record(errors)
        }
    }
</script>
