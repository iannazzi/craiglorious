import {getData} from './getData'
// import {AwesomeTable} from '../elements/tables/AwesomeTable';
import {AwesomeTable} from '@iannazzi/awesome-table'

export class AwesomeTableWrapper {
    constructor() {
        //how to handle modal??? that is this wrapper's job...
        this.AwesomeTable = AwesomeTable;
    }

    //most pages with tables need to get data then display it
    loadDataAndRenderTable(component) {
        return function (response) {
            //this is page data.....
            console.log(response)
            transfomer.removeNull(response.data.records);
            component.data = response.data;
            component.renderTable();
            component.dataReady = true;

        }

    }

    //most record pages have show edit and create with corresponding tables
    createShowEditOrCreateRecordTable(component) {
        let access;
        if (component.page == 'show') {
            access = 'read';
        }
        else {
            access = 'write';
        }
        let awesomeTable = new AwesomeTable('record');

        let config = {
            //name: "role",
            data: component.data.records,
            route: component.route,
            name: component.route,
            column_definition: component.column_definition,
            table_buttons: ['edit', 'delete'],
            access: access, //read vs write
            onSaveSuccess(){
                delete cached_page_data[component.route]
            },
            onDelete(){
                component.loading = true;
            },
            onDeleteSuccess(){
                //back to roles
                component.loading = false;
                delete cached_page_data[component.route]
                component.$router.push('/' + component.route);
            },
            onCreateSaved(id){
                //pop up a modal
                // this.create() //check the display
                //back to roles
                console.log('saving....')
                component.dataReady = false;
                delete cached_page_data[component.route]
                component.$router.push({path: '/' + component.route + '/' + id, props: {justcreated: 'true'}});

            },
            onCancelCreateClick(){
                component.$router.push('/' + component.route);
            }

        }
        awesomeTable.loadConfiguration(config);

        return awesomeTable;

    }

    createSearchableCollectionTable(component, number_of_records_to_automatically_get = 100) {

        let awesomeTable = new AwesomeTable('searchable')
        let config = {

            name: component.route,
            access: "read",
            table_buttons: [],
            column_definition: component.column_definition,
            data: component.data,
            number_of_records_available: component.data.number_of_records_available,
            number_of_records_to_automatically_get,
            search_query: component.$root.$route.fullPath,
            search_route: component.route + '/search',
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
            }

        }
        config.onSearchClick = function(query){

            //awesomeTable.controller.storeSearch();
            let search_values = awesomeTable.controller.getSearchFormValues();
            window.localStorage.setItem(awesomeTable.controller.getStoredSearchName(),JSON.stringify(search_values))

            //remove sorting...
            awesomeTable.controller.sort.removeAllSort()

            //update the url....
            component.$router.push({path: '/' + component.route, query: awesomeTable.controller.getQueryValues()})

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
                        //got some double hitting.... we want the data, then we want to sort, then render
                        awesomeTable.controller.renderSearch(response.data.records)
                        awesomeTable.controller.sort.loadSortFromDefault()
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





        },
        awesomeTable.loadConfiguration(config);
        return awesomeTable;
    }

    loadRecordTableDataThenCallRenderTable(component) {
        component.dataReady = false;
        let url = '/' + component.route + '/create';
        if (component.page != 'create') {
            url = '/' + component.route + '/' + component.$route.params.id;
        }
        let self = this;
        this.getData({
            method: 'get',
            url: url,
            entity: false,
            onSuccess: self.loadDataAndRenderTable(component)
        })
    }

    getPageDataThenRenderSearchTable(component) {

        if (cached_page_data[component.route]) {
            //for components that need no data i can just set the page cache once....
            console.log('cached page data');
            component.renderTable();
            component.dataReady = true;
        }
        else {
            let self = this;
            this.getData({
                method: 'get',
                url: component.route,
                //            params: {number_of_records:number_of_records},
                onSuccess: self.loadDataAndRenderTable(component)

            })
        }


    }

    getPageData(component) {
        let self = this;
        let data = this.getData({
            method: 'get',
            url: component.route,
            //            params: {number_of_records:number_of_records},
            onSuccess: function(response){
                console.log(response)
                transfomer.removeNull(response.data.records);
                return response
            }

        })
        console.log('data')
        console.log(data)

    }


}