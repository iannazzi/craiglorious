<template>

    <div>
        <div v-if="dataReady">

            <button class="btn-back" @click="$router.push('/'+route)"><i class="fa fa-arrow-left"
                                                                         aria-hidden="true"></i>Back
                To {{modelName}} List
            </button>
            <button v-if="page!='create'" class="btn-new" @click="$router.push('/'+ route + '/create')"><i
                    class="fa fa-plus"
                    aria-hidden="true"></i>New
                {{modelName}}
            </button>

            <div id="record_table" class="recordTableView">
                <h2 v-if="page==='create'">New {{modelName}}</h2>
                <h2 v-else-if="page==='edit'">Edit {{modelName}} {{data.records[0].start}} </h2>
                <h2 v-else-if="page==='show'">{{modelName}} {{data.records[0].start}}</h2>
            </div>
            <div id="payroll_contents"></div>

        </div>
        <div v-else>
            <zzi-matrix></zzi-matrix>
        </div>

    </div>
</template>


<script>
    import columnDefinition from './columnDefinition'
    import recordPageMixins from '../../controllers/recordPageMixins'


    export default {
        data() {
            return {
                data: {},
                dataReady: false,
            }
        },
        mixins: [recordPageMixins],
        props: ['page', 'justcreated', 'route'],
        mounted: function () {
            let awesomeTable = AwesomeTableWrapper.newRecordTable();
            let afterRendered = function () {

            }
            AwesomeTableWrapper.renderRecordTable(awesomeTable, this, columnDefinition, 'record_table', afterRendered)

            //now we need another table for the contents....

            let column_definition = [
                {
                    db_field: 'id',
                    type: 'id'
                },
                {
                    db_field: 'employee_name',
                    caption: 'Employee',
                    type: 'select',
                    select_values: this.data.employees_select
                }

            ]

            let payrollContents = new AwesomeTable('collection');
            let config = {
                data: [],
                name: 'payroll_contents',
                table_view: 'index',
                column_definition,
                table_buttons: ['edit'],
                access: 'read', //read vs write


            }
            awesomeTable.loadConfiguration(config);
            awesomeTable.addTo('payroll_contents');

        },
        methods: {
        }
    }

</script>
