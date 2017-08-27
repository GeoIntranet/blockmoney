<template>
    <div class="row">
        <h1>lol</h1>
        <div class="row">
            <div class="col  pl-2">
            <span class=" align-middle fa-stack " @click.prevent="showAccountForm"
                  style="margin-top: 4px;">
               <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
            </span>
                <span class=" align-middle pb-1 " style="font-size: 1.8em">
                    Compte
            </span>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                accountStatus :false,
                form : new Form({
                    description:'',
                    nom:'',
                }),
                accountForm: false,
            }
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

                        this.soldeData[data.id] = [{value: 0}];
                        this.form.reset();
                        this.accountForm = false;
                    })
                    .catch(error => console.log(error));

                Event.$emit('isActiveUser',this.accountStatus);
            },

        },
        mounted() {
        },
    }
</script>
