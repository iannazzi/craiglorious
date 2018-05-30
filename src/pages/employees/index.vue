<template>


    <div>
        <div v-if="dataReady">
            <div id="data_table_view">
                <button class="btn-new" @click="$router.push('/employees/create')"><i class="fa fa-plus"
                                                                                      aria-hidden="true"></i>New
                    {{modelName}}
                </button>
                <div id="searchableTable"></div>
                <zzi-matrix2 v-if="loading"></zzi-matrix2>
            </div>
        </div>
        <div v-else>
            <zzi-matrix></zzi-matrix>
        </div>
    </div>


</template>

<script>

    import columnDefinition from './columnDefinition'
    import searchPageMixins from '../../controllers/searchPageMixins'


    export default {
        data() {
            return {
                data: {},
                dataReady: false,
                loading: false,
                searchableTable: null
            }
        },
        mixins: [searchPageMixins],
        props: ['page', 'route'],
        mounted: function () {

            let component = this;
            let awesomeTable = AwesomeTableWrapper.newSearchTable();
            let callback = function(){
                //do what we want with awesomeTable.....
            }
            AwesomeTableWrapper.getDataThenRenderSearchTable(awesomeTable,component, columnDefinition, 'searchableTable', callback)


        },
        methods: {

        },
    }


</script>
