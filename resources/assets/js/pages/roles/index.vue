<template>
    <div v-if="dataReady" id="data_table_view">
        <button class="btn-new" @click="$router.push('/roles/create')"><i class="fa fa-plus" aria-hidden="true"></i>New
            Role</button>
    </div>
</template>

<script>

    import tableDefinition from './tableDefinition'
    import {SearchTableView}  from '../../elements/tables/SearchTableView';
    import {SearchTableController}  from '../../elements/tables/SearchTableController';
    import {TableModel}  from '../../elements/tables/TableModel';

    export default {
        data() {
            return {
                data: {},
                dataReady: false,
        }
        },
        props: ['page'],
        mounted: function () {
            console.log(this.page);
            this.dataReady = false;
            //we need to get some data
            let self = this;
            $.get('/roles', function (response) {
                // if session was expired
                self.data = response.data;
                self.dataReady = true;
                self.renderTable();

            });
        },
        methods: {
            renderTable(){
                let td = tableDefinition(this.data);
                td.table_type = this.page;
                console.log(td)


                let model = new TableModel(td, this.data),
                    view = new SearchTableView(model),
                    controller = new SearchTableController(model, view, this.data.number_of_records_available);


                $(function () {
                    let div = document.getElementById("data_table_view");
                    div.appendChild(view.searchTable());
                    controller.loadPageEvent.notify();
                });

            }
        }
    }

</script>
