<template>
    <div>
        <div v-if="dataReady">

            <button class="btn-back" @click="$router.push('/'+route)"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
                To {{modelName}} List
            </button>
            <button v-if="page!='create'" class="btn-new" @click="$router.push('/'+route +'/create')"><i class="fa fa-plus"
                                                                                                    aria-hidden="true"></i>New
                {{modelName}}
            </button>

            <div id="record_table" class="recordTableView">
                <h2 v-if="page==='create'">New {{modelName}}</h2>
                <h2 v-else-if="data.records[0].id==1">Admin Role - No Editing is possible</h2>
                <h2 v-else-if="page==='edit'">Edit {{modelName}} {{data.records[0].name}} </h2>
                <h2 v-else-if="page==='show'">{{modelName}} {{data.records[0].name}}</h2>
            </div>
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
    import recordPageMixins from '../../controllers/recordPageMixins'


    export default {
        data() {
            return {
                data: {},
                dataReady: false,
            }
        },
        mixins:[recordPageMixins],
        props: ['page','justcreated', 'route'],
        mounted: function () {
            console.log(this.route)
            AwesomeTableWrapper.loadRecordTableDataThenCallRenderTable(this)

        },
        methods: {
            renderTable(){
                let self = this;
                self.dataReady = true;
                this.column_definition = columnDefinition(this);
                let recordTable = AwesomeTableWrapper.createShowEditOrCreateRecordTable(this);
                recordTable.options.onSaveSuccess = function (){
                    //remove cached data as an update o

                }

                //No editing if the admin role
                if (self.page == 'show'){
                    if(self.data.records[0].id == 1) {
                        recordTable.options.table_buttons = [];
                    }
                }
                $(function(){

                    recordTable.addTo('record_table');
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
                                id: self.data.records[0].id
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
                            getData:getData
                        })
                        if(self.data.records[0].id == 1) {
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
