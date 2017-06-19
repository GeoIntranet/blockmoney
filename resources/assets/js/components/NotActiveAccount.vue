<template>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h3><i class="fa fa-star mr-2"> </i><strong> Argh !</strong> Encore un petit effort a faire et ton compte sera actif !</h3>
    </div>
</template>

<script>
    export default {
        props:['status'],
        mounted() {
            console.log("this.moment().format()")
        }
    }
</script>
