<template>

    <div>
        <div v-if="dataReady">

            <button class="btn-back" @click="$router.push('/'+route)"><i class="fa fa-arrow-left"
                                                                         aria-hidden="true"></i>Back
                To {{modelName}} List
            </button>
            <button v-if="page!='create'" class="btn-new" @click="$router.push('/'+ route + '/create')"><i
                    class="fa fa-plus"
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
        <div id="confirmModal"></div>

    </div>
</template>


<script>
    import columnDefinition from './columnDefinition'
    import recordPageMixins from '../../controllers/recordPageMixins'
    import {createConfirmModal} from '../../elements/modal/confirmModal'


    export default {
        data() {
            return {
                data: {},
                dataReady: false,
            }
        },
        props: ['page', 'justcreated', 'route'],
        mounted: function () {

            AwesomeTableWrapper.renderRecordTable(this, columnDefinition, 'record_table')

        },
        mixins: [recordPageMixins],
    }

</script>
<style>
    #vendors_table {
        width: 600px;
    }
</style>