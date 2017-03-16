<template>
    <div>
        <zzi-wait></zzi-wait>
        <div v-if="dataReady">

            <button class="btn-back" @click="$router.push('/roles')"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
                To Role List
            </button>
            <button v-if="page!='create'" class="btn-new" @click="$router.push('/roles/create')"><i class="fa fa-plus"
                                                                                                    aria-hidden="true"></i>New
                Role
            </button>

            <div id="awesome_table_div" class="recordTableView">
                <h2 v-if="page==='create'">New Role</h2>
                <h2 v-else-if="data.role[0].id==1">Admin Role - No Editing is possible</h2>
                <h2 v-else-if="page==='edit'">Edit Role {{data.role[0].name}} </h2>
                <h2 v-else-if="page==='show'">Role {{data.role[0].name}}</h2>
            </div>

        </div>

    </div>
</template>

<script>
    import {AwesomeTable} from '../../elements/tables/AwesomeTable';
    import tableDefinition from './tableDefinition'


    export default {
        data() {
            return {
                data: {},
                dataReady: false
            }
        },
        props: ['page'],
        mounted: function () {

            let self = this;
            self.dataReady = false;
            bus.$emit('zzwaitevent');
            switch (self.page) {
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
                let self = this;

                let td = tableDefinition(self.data, self.page)
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
                        "select_values": [{'value': 'write', 'name': 'Write'}, {
                            'value': 'read',
                            'name': 'Read'
                        }, {'value': 'none', 'name': 'None'}],

                        "show_on_list": true,
                    },];
                let access_table_definition = {
                    "name": "views_table",
                    "access": "READ",
                    "dynamic_table_buttons": ['edit'],
                    "table_type": "index",//record
                    "route": "/roles",
                    "footer": [],
                    "header": [],
                    "column_definition": column_definition2,
                };

                //No editing if the admin role
                if (this.page != 'create' && this.data.role[0].id == 1) {
                    td.record_table_buttons = [];
                    access_table_definition.dynamic_table_buttons = [];
                }

                //
                let roleTable = new AwesomeTable({
                    type: 'record',
                    data: this.data.role,
                    table_definition: td,
                    deleteSuccess(){
                        //back to roles
                        self.$router.push('/roles');
                    },

                })
                roleTable.addTo('awesome_table_div');


                let accessTable = new AwesomeTable({
                    type: 'collection',
                    data: this.data.views,
                    table_definition: access_table_definition,
                })
                accessTable.addTo('awesome_table_div');
                bus.$emit('zzwaitoverevent');


            }
        }
    }

</script>
