<template>
    <div class="alert alert-danger" role="alert"  v-if="isShow">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-star mr-2"> </i><strong> Argh !</strong>
            Encore un petit effort a faire et ton compte sera actif !</h3>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                status: false,
                show:false,
            }
        },
        props:{
            state:{
                number: Boolean
            }
        },
        computed:{
            isShow(){
                return this.show;
            },
        },
        methods:{
            close(){
                this.show = false;
            },
        },
        mounted() {

            this.status = this.state === 0 ? true : false;
            this.show = this.status;

            Event.$on('userAccountActive', (status) => {
                this.show = false;
                this.status = ! this.show;
            });

            Event.$on('removeAccount', (data) => {
                this.status = data.status;
                this.show =  data.status === false ? true : false;
            });
        },

    }
</script>
