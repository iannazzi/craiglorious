export class UriController{
    constructor(name){
        this.stored_search_key = name + '_search';
        this.stored_sort_key = name + '_sort';
    }


    //search from uri
    //sort from uri
    //search from storage
    //sort from storage
    pushState(uri) {
        let stateObj = {url: uri.toString(), innerhtml: document.body.innerHTML};
        window.history.pushState(stateObj, uri.toString(), uri.toString());
    }

    //uri
    onSearch(search_elements,search_values,table_header_elements){
        let uri = new JsUri(window.location.href)
        this.addSearchToUri(uri,search_elements, search_values);
        this.removeSortFromUri(uri,table_header_elements)
        this.pushState(uri);
        this.resetStoredSort();
        this.storeSearch(search_values);
    }

    addSearchToUri(uri,search_elements, search_values) {

        //load the cuurent url using the jsuri library
        search_elements.forEach(element => {
            uri.deleteQueryParam(element.name)
        })
        //additionally remove the search set flag so it will
        // not duplicate
        //uri.deleteQueryParam(this.view.name + '_search', 'true')
        // if(uri.getQueryParamValue()){
        //     uri.addQueryParam(this.view.name + '_search', 'true')
        // }
        for (let i in search_values) {
            uri.addQueryParam(i, search_values[i])
        }

    }
    deleteSearchValuesFromUri(uri, search_elements) {
        search_elements.forEach(element => {
            uri.deleteQueryParam(element.name)
        })
    }
    checkUri(search_elements) {
        let uri = new JsUri(window.location.href)
        for (let i = 0; i < search_elements.length; i++) {
            if (uri.getQueryParamValue(search_elements[i].name)) {
                return true;
            }
        }
        return false;
    }
    loadFromUri(search_elements){
        console.log('loading search from uri')
        this.loadSearchValuesFromUri(search_elements)
        this.loadSortArrayFromUri();
    }

    loadSearchValuesFromUri(search_elements) {

        let uri = new JsUri(window.location.href)

        search_elements.forEach(element => {
            if (uri.getQueryParamValue(element.name)) {
                element.value = uri.getQueryParamValue(element.name)
            }
        })

    }

    onSort(args, header_element_array){
        //coming in from click the header
        //set the uri and stored uri
        let uri = new JsUri(window.location.href)
        let event = args[0];
        let th = args[1];
        //this code is the tri-selector: switches between none, asc, and desc
        let sort_array = ['none', 'asc', 'desc'];
        let i = th.sort;
        i = ++i % sort_array.length;
        th.sort = i;

        let name = th.col_def.db_field
        let self = this;

        if (!event.shiftKey) {
            this.removeSortFromUri(uri, header_element_array,th)
            header_element_array.forEach(th_element => {
                if (th != th_element) {
                    this.removeSortFromSavedArray(th_element.col_def.db_field);
                }
            })
        }

        switch (sort_array[i]) {
            case 'none':
                uri.deleteQueryParam(name + '_sort')
                this.removeSortFromSavedArray(name);
                break;
            case 'asc':
                this.addSortToSavedArray(name, 'asc')
                uri.addQueryParam(name + '_sort', 'asc')
                break;
            case 'desc':
                uri.deleteQueryParam(name + '_sort')
                uri.addQueryParam(name + '_sort', 'desc')
                this.removeSortFromSavedArray(name)
                this.addSortToSavedArray(name, 'desc')
                break;
        }
        sessionStorage[this.stored_sort_key] = JSON.stringify(this.sort);
        this.pushState(uri);


    }
    loadSortArrayFromUri() {
        //go through the params in order....
        let uri = new JsUri(window.location.href);
        let params = uri.queryPairs
        let self = this;
        params.forEach(param => {
            let name = param[0];
            if (name.includes('_sort')) {
                name = name.replace('_sort', '')
                let value = param[1];
                //remove sort
                self.addSortToSavedArray(name, value);
            }
        })
    }
    addSortToSavedArray(name, value) {
        let save = {};
        save[name] = value;
        this.sort.push(save);
    }

    removeSortFromUri(uri, table_headers,th = false) {
        console.log(table_headers);
        table_headers.forEach(th_element => {
            if (th != th_element) {
                let name = th_element.col_def.db_field;
                uri.deleteQueryParam(name + '_sort')
            }
        })
    }

    loadFromStorage(search_elements){
        console.log('loading search from storage')
        this.loadSearchFromStorage(search_elements)
        console.log('loading sort from storage')
        this.sort = this.loadSortFromSessionStorage();
    }
    checkStorage() {
        console.log('checkStorageForSearch ' + this.saved_search);
        return sessionStorage[this.saved_search]

    }


    retrieveSearch() {
        return JSON.parse(sessionStorage[this.saved_search]);
    }

    storeSearch(search_values) {
        sessionStorage[this.stored_search_key] = JSON.stringify(search_values);
    }
    loadSearchFromStorage(search_elements) {
        console.log('loading search values from storage')
        console.log(sessionStorage[this.stored_search_key])
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
    loadSortFromSessionStorage() {
        if(sessionStorage[this.stored_sort_key]){
            return JSON.parse(sessionStorage[this.stored_sort_key]);
        }
    }
    removeSortFromSavedArray(name) {
        this.sort = this.sort.filter(function (el) {
            let keys = Object.keys(el);
            return keys[0] !== name;
        });
    }

    onReset(search_elements, table_header_array){
        let uri = new JsUri(window.location.href)
        this.deleteSearchValuesFromUri(uri, search_elements);
        this.removeSortFromUri(uri,table_header_array);
        console.log('pushing ' + uri.toString())
        this.pushState(uri);
        delete sessionStorage[this.stored_search_key];
        delete sessionStorage[this.stored_sort_key];
        this.resetStoredSort();
    }
    resetStoredSort(){
        this.sort = [];
    }












}