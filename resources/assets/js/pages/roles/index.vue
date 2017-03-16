<template>
    <div>
        <zzi-wait></zzi-wait>
        <div v-if="dataReady" id="data_table_view">
            <button class="btn-new" @click="$router.push('/roles/create')"><i class="fa fa-plus" aria-hidden="true"></i>New
                Role</button>

        </div>
    </div>


</template>

<script>

    import tableDefinition from './tableDefinition'
    import {AwesomeTable} from '../../elements/tables/AwesomeTable';


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


            bus.$emit('zzwaitevent');
            $.get('/roles', function (response) {
                // if session was expired
//                console.log(response);
                self.data = response.data;
                self.dataReady = true;
                self.renderTable();
                bus.$emit('zzwaitoverevent');
            });
        },
        methods: {
            renderTable(){
                let self = this;
                let searchableTable = new AwesomeTable({
                    type: 'searchable',
                    data: this.data,
                    table_definition: tableDefinition(self.data, self.page),
                    number_of_records_available:self.data.number_of_records_available,
                })

                searchableTable.addTo('data_table_view')



            }
        }
    }

</script>
