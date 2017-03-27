<template>
    <div>
        <div v-if="dataReady">
            <div id="data_table_view">
                <button class="btn-new" @click="$router.push('/roles/create')"><i class="fa fa-plus"
                                                                                  aria-hidden="true"></i>New
                    Role
                </button>
                <div id="searchableTable"></div>
            </div>
        </div>
        <div v-else>
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
                route: 'roles'
            }
        },
        props: ['page'],
        mounted: function () {
            this.dataReady = false;
            //we need to get some data
            console.log(AwesomeTableBuilder)
            AwesomeTableBuilder.getDataThenRenderTable(this);

        },
        methods: {

            renderTable(){
                this.column_definition = columnDefinition(this);
                let searchableTable = AwesomeTableBuilder.createSearchableCollectionTable(this);

                $(function () {
                    searchableTable.addTo('searchableTable')
                })


            }
        }
    }

</script>
