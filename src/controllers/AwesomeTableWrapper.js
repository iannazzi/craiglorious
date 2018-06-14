import {getData} from './getData'
import {AwesomeTable} from '@iannazzi/awesome-table'
import {ErrorModal} from '../elements/modal/ErrorModal'

export class AwesomeTableWrapper {
    constructor() {
    }
    newSearchTable() {
        return new AwesomeTable('searchable');
    }
    createSearchableCollectionConfig(awesomeTable, component, number_of_records_to_automatically_get = 100) {

        //let awesomeTable = new AwesomeTable('searchable')
        let config = {

            name: component.route,
            access: "read",
            table_view: 'index',
            table_buttons: [],
            column_definition: component.column_definition,
            data: component.data,
            //number_of_records_available: component.data.number_of_records_available,
            //number_of_records_to_automatically_get,
            //search_query: component.$root.$route.fullPath,
            //search_route: component.route + '/search',
            //initial_page_load_data: component.data.records,
            onUriLoadPageStart(){
                //we came to a page with a search in the uri
                //this could have come from the stored search
                console.log('onLoadPageStart')
                component.loading = true;
            },
            onLoadPageComplete(){
                console.log('onLoadPageComplete')
                component.dataReady = true;
                component.loading = false;
            },
            loadPageFromStorage(query){
                console.log('awsome table wrapper load from storage')
                component.$router.replace({path: '/' + component.route, query: query})
            },
            onSearching(){
                console.log('searching')

                component.loading = true;

            },
            onInitialLoadPage(){
                //we came into the page with no search stored,
                //from the server we may have retrieved some data

            },

            onHeaderClick(data){
                //we need both the search and the sort query now.....
                awesomeTable.controller.sort.storeSort();
                component.$router.push({path: '/' + component.route, query: awesomeTable.controller.getQueryValues()})
            },
            onResetClick(){
                //kill storage and push to
                component.$route.meta['reset'] = true;
                component.$router.push({path: '/' + component.route, query: {}})
            },
            router(data){
                component.$router.push({path: '/' + component.route + '/search', query: {data}})
            },
            onSearchSuccess(){
                component.searching = false;
            },
            beforeSearchClicked(){
                component.searching = true;
            },
            onRowClick(row){
                let id = awesomeTable.getValue('id', row);
                component.$router.push(component.route + '/' + id)
            }

        }
        config.onSearchClick = function (query) {

            awesomeTable.controller.storeSearch();
            // let search_values = awesomeTable.controller.getSearchFormValues();
            // window.localStorage.setItem(awesomeTable.controller.getStoredSearchName(),JSON.stringify(search_values))

            //remove sorting... no there may not be
//

            //update the url....
            component.$router.push({path: '/' + component.route, query: awesomeTable.controller.getQueryValues()})

            getData({
                method: 'post',
                url: component.route + '/search',
                entity: awesomeTable.controller.getSearchPostData(),
                onSuccess(response) {
                    console.log('response')

                    console.log(response)
                    if (response.data.records.length == 0) {
                        awesomeTable.view.addMessageInsteadOfTable('no data')
                    }
                    else {
                        //got some double hitting.... we want the data, then we want to sort, then render
                        awesomeTable.controller.renderSearch(response.data.records)
                        awesomeTable.controller.sort.removeAllSort()
                        console.log('loading sort from default')
                        awesomeTable.controller.sort.loadSortFromDefault()
                        awesomeTable.controller.sort.storeSort();
                        awesomeTable.controller.sort.renderSort();


                    }
                },
                onError(response) {

                    console.log('error')
                    console.log(response)
                }
            })

            return [];

            //so originally I pushed a new url and dealt with it that way....its just really confusing
            //console.log('awesome table wrapper on search click query will only change if url changes')

            //component.$router.push({path: '/' + component.route, query: query})


        }
            //awesomeTable.loadConfiguration(config);
        return config;
    }
    renderSearchTable(awesomeTable, component, columnDefinition, div_id, callback) {

        component.column_definition = columnDefinition(component);

        //let awesomeTable = this.createSearchableCollectionTable(component, 100);
        let config = this.createSearchableCollectionConfig(awesomeTable, component, 100)
        awesomeTable.loadConfiguration(config);
        awesomeTable.addTo(div_id);
        component.loading = true;
        let query = component.$route.query
        //if there is data on the url load that first....
        if (awesomeTable.controller.checkQuery(query)) {
            awesomeTable.controller.loadSearchValues(query);
            getData({
                method: 'post',
                url: component.route + '/search',
                entity: awesomeTable.controller.getSearchPostData(),
                onSuccess(response) {
                    console.log('response')
                    component.loading = false;

                    console.log(response)
                    if (response.data.records.length == 0) {
                        awesomeTable.view.addMessageInsteadOfTable('no data')
                    }
                    else {
                        awesomeTable.controller.renderSearch(response.data.records)
                        awesomeTable.controller.sort.loadSortFromQuery(query)
                        awesomeTable.controller.sort.renderSort();
                    }
                    if (typeof callback === 'function') {
                        callback()
                    }
                },
                onError(response) {
                    console.log('error')
                    console.log(response)
                }
            })
        }
        //next check the storage...
        else if (awesomeTable.controller.checkSearchStorage()) {
            console.log('loading from storage')
            awesomeTable.controller.loadSearchFromStorage()
            getData({
                method: 'post',
                url: component.route + '/search',
                entity: awesomeTable.controller.getSearchPostData(),
                onSuccess(response) {
                    console.log('response')
                    component.loading = false;

                    console.log(response)
                    if (response.data.records.length == 0) {
                        awesomeTable.view.addMessageInsteadOfTable('no data')
                    }
                    else {
                        awesomeTable.controller.renderSearch(response.data.records)
                        console.log('loading sort from storage')
                        console.log(awesomeTable.controller.sort.getSort());
                        awesomeTable.controller.sort.loadSortFromStorage()
                        awesomeTable.controller.sort.renderSort();
                        component.$router.push({
                            path: '/' + component.route,
                            query: awesomeTable.controller.getQueryValues()
                        })

                    }
                },
                onError(response) {
                    console.log('error')
                    console.log(response)
                }
            })

        }
        else {
            console.log('loading default values')
            awesomeTable.controller.populateSearchValuesFromDefaultValues()
            let request = awesomeTable.controller.getSearchPostData();
            console.log(request);
            request.number_of_records = 300;

            //I could go to the server, check how many records are available, come back, go back and get them

            //I could go to the server, if the threshold is good send back the default search....

            getData({
                method: 'get',
                url: component.route,
                entity: {'number_of_records': 300},
                onSuccess(response) {
                    component.loading = false;

                    console.log('response')
                    console.log(response)
                    if (response.data.number_of_records_available <= 300) {
                        awesomeTable.controller.onSearchClicked()
                    }
                },
                onError(response) {

                }
            })

            //                    awesomeTable.controller.sort.loadSortFromDefault()


        }
    }
    getDataThenRenderSearchTable(awesomeTable, component, columnDefinition, div_id, callback) {
        let self = this;
        getData( {
            method: 'get',
            url: component.route,
            entity: {'number_of_records':300},
            onSuccess(response) {
                console.log(response);
                component.dataReady = true;
                component.data = response.data;
                component.$nextTick(function () {
                    self.renderSearchTable(awesomeTable, component, columnDefinition, div_id, callback)
                })
            },
            onError(response) {

            }
        })

    }

    newRecordTable() {
        return new AwesomeTable('record');
    }

    createRecordTableConfig(awesomeTable, component) {
        //component now has the route, the page, select values.... etc....
        //what I really want is col_def,
        let access;
        if (component.page == 'show') {
            access = 'read';
        }
        else {
            access = 'write';
        }

        component.errorModal = new ErrorModal(component.route + '_error_modal');


        let config = {
            data: [],
            name: component.route,
            table_view: component.page,
            column_definition: component.column_definition,
            table_buttons: ['edit', 'delete'],
            access: access, //read vs write
            onDeleteClick(){


                if (confirm("Confirm Delete?")) {
                    let post_data = {_method: 'delete', data: {id: component.$route.params.id}};
                    getData({
                        method: 'post',
                        url: component.route,
                        entity: post_data,
                        onSuccess: function (response) {
                            console.log(response)
                            component.$router.push('/' + component.route)
                        }
                    })
                }


            },
            onSaveClick(){
                //only one save event for both

                let post_data = {_method: 'put', data: awesomeTable.controller.getPostData()};
                getData({
                    method: 'post',
                    url: component.route,
                    entity: post_data,
                    onSuccess: function (response) {
                        console.log(response)
                        if (awesomeTable.model.td.table_view == 'create') {
                            component.$router.push({
                                path: '/' + component.route + '/' + response.id,
                                props: {justcreated: 'true'}
                            });

                        } else {
                            awesomeTable.controller.makeReadable();
                        }
                    },
                    onError(response){
                        //so we have an error on the save... now what....
                        //pop up a modal...
                        component.errorModal.addErrorMessage(response.message);
                        component.errorModal.show();
                        //awesomeTable.view.addError(response.message)


                    }
                })


            },

            onCancelCreateClick(){
                if (confirm("Confirm Cancel?")) {
                    component.$router.push('/' + component.route);
                }
            }

        }
        return config;
    }
    renderRecordTable(awesomeTable, component, columnDefinition, div_id, callback) {
        //in order to render the record table
        //we need to go get data
        // then we need to attach the data to the component
        // then we need to build the column definition
        // then we can build up the config
        //then we can render the table
        //then we can do stuff to the table....

        let self = this;
        let url = '/' + component.route + '/create';
        if (component.page != 'create') {
            url = '/' + component.route + '/' + component.$route.params.id;
        }
        getData({
            method: 'get',
            url: url,
            entity: false,
            onSuccess: function (response) {
                component.dataReady = true;
                console.log(response)
                transfomer.removeNull(response.data.records);
                component.data = response.data;
                component.column_definition = columnDefinition(component);
                //let awesomeTable = self.createRecordTable(component);
                let config = self.createRecordTableConfig(awesomeTable, component)
                awesomeTable.loadConfiguration(config);
                Vue.nextTick(function () {
                    awesomeTable.addTo(div_id);
                    awesomeTable.controller.setFocusToFirstInput()
                    document.getElementById(div_id).appendChild(component.errorModal.createErrorModal());
                    if (component.page != 'create') {
                        awesomeTable.controller.loadRecord(response.data.records[0])
                    }
                    if (typeof callback === 'function') {
                        callback()
                    }
                })
                bus.$emit('zzwaitoverevent');
                return awesomeTable;
            }

        })
        return awesomeTable;
    }

    newCollectionTable(){
        return new AwesomeTable('collection');
    }


    //most pages with tables need to get data then display it
    // loadDataAndRenderTable(component) {
    //     return function (response) {
    //         //this is page data.....
    //         console.log(response)
    //         transfomer.removeNull(response.data.records);
    //         component.data = response.data;
    //         component.renderTable();
    //         component.dataReady = true;
    //
    //     }
    //
    // }
    // getPageDataThenRenderSearchTable(component) {
    //
    //     if (cached_page_data[component.route]) {
    //         //for components that need no data i can just set the page cache once....
    //         console.log('cached page data');
    //         component.renderTable();
    //         component.dataReady = true;
    //     }
    //     else {
    //         let self = this;
    //         this.getData({
    //             method: 'get',
    //             url: component.route,
    //             //            params: {number_of_records:number_of_records},
    //             onSuccess: self.loadDataAndRenderTable(component)
    //
    //         })
    //     }
    //
    //
    // }
    //
    // getPageData(component) {
    //     let self = this;
    //     let data = this.getData({
    //         method: 'get',
    //         url: component.route,
    //         //            params: {number_of_records:number_of_records},
    //         onSuccess: function(response){
    //             console.log(response)
    //             transfomer.removeNull(response.data.records);
    //             return response
    //         }
    //
    //     })
    //     console.log('data')
    //     console.log(data)
    //
    // }


}