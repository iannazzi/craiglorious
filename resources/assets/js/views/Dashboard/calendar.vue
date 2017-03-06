<template>
    <div id="calendar" >



        <!--<div class="row" id="calendar_controls">-->
            <!--<div class="col-md-3 col-md-offset-9">-->
                <!--<button>Day</button>-->
                <!--<button>Week</button>-->
                <!--<button>Month</button>-->
            <!--</div>-->
        <!--</div>-->
        <!--<div id="weekly" class="row">-->
            <!--<div v-for="n in weekPlus" id="weekday" class="col-md-1">-->
                <!--<div id="calendar-date" class="row">-->
                    <!--<div id="calendar-day" class="text-left col-md-6">-->
                        <!--<h5>Sun</h5>-->
                    <!--</div>-->
                    <!--<div id = "calendar-num" class="text-right col-md-6">-->
                        <!--<h6>23</h6>-->
                    <!--</div>-->
                <!--</div>-->
                <!--<div id="calendar-reminder">-->
                    <!--<ul class="list-unstyled">-->
                        <!--<li>Todos x</li>-->
                        <!--<li>move event drag drop</li>-->
                        <!--<li> <div draggable="true">Drag me</div></li>-->
                    <!--</ul>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    </div>
</template>
<style>

    #calendar {
        margin: 10px 10px 10px 10px;

    }
    #weekday {
        background-color: white;
        padding:0px;
    }
    #calendar-date{
        border-left: thin solid black;
        height:20px;
        margin-left:0px;
        margin-right:0px;

        padding-bottom:0px;
        background-color: lightblue;
    }
    #calendar-date h5, h6{
        margin:1px;
    }
    #calendar-day{


        padding-left:5px;
    }
    #calendar-num{

        padding-right:2px;
    }
    #calendar-reminder{
        width:100%;

        border: thin solid lightgray;
        border-top:0;
        font-size:0.7em;
        padding-left:5px;
    }


</style>
<script>
    let calendar = [];
    let entry = {}
    for (let i = 0; i < 30; i++) {
        entry = {};
        entry['date'] = '2016-01-' + i;
        entry['entry'] = ['something', 'something else'];
        calendar.push(entry);

    }

    export default {

        computed: {
            weekPlus: function () {
                return this.calendar.slice(0, 12);
            }
        },
        data() {
            return {
                calendar: calendar,
            }
        },
        mounted: function () {
            $('#calendar').fullCalendar({
                // put your options and callbacks here
            })
            console.log(this.calendar);

        },
        methods: {}
    }
</script>