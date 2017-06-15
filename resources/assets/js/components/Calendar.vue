<template>
    <div>

        <div class="row">
            <div class="col" @click.prevent="reset">
                 <h4> CALENDRIER</h4>
            </div>
        </div>

        <div class="row">
            <div class="col">

                <div class="row" >
                    <div class="col border" @click.prevent="subYear"></div>
                    <div class="col border" @click.prevent="subMonth">-</div>
                    <div class="col border ">
                        <b>{{ selectedDateSession | dateCalendar}}</b>
                    </div>
                    <div class="col border" @click.prevent="addMonth"><a href="">+</a></div>
                    <div class="col border" @click.prevent="addYear"><a href=""> >  </a></div>
                </div>

                <div class="row border" >
                    <div class="col " v-for="jour in weeksShort">{{jour | formated}}</div>
                </div>

            </div>
        </div>

        <div class="row" v-for="week in cal">
            <div class="col border size--date" v-for="date in week.date">
                <date :transaction="passThroughTransaction(date)" :date="date" :session="selectedDateSession"></date>
            </div>
        </div>

    </div>

</template>
<style>
    .size--date{
        height: 130px;
    }
</style>
<script>
    import Date from './Date.vue';

    export default {
        components:{Date},
        data(){
            return{
                cal : [],
                selectedDateSession :moment(),
                weeks : moment.weekdays(),
                weeksShort : moment.weekdaysShort(),
                transaction:[],
            }
        },

        mounted(){
            this.getMovement();

           Event.$on('changeDateSession', (date) => {
                this.selectedDateSession = moment(date.date);
                axios.post('/configuration/calendar/set/session',{date:this.selectedDateSession});
           });

            this.getSessionDate();

            this.formatWeeks();

            this.formatShortWeeks();



        },
        filters:{
            formated(data){
                return data.toUpperCase().replace('.','');
            },
            dateCalendar(data){
                return data.format('DD MMMM YYYY');
            },
        },
        methods: {

            passThroughTransaction(date){
                return this.transaction[date] === 'undefined' ? false : this.transaction[date];
            },
            formatWeeks(){
                let last = this.weeks[0];
                this.weeks.splice(0, 1);
                this.weeks.push(last);
            },
            formatShortWeeks(){
                let lastShort = this.weeksShort[0];
                this.weeksShort.splice(0, 1);
                this.weeksShort.push(lastShort);

            },
            getSessionDate  () {
                axios.get('/configuration/calendar/session').then(
                    response => {
                        this.selectedDateSession = moment(response.data);

                        this.makeCalendar();
                    }
                );
            },
            makeCalendar(){
                this.cal=[];

                this.getMovement(this.selectedDateSession.format('YYYY-MM-DD'));
                let dateMutable = this.selectedDateSession;
                let startWeek = moment(dateMutable).startOf('month').startOf('week').week();
                let startDayWeek = moment(dateMutable).startOf('month').startOf('week');
                let endDayWeek = moment(dateMutable).endOf('month').endOf('week');
                let endWeek = endDayWeek.week();

                /*
                  *  problematique de confition jamais remplie
                  *  on ne rentre jamais dans la boucle car depart 52 fin 5 , condition 52 <= 5 jamais valider.
                 * */
                let diff = startDayWeek.weeksInYear() - startWeek + endWeek + 1;
                var w= startWeek ;
                let lastWeekOnYear =  startWeek > endWeek ;

                if(lastWeekOnYear)
                {
                    startDayWeek.subtract(1,'days');
                    for( var test = 1 ; test <= diff ; test++ )
                    {
                        if( w > startDayWeek.weeksInYear() ) w = w - startDayWeek.weeksInYear();
                        this.cal.push({
                            week:week,
                            date: Array(7) .fill(0) .map( (n, i) => startDayWeek.add(1, 'day').format('YYYY-MM-DD'), )
                        });
                        w++;
                    };
                }
                else{
                    /*
                     * PROBLEME DE GESTION DES SEMAINE voir changement d'année !
                     * */
                    for( var week = startWeek; week <= endWeek  ; week++ ) {
                        if(week > startDayWeek.weeksInYear()) week = week - startDayWeek.weeksInYear();
                        this.cal.push({
                            week:week,
                            date:
                                Array(7) .fill(0)
                                    .map(
                                        (n, i) =>
                                            moment() .year(startDayWeek.year()) .week(week) .startOf('week') .clone()
                                                .add(n + i, 'day')
                                                .format('YYYY-MM-DD')
                                        ,
                                    )
                        })
                    }
                }
            },

            subYear(){
                this.selectedDateSession = this.selectedDateSession.clone().subtract(1,'years');
                axios.post('/configuration/calendar/set/session',{date:this.selectedDateSession});
                this.getMovement();
                this.makeCalendar();
            },
            addYear(){
                this.selectedDateSession = this.selectedDateSession.clone().add(1,'years');
                axios.post('/configuration/calendar/set/session',{date:this.selectedDateSession});
                this.makeCalendar();
            },
            subMonth(){
                this.selectedDateSession = this.selectedDateSession.clone().subtract(1,'months');
                axios.post('/configuration/calendar/set/session',{date:this.selectedDateSession});
                this.makeCalendar();
            },
            addMonth(){
                this.selectedDateSession = this.selectedDateSession.clone().add(1,'months');
                axios.post('/configuration/calendar/set/session',{date:this.selectedDateSession});
                this.makeCalendar();
            },
            reset(){
                this.selectedDateSession = moment();
                axios.post('/configuration/calendar/set/session',{date:this.selectedDateSession});
                this.makeCalendar();
            },
            getMovement(date=null){
                if(date){
                    axios.get('/home/movement/session/'+date).then( response =>{
                        this.transaction = response.data.transaction;
                    });
                }
                else{
                    axios.get('/home/movement/session').then( response =>{
                        this.transaction = response.data.transaction;
                    });
                }

            }
        },

    }
</script>
