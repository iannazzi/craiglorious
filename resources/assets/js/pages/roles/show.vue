<template>
    <div>
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
            <!--<button @click="showModalTable">pop up modal table</button>-->
            <div id="rights" ></div>

        </div>
        <div v-else>
            <zzi-matrix></zzi-matrix>
        </div>

    </div>
</template>

<script>
    import columnDefinition from './columnDefinition'

    export default {
        data() {
            return {
                data: {},
                dataReady: false
            }
        },
        props: ['page','justcreated'],
        mounted: function () {
            console.log(this.justcreated);
            let self = this;
            self.dataReady = false;
            //bus.$emit('zzwaitevent');

            if (self.page == 'create') {
                getData(self, '/roles/create');
            }
            else {
                getData(self, '/roles/' + this.$route.params.id);
            }
        },
        created(){


        },
        methods: {

//            getData(route)
//            {
//                let self = this;
//                client({path: route}).then(
//                    function (response) {
//                        console.log(response);
//                        self.data = response.data;
//                        self.dataReady = true;
//                        self.renderTable();
//                    });
//            },
//            showModalTable(){
//                let self = this;
//                let roleTableModal = this.createRoleTable();
//                roleTableModal.options.table_view = 'edit';
//                roleTableModal.options.edit_display = 'modal_only';
//                roleTableModal.options.access = 'write';
//                self.roleTableModal = roleTableModal;
//                roleTableModal.options.onSaveSuccess = function(){
//                    self.roleTable.model.tdo = self.roleTableModal.modelModal.tdo;
//                    self.roleTable.view.updateTable();
//                    roleTableModal.hideModal();
//                }
//                roleTableModal.addTo('role_modal');
//                roleTableModal.showModal();
//
//
//            },
            createRoleTable(){
                let self = this;
                let access,edit_display;
                if(this.page == 'show'){
                    access = 'read';
                    edit_display = 'modal';

                }
                else{
                    access = 'write';
                    edit_display = 'on_page';

                }

                return new AwesomeTable({
                    //name: "role",
                    data: self.data.role,
                    route: "/roles",
                    column_definition: columnDefinition(self),
                    table_buttons: ['edit','delete'],

                    type: 'record', //record, collection or searchable
                    table_view: self.page, //index, create, edit, and show pages: columns respond differnetly to
                    access: access, //read vs write
                    edit_display: edit_display,

                    onDeleteSuccess(){
                        //back to roles
                        self.$router.push('/roles');
                    },
                    onCreateSaved(id){
                        //pop up a modal
                        // this.create() //check the display
                        //back to roles
                        self.$router.push({path: '/roles/'+id, props : { justcreated: 'true' }});
                    },
                    onCancelCreateClick(){
                        self.$router.push('/roles');
                    }

                })
            },
            renderTable(){


                let self = this;

                let roleTable = this.createRoleTable();
                self.roleTable = roleTable;


                //No editing if the admin role
                console.log(self.page);
                if (self.page == 'show'){

                    if(self.data.role[0].id == 1) {
                        roleTable.options.table_buttons = [];
                    }
                }
                $(function(){

                    roleTable.addTo('role');
                    if(self.page == 'show'){
                        let access_table_column_definition = [
                            {
                                "db_field": "view_id",
                                "caption": "view_id",
                                "type": "html",
                                "show_on_list": false,
                                "th_width": 80,
                            },
                            {
                                "db_field": "name",
                                "caption": "View",
                                "type": "html",
                                "show_on_list": true,
                                "th_width": 80,
                                'post':false,
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
                            data: self.data.views,
                            //name: "views_table",
                            additionalPostValues:{
                                id: self.data.role[0].id
                            },
                            //tuck read/write away?
                            //show: read
                            //edit: write
                            //create: write

                            type: 'collection', //record, collection or searchable
                            //table_view: 'index', //index, edit,show,create used for column_definition show_on_index, show_on_create show_on_edit
                            edit_display:'modal', //how to edit the data on_page (default, confusing if there are multiple tables) modal_only modal

                            table_buttons: ['edit'],
                            route: "/roles/rights",
                            column_definition: access_table_column_definition,
                        })
                        if(self.data.role[0].id == 1) {
                            accessTable.options.table_buttons = [];
                        }
                        accessTable.addTo('rights');



                    }
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
