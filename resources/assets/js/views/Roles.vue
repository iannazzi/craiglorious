<template>

    <div class="panel-body">
        <div id="data_table_view"></div>
    </div>

</template>

<script>
    import { pageSetup }from '../pages/roles/pageSetup'
    export default {
        data() {
            return {
            }
        },
        mounted: function () {
            console.log('roles coming')
            //we need to get some data
            $.get('/roles', function(data) {
                // if session was expired
                 console.log(data);
                let div = document.getElementById("data_table_view");
                div.appendChild(pageSetup(data.data));

            });


        },
        methods: {

        }
    }

</script>
