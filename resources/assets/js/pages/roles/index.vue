<template>
    <div>
        <div v-show="dataReady">
            <div id="data_table_view">
                <button class="btn-new" @click="$router.push('/roles/create')"><i class="fa fa-plus"
                                                                                  aria-hidden="true"></i>New
                    Role
                </button>
                <div id="searchableTable"></div>
                    <zzi-matrix v-if="searchingCollection"></zzi-matrix>
            </div>
        </div>
        <div v-show="!dataReady">
            <zzi-matrix></zzi-matrix>
        </div>
    </div>


</template>

<script>

    import columnDefinition from './columnDefinition'
//    import {AwesomeTable} from '../../elements/tables/AwesomeTable';


    export default {
        data() {
            return {
                data: {},
                dataReady: false,
                searchingCollection: false,
                route: 'roles',
                searchableTable:null

            }
        },
        props: ['page'],
        mounted: function () {

            this.dataReady = false
            AwesomeTableWrapper.getPageDataThenRenderSearchTable(this);

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
        watch: {
            $route () {
                console.log('route changed')
                console.log( this.$route.query.sort)

                if(this.$route.query.sort === undefined){
                    this.searchingCollection = true;
                    this.searchableTable.removeResultsTable();
                    this.searchableTable.options.search_query = this.$route.fullPath;
                    this.searchableTable.updateSearchPage();
                }
                else
                {
                    //sort change just update the table view
                }





            }
        }
    }

</script>
