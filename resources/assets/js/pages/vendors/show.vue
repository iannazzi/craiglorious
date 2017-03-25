<template>

    <div>
        <zzi-wait></zzi-wait>
        <div v-if="dataReady">

            <button class="btn-back" @click="$router.push('/vendors')"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
                To Vendor List
            </button>
            <button v-if="page!='create'" class="btn-new" @click="$router.push('/vendors/create')"><i class="fa fa-plus"
                                                                                                    aria-hidden="true"></i>New
                Vendor
            </button>

            <div id="user" class="recordTableView">
                <h2 v-if="page==='create'">New Vendor</h2>
                <h2 v-else-if="page==='edit'">Edit Vendor {{data.records[0].name}} </h2>
                <h2 v-else-if="page==='show'">Vendor {{data.records[0].name}}</h2>
            </div>

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
        props: ['page', 'justcreated'],
        mounted: function () {

            console.log(this.justcreated);
            let self = this;
            self.dataReady = false;
            //bus.$emit('zzwaitevent');
            if (self.page == 'create') {
                self.getData('/vendors/create');
            }
            else {
                self.getData('/vendors/' + this.$route.params.id);
            }

        },
    methods: {
        getData(route)
        {
            let self = this;

            client({path: route}).then(
                function (response) {
                    console.log(response);
                    self.data = response.data;
                    self.dataReady = true;
                    self.renderTable();
                    bus.$emit('zzwaitoverevent');

                });
        },
        createTable()
        {
            let self = this;
            let access, edit_display;
            if(this.page == 'show'){
                access = 'read';
                edit_display = 'on_page';
            }
            else{
                access = 'write';
                edit_display = 'on_page';
            }
            let route = '/vendors';
            return new AwesomeTable({
                data: self.data.records,
                route: route,
                column_definition: columnDefinition(self.data),
                table_buttons: ['edit', 'delete'],

                type: 'record', //record, collection or searchable
                table_view: self.page, //index, create, edit, and show pages: columns respond differnetly to
                access: access, //read vs write
                edit_display: edit_display,


                onDeleteSuccess(){
                    //back to roles
                    self.$router.push(route);
                },
                onCreateSaved(id){
                    self.$router.push({path: route+ '/' + id, props: {justcreated: 'true'}});
                },
                onCancelCreateClick(){
                    self.$router.push(route);
                }

            })
        }
    ,
        renderTable()
        {

            let self= this;
            $(function () {
                self.createTable().addTo('user');
            })
        }
    }
    }

</script>
