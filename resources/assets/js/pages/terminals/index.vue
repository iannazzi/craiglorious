<template>
    <div>
        <zzi-wait></zzi-wait>
        <div v-if="dataReady" id="data_table_view">
            <button class="btn-new" @click="$router.push('/terminals/create')"><i class="fa fa-plus" aria-hidden="true"></i>New Terminal
            </button>
            <div id="terminals"></div>
        </div>
    </div>


</template>

<script>

    import columnDefinition from './columnDefinition'
//    import {AwesomeTable} from '../../elements/tables/AwesomeTable';


    export default {
        data() {
            return {
                data: {},
                dataReady: false,
            }
        },
        props: ['page'],
        mounted: function () {
            this.dataReady = false;
            //we need to get some data
            let self = this;


            client({path: '/terminals'}).then(
                function (response) {
                    console.log(response);
                    self.data = response.data;
                    self.dataReady = true;
                    self.renderTable();
                });


        },
        methods: {
            renderTable(){
                let self = this;
                let searchableTable = new AwesomeTable({
                    access: "read",
                    table_buttons: [],
                    table_view: self.page,
                    edit_display: 'on_page',
                    route: "/terminals",
                    footer: [],
                    header: [],
                    column_definition: columnDefinition(self.data),
                    type: 'searchable',
                    data: self.data,
                    number_of_records_available: self.data.number_of_records_available,
                })
                $(function(){
                    searchableTable.addTo('terminals')
                })


            }
        }
    }

</script>
