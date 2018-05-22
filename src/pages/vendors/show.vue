<template>

    <div>
        <div v-if="dataReady">

            <button class="btn-back" @click="$router.push('/'+route)"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
                To {{modelName}} List
            </button>
            <button v-if="page!='create'" class="btn-new" @click="$router.push('/'+ route + '/create')"><i class="fa fa-plus"
                                                                                                           aria-hidden="true"></i>New
                {{modelName}}
            </button>

            <div id="record_table" class="recordTableView">
                <h2 v-if="page==='create'">New {{modelName}}</h2>
                <h2 v-else-if="page==='edit'">Edit {{modelName}} {{data.records[0].name}} </h2>
                <h2 v-else-if="page==='show'">{{modelName}} {{data.records[0].name}}</h2>
            </div>

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
        props: ['page','justcreated', 'route'],
        mounted: function () {

            //AwesomeTableWrapper.loadRecordTableDataThenCallRenderTable(this)

            let component = this;
            this.column_definition = columnDefinition(this);

            component.dataReady = false;
            let url = '/' + component.route + '/create';
            if (component.page != 'create') {
                url = '/' + component.route + '/' + component.$route.params.id;
            }




            let recordTable = AwesomeTableWrapper.createShowEditOrCreateRecordTable(this);



            component.$nextTick(function () {
                getData({
                    method: 'get',
                    url: url,
                    entity: false,
                    onSuccess: function(response){
                        console.log(response)
                        transfomer.removeNull(response.data.records);
                        component.data = response.data;
                        bus.$emit('zzwaitoverevent');
                        component.dataReady = true;
                        console.log(document.getElementById('record_table'));
                        recordTable.addTo('record_table');
                        recordTable.controller.loadRecord(response.data.records)

                    }
                })



            })



        },
        mixins: [recordPageMixins],

        methods: {
            renderTable(){

            }
        }
    }

</script>
