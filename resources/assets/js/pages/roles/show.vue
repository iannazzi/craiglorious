<template>
    <div v-if="dataReady">

        <button class="btn-back" @click="$router.push('/roles')"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back To Role List</button>
        <button v-if="page!='create'"class="btn-new" @click="$router.push('/roles/create')"><i class="fa fa-plus" aria-hidden="true"></i>New Role</button>

        <div id="record_table_view" class="recordTableView">
            <h2  v-if="page==='create'">New Role</h2>
            <h2 v-else-if="data.role[0].id==1">Admin Role - No Editing is possible</h2>
            <h2  v-else-if="page==='edit'">Edit Role {{data.role[0].name}} </h2>
            <h2  v-else-if="page==='show'">Role {{data.role[0].name}}</h2>
        </div>

    </div>


</template>

<script>
    import tableDefinition from './tableDefinition'
    import {RecordTableView}  from '../../elements/tables/RecordTableView';
    import {RecordTableController}  from '../../elements/tables/RecordTableController';
    import {DataTableView}  from '../../elements/tables/DataTableView';
    import {DataTableController}  from '../../elements/tables/DataTableController';
    import {TableModel}  from '../../elements/tables/TableModel';


    export default {
        data() {
            return {
                data:{
                },
                dataReady: false
            }
        },
        props: ['page'],
        mounted: function () {

            let self = this;
            self.dataReady = false;

            switch (self.page){
                case 'show':
                case 'edit':
                    $.get('/roles/' + this.$route.params.id, function (response) {
                        console.log(response);
                        self.data = response.data;
                        self.dataReady = true;
                        self.renderTable();
                    });
                    break;
                case 'create':
                    //how do I get the select options here?
                    $.get('/roles/create', function (response) {
                        console.log(response);
                        self.data = response.data;
                        self.dataReady = true;
                        self.renderTable();
                    });
                    break;
            }



        },
        methods: {
            renderTable(){
                let td = tableDefinition(this.data)
                td.table_type = this.page;

                let column_definition2 = [
                    {
                        "db_field": "name",
                        "caption": "View",
                        "type": "html",
                        "show_on_list": true,
                        "th_width": 80,
                    }, {
                        "db_field": "access",
                        "caption": "Access",
                        "type": "select",
                        "select_names": ['Write', 'Read', 'None'],
                        "select_values": [{'value':'write','name':'Write'},{'value':'read','name':'Read'},{'value':'none','name':'None'}],

                        "show_on_list": true,
                    },];




                    let view_table_definition = {
                    "name": "views_table",
                    "access": "READ",
                    "dynamic_table_buttons": ['edit'],
                    "table_type": "index",//record
                    "route": "/roles",
                    "footer": [],
                    "header": [],
                    "column_definition": column_definition2,
                };

                let model = new TableModel(td, this.data.role),
                    view = new RecordTableView(model),
                    controller = new RecordTableController(model, view);

                let views_model = new TableModel(view_table_definition, this.data.views),
                    views_view = new DataTableView(views_model),
                    views_controller = new DataTableController(views_model, views_view);

                //No editing if the admin role
                if (this.page != 'create' && this.data.role[0].id == 1) {
                    td.record_table_buttons = [];
                    view_table_definition.dynamic_table_buttons = [];
                }

                $(function () {
                    let div = document.getElementById("record_table_view");
                    console.log(div);
                    div.appendChild(view.recordTable());
                    div.appendChild(views_view.dataTable());
                    controller.loadPageEvent.notify();
                });


            }
        }
    }

</script>
