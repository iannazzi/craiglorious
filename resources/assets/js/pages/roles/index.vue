<template>
    <div>
        <div v-show="dataReady">
            <div id="data_table_view">
                <button class="btn-new" @click="$router.push('/roles/create')"><i class="fa fa-plus"
                                                                                  aria-hidden="true"></i>New
                    Role
                </button>
                <div id="searchableTable"></div>
                    <zzi-matrix v-if="loading"></zzi-matrix>
            </div>
        </div>
        <div v-show="!dataReady">
            <zzi-matrix></zzi-matrix>
        </div>
    </div>


</template>

<script>

    import columnDefinition from './columnDefinition'
    import searchableTableRouteWatcher from '../../controllers/routeWatcher'


    export default {
        data() {
            return {
                data: {},
                dataReady: false,
                loading: false,
                route: 'roles',
                searchableTable:null

            }
        },
        props: ['page'],
        mounted: function () {

            this.dataReady = false
            AwesomeTableWrapper.getPageDataThenRenderSearchTable(this,100);

        },
        methods: {

            renderTable(){
                this.column_definition = columnDefinition(this);
                this.searchableTable = AwesomeTableWrapper.createSearchableCollectionTable(this);

                let self = this;
                $(function () {
                    self.searchableTable.addTo('searchableTable')
                    // self.dataReady = true;

                })


            }
        },
        watch:searchableTableRouteWatcher

    }

</script>
