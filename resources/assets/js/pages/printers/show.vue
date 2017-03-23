<template>

    <div>
        <zzi-wait></zzi-wait>
        <div v-if="dataReady">

            <button class="btn-back" @click="$router.push('/printers')"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
                To Printer List
            </button>
            <button v-if="page!='create'" class="btn-new" @click="$router.push('/printers/create')"><i class="fa fa-plus"
                                                                                                    aria-hidden="true"></i>New
                Printer
            </button>

            <div id="user" class="recordTableView">
                <h2 v-if="page==='create'">New Printer</h2>
                <h2 v-else-if="page==='edit'">Edit Printer {{data.records[0].name}} </h2>
                <h2 v-else-if="page==='show'">Printer {{data.records[0].name}}</h2>
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
                self.getData('/printers/create');
            }
            else {
                self.getData('/printers/' + this.$route.params.id);
            }

        },
    methods: {
        getData(url)
        {
            let self = this;
            $.get(url, function (response) {
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
            let route = '/printers';
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
