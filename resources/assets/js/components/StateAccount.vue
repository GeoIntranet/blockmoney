<template>
    <div>
        <div class="alert alert-danger" role="alert" v-if="isInactiveShow">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h3><i class="fa fa-star mr-2"> </i><strong> Argh !</strong>
                Encore un petit effort a faire et ton compte sera actif !</h3>
        </div>

        <transition name="fade">
            <div class="alert alert-warning" role="alert" v-if="isActiveShow">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3><i class="fa fa-star mr-2"> </i><strong> Bien joué !</strong> Ton compte est <b>actif</b> !</h3>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                status: false,
                showActive:false,
                showInactive:false,
            }
        },
        props:{
            state:{
                number: Boolean
            }
        },
        computed:{
            isActiveShow(){
                return this.showActive;
            },
            isInactiveShow(){
                return this.showInactive;
            },
        },
        methods:{
            close(){
                this.showActive = false;
                this.showInactive = false;
            },
        },
        mounted() {

            this.status = this.state === 0 ? true : false;
            this.showInactive = this.status;

            Event.$on('isActiveUser', (status) => {
                this.show = false;
                this.status = ! this.show;
            });

            Event.$on('removeAccount', (data) => {

                this.status = data.status;
                this.isInactiveShow = ! data.status;
            });
        },
    }
</script>
