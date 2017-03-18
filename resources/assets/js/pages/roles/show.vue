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
        <button @click="showModalTable">pop up modal table</button>
    </div>
</template>

<script>
    import {AwesomeTable} from '../../elements/tables/AwesomeTable';
    import columnDefinition from './columnDefinition'

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
            showModalTable(){

                let roleTable = this.roleTable();
                roleTable.options.edit_display = 'modal_only';
                roleTable.options.access = 'write';
                roleTable.addTo('awesome_table_div');
                roleTable.showModal();
            },
            roleTable(){
                let self = this;
                let access,edit;
                let onEditClick =function (id) {};
                switch(this.page){
                    case 'create':
                        access = 'write';
                        edit = 'on_page';
                        break;
                    case 'edit':
                        access = 'write';
                        edit = 'on_page';
                        break;
                    case 'show':
                        access = 'read';
                        edit = 'on_page';
                        onEditClick = function (id) {
                            self.$router.push('/roles/'+id+'/edit');
                        };
                        break;
                }
                let roleTable = new AwesomeTable({
                    name: "role",
                    data: self.data.role,
                    route: "/roles",
                    column_definition: columnDefinition(self.data),
                    table_buttons: ['edit','delete'],
                    type: 'record', //awesome table record, collection or searchable

                    //this needs to be killed....
                    table_type: self.page, //router comes back to the view with create edit or show


                    //this works for all tables:
                    access: access, //useless attribute? not really....

                    edit_display: edit,
                    // on_page add one table
                    // modal add table + table in modal
                    // modal_only add modal table
                    // new_page ..... nope just call onEdit


                    onDeleteSuccess(){
                        //back to roles
                        self.$router.push('/roles');
                    },
                    onEditClick:onEditClick,
                    onSaveClick(id){
                        //first save the table.
                        this.save();
                        // opt 1 close the modal
                        this.modal.hide();

                        //opt 2 set access back to write

                        //option 2 go somewhere

                    },
                    onSaveSuccess(){
                        //default to close modal if present
                        //reload draw table
                        //self.$router.push('/roles/'+id);
                    },
                    onCreateClick(id){
                        //pop up a modal
                        // this.create() //check the display
                        //back to roles
                        self.$router.push('/roles/'+id);
                    }

                })
                return roleTable;
            },
            renderTable(){


                let self = this;

                let roleTable = this.roleTable();

                let access_table_column_definition = [
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
                let accessTable = new AwesomeTable({
                    data: this.data.views,
                    name: "views_table",

                    access: "READ",

                    table_buttons: ['edit'],
                    table_type: "index",//record
                    type: 'collection',

                    route: "/roles",
                    column_definition: access_table_column_definition,
                })

                //No editing if the admin role
                if (this.page != 'create' && this.data.role[0].id == 1) {
                    roleTable.table_buttons = [];
                    accessTable.table_buttons = [];
                }
                $(function(){
                    roleTable.addTo('awesome_table_div');
                    accessTable.addTo('awesome_table_div');
                    bus.$emit('zzwaitoverevent');

                })



            }
        }
    }

</script>
