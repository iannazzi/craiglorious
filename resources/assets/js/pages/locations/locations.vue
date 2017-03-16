<template>

    <div class="panel-body">
        <div id="data_table_view"></div>
    </div>

</template>

<script>
    import { pageSetup }from './pageSetup'
    export default {
        data() {
            return {
            }
        },
        mounted: function () {
            //we need to get some data
            $.get('/users', function(data) {
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
