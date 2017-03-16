import {DataTableController} from './DataTableController'
import {parseQuery} from '../../lib/url'
import {SearchTableEvents} from './SearchTableEvents';

export class SearchTableController extends DataTableController {
    constructor(model, view) {
        super(model, view)
        let self = this;
        this.show_records_autmatically_below = 50;
        this.saved_search = this.model.td.name + '_saved_search';
        this.number_of_records_available = model.options.number_of_records_available;

        this.searchTableEvents = new SearchTableEvents(this);

        //this piece of code rots... it is trying to reload the page
        //when using the back button the url says the right thing, but page will not reload
        //adding this code will allow the back button to work once.

        window.onpopstate = function (event) {
            window.location.href = window.location.href;
        };
    }

    setFocusToFirstInputOfSearch() {
        this.view.search_elements[0].focus();
        this.view.search_elements[0].select();
    }
    loadData(data){
        // console.log(data)
        let ret_data = data.data;
        this.number_of_records_available = ret_data.length;
        this.model.loadData(ret_data)
        this.model.sortData(this.view.saved_sort_array)
        this.model.original_data = ret_data;
        this.loadInitialData();
    }
    loadInitialData() {
        if (this.number_of_records_available > 0 && this.model.tdo.length == 0) {
            //if there are only a small amount of records go ahead and grab those....
            if (this.number_of_records_available < this.show_records_autmatically_below) {
                this.view.searchClicked.notify()
            }
            else {

                this.view.addMessageInsteadOfTable(`There are ${this.number_of_records_available} records available... please search to see the data. To sort data returned click on the column header. You may also use shift+click for multiple column sorting.`)
            }


        }
        else if (this.number_of_records_available == 0 && this.model.tdo.length == 0) {
            this.view.addMessageInsteadOfTable(`There are 0 records available.`)
        }
        else {
            //these should be all the records
            this.view.addDataTable();
            this.setFocusToFirstInputOfSearch()

        }
    }

    populateSearchValuesFromDefaultValues()
    {
        this.model.cdo.forEach(col_def => {
            if (typeof col_def['search_default'] != 'undefined') {
                if (col_def['type'] == 'date'){
                    col_def.search_element[0].value = col_def.search_default;
                    col_def.search_element[1].value = col_def.search_default;
                }
                else
                {
                    col_def.search_element.value = col_def.search_default;
                }
            }
        })
    }

    submitSearch() {
        this.searching.notify();
        this.saveSearch()
        let post_data = {};
        post_data['search_fields'] = {};
        post_data['table_name'] = this.view.name;
        this.view.search_elements.forEach(element => {
            post_data.search_fields[element.name] = element.value;
        })
        // $('#' + this.table_name + '_search_results').html('');
        // $('#' + this.table_name + '_search_buttons').hide();
        // $('#' + this.table_name + '_search_loading_image').show();
        console.log('I need this for testing.... search post data');
        // console.log(post_data);
        console.log(JSON.stringify(post_data))
        let self = this;
        $.post(this.model.td.route + '/search', post_data,
            function (response) {
                self.searchReturned.notify(response)
            });

    }
    saveSearch(){
        let uri = new JsUri(window.location.href)
        this.addSearchToUri(uri)
        this.removeSortFromUri(uri)
        this.pushState(uri);
        this.resetStoredSort();
        this.storeSearch();
    }
    resetStoredSort(){
        this.saved_sort_array = [];
    }
    resetSearch() {
        this.view.search_elements.forEach(element => {
            switch (element.type) {
                case 'tree_select':
                case 'select-multiple':
                case 'select-one':
                    element.value = 'null'
                    break
                default:
                    element.value = ''
            }
        })
        this.setFocusToFirstInputOfSearch()
        this.view.addMessageInsteadOfTable(`Press search to display results`)

        let uri = new JsUri(window.location.href)
        this.deleteValuesFromUri(uri);
        this.removeSortFromUri(uri);
        console.log(uri.toString())
        this.pushState(uri);

        delete sessionStorage[this.saved_search];
        delete sessionStorage[this.saved_sort];
        this.resetStoredSort();
    }

    checkForUriSearch() {
        let uri = new JsUri(window.location.href)
        for (let i = 0; i < this.view.search_elements.length; i++) {
            if (uri.getQueryParamValue(this.view.search_elements[i].name)) {
                return true;
            }
        }
        return false;
    }

    checkStorageForSearch() {
        console.log('this saved search ' + this.saved_search);
        return sessionStorage[this.saved_search]

    }

    populateSearchValuesFromUri() {
        let uri = new JsUri(window.location.href)
        this.view.search_elements.forEach(element => {
            if (uri.getQueryParamValue(element.name)) {
                element.value = uri.getQueryParamValue(element.name)
            }
        })
    }

    populateSearchValuesFromStorage() {
        console.log('loading search values from storage')
        console.log(sessionStorage[this.saved_search])
        let stored_values = this.retrieveSearch();
        this.view.search_elements.forEach(element => {
            if (stored_values[element.name]) {
                element.value = stored_values[element.name]
            }
        })
        //now add the elements to the uri
        let uri = new JsUri(window.location.href)
        this.addSearchToUri(uri);
        // ? this.pushState(uri)

    }

    getSearchValues() {
        let search_values = {};
        let name = this.view.name + '_search';
        //search_values[name] = 'true';

        this.view.search_elements.forEach(element => {
            switch (element.type) {
                case 'text':
                case 'number':
                case 'date':
                    name = element.name
                    search_values[name] = element.value;
                    if (element.value != '') {
                    }
                    break;
                case 'tree_select':
                case 'select-multiple':
                case 'select-one':
                    name = element.name
                    search_values[name] = element.value;
                    if (element.value != 'null') {
                    }
                    break;
                default:
            }
        })
        return search_values;

    }

    deleteValuesFromUri(uri) {
        this.view.search_elements.forEach(element => {
            uri.deleteQueryParam(element.name)
        })
    }


    addSearchToUri(uri) {

        //load the cuurent url using the jsuri library
        this.view.search_elements.forEach(element => {
            uri.deleteQueryParam(element.name)
        })
        //additionally remove the search set flag so it will
        // not duplicate
        //uri.deleteQueryParam(this.view.name + '_search', 'true')
        // if(uri.getQueryParamValue()){
        //     uri.addQueryParam(this.view.name + '_search', 'true')
        // }
        let search_values = this.getSearchValues();
        for (let i in search_values) {
            uri.addQueryParam(i, search_values[i])
        }

    }



    storeSearch() {
        sessionStorage[this.saved_search] = JSON.stringify(this.getSearchValues());
    }

    retrieveSearch() {
        return JSON.parse(sessionStorage[this.saved_search]);
    }


}