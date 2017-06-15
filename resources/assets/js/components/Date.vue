<template>

    <span v-if="isMuted">
        <span class="row " >

        </span>
    </span>
    <span v-else @click="changeDateSession">
        <span class="row">
            <span class="col">
                 {{ dateFormat | maj }}
            </span>
            <span class="col" v-if="isToday">
                <span class="badge badge-danger">Today</span>
            </span>
        </span>
        <span v-if="hasTransaction">
            <span class="row" v-for="move in transaction">
                <span class="col">
                    {{move.name}} - {{move.value}} e
                </span>
            </span>
        </span>
    </span>


</template>



<script>
    export default {

        data(){
            return{
                today : moment(),
            }
        },

        props:['date','session','transaction'],

        filters:{
            maj(data){
                return data.toUpperCase();
            },
        },
        computed : {

            dateFormat(){
              return   moment(this.date).format('DD MMM')
            },
            isMuted(){
                return   moment(this.session).month() !== moment(this.date).month();
            },
            isToday(){
                return  moment(this.date).isSame(moment(), 'days');
            },
            hasTransaction(){
                return  this.transaction !== undefined ;
            },
        },
        methods : {

            changeDateSession(){
                Event.$emit('changeDateSession', {
                    date : this.date,
                });
            }
        }

    }
</script>
