<template>

    <div>
        <div v-if="dataReady">

            <button class="btn-back" @click="$router.push('/locations')"><i class="fa fa-arrow-left" aria-hidden="true"></i>Back
                To Location List
            </button>
            <button v-if="page!='create'" class="btn-new" @click="$router.push('/locations/create')"><i class="fa fa-plus"
                                                                                                    aria-hidden="true"></i>New
                Location
            </button>

            <div id="record_table" class="recordTableView">
                <h2 v-if="page==='create'">New Location</h2>
                <h2 v-else-if="page==='edit'">Edit Location {{data.records[0].name}} </h2>
                <h2 v-else-if="page==='show'">Location {{data.records[0].name}}</h2>
            </div>

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
                dataReady: false,
                route: 'locations'
            }
        },
        props: ['page','justcreated'],
        mounted: function () {

            AwesomeTableBuilder.loadRecordTableDataThenCallRenderTable(this)

        },
        methods: {
            renderTable(){
                let self = this;
                this.column_definition = columnDefinition(this);
                let recordTable = AwesomeTableBuilder.createShowEditOrCreateRecordTable(this);


                $(function(){
                    recordTable.addTo('record_table');
                    bus.$emit('zzwaitoverevent');
                })
            }
        }
    }

</script>
