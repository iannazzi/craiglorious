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


            this.dataReady = false;
            let component = this;
            component.dataReady = true;
            component.column_definition = columnDefinition(component);
            let awesomeTable = AwesomeTableWrapper.createSearchableCollectionTable(component, 100);

            //all this will get extracted....

            component.$nextTick(function () {

                awesomeTable.addTo('searchableTable')
                let query = component.$route.query
                //if there is data on the url load that first....
                if(awesomeTable.controller.checkQuery(query))
                {
                    awesomeTable.controller.loadSearchValues(query);
                    getData( {
                        method: 'post',
                        url: component.route + '/search',
                        entity: awesomeTable.controller.getSearchPostData(),
                        onSuccess(response) {
                            console.log('response')

                            console.log(response)
                            if (response.data.records.length == 0){
                                awesomeTable.view.addMessageInsteadOfTable('no data')
                            }
                            else{
                                awesomeTable.controller.renderSearch(response.data.records)
                                awesomeTable.controller.sort.loadSortFromQuery(query)
                                awesomeTable.controller.sort.renderSort();
                            }
                        },
                        onError(response) {
                            console.log('error')
                            console.log(response)
                        }
                    })
                }
                //next check the storage...
                else if(awesomeTable.controller.checkSearchStorage()) {
                    awesomeTable.controller.loadSearchFromStorage()
                    getData( {
                        method: 'post',
                        url: component.route + '/search',
                        entity: awesomeTable.controller.getSearchPostData(),
                        onSuccess(response) {
                            console.log('response')

                            console.log(response)
                            if (response.data.records.length == 0){
                                awesomeTable.view.addMessageInsteadOfTable('no data')
                            }
                            else{
                                awesomeTable.controller.renderSearch(response.data.records)
                                console.log('loading sort from storage')
                                console.log(awesomeTable.controller.sort.getSort())
                                awesomeTable.controller.sort.loadSortFromStorage()
                                awesomeTable.controller.sort.renderSort();
                            }
                        },
                        onError(response) {
                            console.log('error')
                            console.log(response)
                        }
                    })


                }
                else{
                    awesomeTable.controller.populateSearchValuesFromDefaultValues()
                    console.log(number_of_records)

                    //now here can we just go get some shizz????

                    //                    awesomeTable.controller.sort.loadSortFromDefault()


                }




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