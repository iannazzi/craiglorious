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

            <div id="role" class="recordTableView">
                <h2 v-if="page==='create'">New Role</h2>
                <h2 v-else-if="data.role[0].id==1">Admin Role - No Editing is possible</h2>
                <h2 v-else-if="page==='edit'">Edit Role {{data.role[0].name}} </h2>
                <h2 v-else-if="page==='show'">Role {{data.role[0].name}}</h2>
            </div>
            <div id="role_modal"></div>
            <button @click="showModalTable">pop up modal table</button>
            <div id="rights" ></div>

        </div>

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
            //bus.$emit('zzwaitevent');
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
        created(){


        },
        methods: {
            showModalTable(){
                let self = this;
                let roleTableModal = this.createRoleTable();
                roleTableModal.options.table_view = 'edit';
                roleTableModal.options.edit_display = 'modal_only';
                roleTableModal.options.access = 'write';
                self.roleTableModal = roleTableModal;
                roleTableModal.options.onSaveSuccess = function(){
                    self.roleTable.model.tdo = self.roleTableModal.modelModal.tdo;
                    self.roleTable.view.updateTable();
                    roleTableModal.hideModal();
                }
                roleTableModal.addTo('role_modal');
                roleTableModal.showModal();
                $('#role_modal_form_modal').on('shown.bs.modal', function () {
                    $('#role_modal_form_modal :input:first').focus();
                    $('#role_modal_form_modal :input:first').select();
                })

            },
            createRoleTable(){
                let self = this;
                let access,edit_display;
                let onEditClick =function (id) {};
                switch(this.page){
                    case 'create':
                        access = 'write';
                        edit_display = 'on_page';
                        break;
                    case 'edit':
                        access = 'write';
                        edit_display = 'on_page';
                        onEditClick = function (id) {
                            self.$router.push('/roles/'+id+'/edit');
                        };
                        break;
                    case 'show':
                        access = 'read';
                        edit_display = 'modal';
                        onEditClick = function (id) {
                            self.$router.push('/roles/'+id+'/edit');
                        };
                        break;
                }
                let roleTable = new AwesomeTable({
                    //name: "role",
                    data: self.data.role,
                    route: "/roles",
                    column_definition: columnDefinition(self.data),
                    table_buttons: ['edit','delete'],

                    type: 'record', //awesome table record, collection or searchable
                    table_view: self.page, //index, create, edit, and show pages: columns respond differnetly to
                    //this works for all tables:
                    access: access, //read vs write

                    edit_display: edit_display,
                    // on_page add one table
                    // modal add table + table in modal
                    // modal_only add modal table
                    // new_page ..... nope just call onEdit



                    onEditClick:onEditClick,
                    onSaveClick(id){
                        //first save the table.
                        console.log('ehhh')
                        this.save();
                        // opt 1 close the modal
                        this.modal.hide();

                        //opt 2 set access back to write

                        //option 2 go somewhere

                    },

                    onDeleteSuccess(){
                        //back to roles
                        self.$router.push('/roles');
                    },
                    onCreateSaved(id){
                        //pop up a modal
                        // this.create() //check the display
                        //back to roles
                        self.$router.push('/roles/'+id);
                    },
                    onCancelCreateClick(){
                        self.$router.push('/roles');
                    }

                })
                return roleTable;
            },
            renderTable(){


                let self = this;

                let roleTable = this.createRoleTable();
                self.roleTable = roleTable;
                console.log('role id');
                console.log(self.data.role[0].id)
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
                    //name: "views_table",
                    additionalPostValues:{
                            id: self.data.role[0].id
                    },
                    //tuck read/write away?
                    //show: read
                    //edit: write
                    //create: write
                    edit_display:'modal',
                    access: "read",
                    table_buttons: ['edit'],
                    table_view: "index",//record
                    type: 'collection',
                    route: "/roles/rights",
                    column_definition: access_table_column_definition,
                })

                //No editing if the admin role
                if (this.page != 'create' && this.data.role[0].id == 1) {
                    roleTable.table_buttons = [];
                    accessTable.table_buttons = [];
                }
                $(function(){
                    roleTable.addTo('role');
                    accessTable.addTo('rights');
                    bus.$emit('zzwaitoverevent');
                })



            }
        }
    }

</script>

<style>
    #rights{
        width:40%;
    }
    #role_form_modal_dialog{
        width: 650px;
    }
</style>
