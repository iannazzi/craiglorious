<template>
    <div>
        <zzi-wait></zzi-wait>
        <div v-if="dataReady" id="data_table_view">
            <button class="btn-new" @click="$router.push('/locations/create')"><i class="fa fa-plus" aria-hidden="true"></i>New
                Location
            </button>
            <div id="locations"></div>
        </div>
    </div>


</template>

<script>

    import columnDefinition from './columnDefinition'
//    import {AwesomeTable} from '../../elements/tables/AwesomeTable';


    export default {

        props: ['page'],
        mounted: function () {
            this.dataReady = false;
            //we need to get some data
            let self = this;

            bus.$emit('zzwaitevent');

            client({ path: '/locations' }).then(
                function (response) {
                  console.log(response);
                    self.data = response.data;
                       self.dataReady = true;
                    self.renderTable();
                    bus.$emit('zzwaitoverevent');
                },
                function (response, status) {
                    console.log(response);

                    if (_.contains([401, 500], status)) {
                    }
                });

//
//            $.get('/locations', function (response) {
//                console.log(response);
//                self.data = response.data;
//                self.dataReady = true;
//                self.renderTable();
//                bus.$emit('zzwaitoverevent');
//            });
        },
        methods: {
            renderTable(){
                let self = this;
                let searchableTable = new AwesomeTable({
                    access: "read",
                    table_buttons: [],
                    table_view: self.page,
                    edit_display: 'on_page',
                    route: "/locations",
                    footer: [],
                    header: [],
                    column_definition: columnDefinition(self.data),
                    type: 'searchable',
                    data: self.data,
                    number_of_records_available: self.data.number_of_records_available,
                })
                $(function(){
                    searchableTable.addTo('locations')
                })


            }
        }
    }

</script>
