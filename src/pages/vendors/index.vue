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
        mixins: [searchPageMixins],
        props: ['page', 'route'],
        mounted: function () {


            //failure here
            //search
            //reset
            //dashboard
            //page


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
                    console.log('loading from storage')
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
                                console.log(awesomeTable.controller.sort.getSort());
                                awesomeTable.controller.sort.loadSortFromStorage()
                                awesomeTable.controller.sort.renderSort();
                                component.$router.push({path: '/' + component.route, query: awesomeTable.controller.getQueryValues()})

                            }
                        },
                        onError(response) {
                            console.log('error')
                            console.log(response)
                        }
                    })

                }
                else{
                    console.log('loading default values')
                    awesomeTable.controller.populateSearchValuesFromDefaultValues()
                    let request = awesomeTable.controller.getSearchPostData();
                    console.log(request);
                    request.number_of_records = 300;

                    //I could go to the server, check how many records are available, come back, go back and get them

                    //I could go to the server, if the threshold is good send back the default search....

                    getData( {
                        method: 'get',
                        url: component.route,
                        entity: {'number_of_records':300},
                        onSuccess(response) {
                            console.log('response')
                            console.log(response)
                            if(response.data.number_of_records_available <= 300){
                                awesomeTable.controller.onSearchClicked()
                            }
                        },
                        onError(response) {

                        }
                    })

                    //                    awesomeTable.controller.sort.loadSortFromDefault()


                }
            })
        },
    }


</script>
<style>
    #sr0sc0{
        width:200px;
    }
</style>