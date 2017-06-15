<template>
    <div>
        <a href=""  @click.prevent="deleteAccount()" class="mr-2">
            <i class="fa fa-trash" > </i>
        </a>
        <a href=""  @click.prevent="showAccount()" class="mr-2">
            <i class="fa fa-pencil" > </i>
        </a>
        <a href=""  @click.prevent="showDetails()" class="mr-2">
            <i class="fa fa-plus"> </i>
        </a>
        {{ account.description }} - <b> {{ account.nom }} </b>

        <transition name="fade">
            <form class="form-inline" v-if="showEditAccount" @submit.prevent="editAccount">

                <label class="mr-sm-2" for="accountDescription">Nom du compte</label>
                <input v-model="form.description" name="description" id="accountDescription" type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"  placeholder="Crédit agricole ... " autofocus>
                <div class="form-control-feedback text-danger" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></div>


                <label class="mr-sm-2" for="accountValue">Compte</label>
                <input v-model="form.nom" type="text" id="accountValue" class="form-control mb-2 mr-sm-2 mb-sm-0">
                <div class="form-control-feedback text-danger" v-if="form.errors.has('nom')" v-text="form.errors.get('nom')"></div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
            <form action="" v-if="showDetailsAccount">
                <div class="form-group row">
                    <label for="solde" class="col-2 col-form-label">
                        Solde
                        <input id="solde" type="number" placeholder="1250,78 e" class=" form-control mx-1">
                    </label>


                </div>

            </form>
        </transition>
    </div>

</template>

<script>
    export default {
        props:['details'],
        data(){
            return{
                account : this.details,
                form : new Form({
                    description:this.details.description,
                    nom:this.details.nom,
                }),
                showEditAccount : false,
                showDetailsAccount : false,
            }
        },
        mounted() {

        },
        methods:{
            showAccount(){
              this.showEditAccount = ! this.showEditAccount;
            },
            showDetails(){
                this.showDetailsAccount = ! this.showDetailsAccount;
            },
            editAccount(){
                this.form.patch('/home/account/' + this.account.id)
                    .then(data => {
                        this.showEditAccount= false;
                        this.form.errors.clear();

                        Event.$emit('editAccount',{
                            id:this.account.id,
                            nom:this.form.nom,
                            description:this.form.description,
                        })
                    })
                    .catch(error => console.log(error));
            },
            deleteAccount(id){
                axios.delete('/home/account/'+this.account.id);
               
                Event.$emit('removeAccount',{
                    id:this.account.id
                })
            },
        }
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
            if (field) {
                delete this.errors[field];
                return;
            }
            this.errors = {};
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
        }
        onFail(errors){
            this.errors.record(errors)
        }

        /**
         * Send a POST request to the given URL.
         * .
         * @param {string} url
         */
        post(url) {
            return this.submit('post', url);
        }


        /**
         * Send a PUT request to the given URL.
         * .
         * @param {string} url
         */
        put(url) {
            return this.submit('put', url);
        }


        /**
         * Send a PATCH request to the given URL.
         * .
         * @param {string} url
         */
        patch(url) {
            return this.submit('patch', url);
        }


        /**
         * Send a DELETE request to the given URL.
         * .
         * @param {string} url
         */
        deleteData(url) {
            return this.submit('delete', url);
        }
    }
</script>
