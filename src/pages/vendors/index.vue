<template>


    <div>
        <div v-if="dataReady">
            <div id="data_table_view">
                <button class="btn-new" @click="$router.push('/vendors/create')"><i class="fa fa-plus"
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
        //mixins: [searchPageMixins],
        props: ['page', 'route'],
        mounted: function () {




            //several options to do now.....
            //check the url
            //    awesomeTable.controller.uri.loadFromUri(query);

            //load from storage
            //populate search data

            //load automatic results
            //go get data and render the search table......


            this.dataReady = false;
            let component = this;

            component.dataReady = true;
            component.column_definition = columnDefinition(component);
            let searchableTable = AwesomeTableWrapper.createSearchableCollectionTable(component, 100);
            component.$nextTick(function () {
                // Code that will run only after the
                // entire view has been rendered
                searchableTable.addTo('searchableTable')

            })
            //this is saying go get records right away.... lets back off a bit....
//             getData({
//                method: 'get',
//                url: component.route,
//                //            params: {number_of_records:number_of_records},
//                onSuccess: function(response){
//                    console.log(response)
//                    transfomer.removeNull(response.data.records);
//                    component.data = response.data;
//                    component.dataReady = true;
//
//                    component.column_definition = columnDefinition(component);
//                    let searchableTable = AwesomeTableWrapper.createSearchableCollectionTable(component, 100);
//
//
//                    component.$nextTick(function () {
//                        // Code that will run only after the
//                        // entire view has been rendered
//                        searchableTable.addTo('searchableTable')
//
//                    })
//                    //
//
//                    //component.renderTable();
//                }
//
//            })




        },
    }


</script>
<style>
    #sr0sc0{
        width:200px;
    }
</style>