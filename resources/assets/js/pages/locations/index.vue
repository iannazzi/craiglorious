<template>


    <div>
        <div v-if="dataReady">
            <div id="data_table_view">
                <button class="btn-new" @click="$router.push('/locations/create')"><i class="fa fa-plus" aria-hidden="true"></i>New
                    Location
                </button>
                <div id="searchableTable"></div>
                <zzi-matrix v-if="loading"></zzi-matrix>
            </div>
        </div>
        <div v-else>
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
                route: 'locations',
                loading: false,
                searchableTable:null
            }
        },
        props: ['page'],
        mounted: function () {
            this.dataReady = false;
            AwesomeTableWrapper.getPageDataThenRenderSearchTable(this,100);

        },
        methods: {
            test(){
                console.log('route changed')
                //was it a reset?

                console.log(this.$route.query.sort)

                if (this.$route.query.sort === undefined) {
                    if (this.$route.meta.reset) {
                        //reset was pressed... actually do nothing here
                        this.$route.meta['reset'] = false;
                    }
                    else {
                        this.loading = true;
                        this.searchableTable.removeResultsTable();
                        this.searchableTable.options.search_query = this.$route.fullPath;
                        this.searchableTable.updateSearchPage();
                    }

                }
                else {
                    //sort change just update the table view
                }
            },
            renderTable(){
                let self = this;
                this.column_definition = columnDefinition(this);
                this.searchableTable = AwesomeTableWrapper.createSearchableCollectionTable(this);

                $(function () {
                    self.searchableTable.addTo('searchableTable')
                })


            }
        },
        watch:searchableTableRouteWatcher



    }





</script>
