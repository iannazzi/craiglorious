import {TableEvent} from './TableEvent'

export class SearchTableEvents {
    constructor(controller) {

        controller.searchReturned = new TableEvent(controller)
        controller.searching = new TableEvent(controller)
        controller.view.searchClicked = new TableEvent(controller.view);
        controller.view.resetClicked = new TableEvent(controller.view);


        controller.view.searchClicked.attach(
            function () {
                controller.uri.storeSearch();
                let search_fields = controller.uri.getSearchUrlData()
                //push a url change, then watch for the change, then fire page load event
                if (typeof controller.model.td.onSearchClick === 'function') {
                    controller.model.td.onSearchClick(search_fields);
                }
            }
        )
        controller.searching.attach(
            function () {
                console.log('searching....')
                //controller.view.searching();
            }
        )
        controller.searchReturned.attach(
            function (sender, results) {
                controller.onSearchReturned(results);
            }
        )
        controller.loadPageEvent = new TableEvent(controller)

        controller.loadPageEvent.attach(
            function () {
                if (controller.uri.checkUri(controller.model.options.search_query)) {
                    //console.log(controller.model.options.search_query)
                    if (typeof controller.model.options.onLoadPageStart === 'function') {
                        controller.model.options.onLoadPageStart();
                    }
                    console.log('Get data based on the Uri')

                    //this loads data to the search table fields
                    //and the sort array
                    controller.uri.loadFromUri(controller.model.options.search_query);
                    controller.uri.storeSearch();
                    controller.getSearchRecordsAndDisplay();


                    // if(typeof controller.model.options.onLoadPage === 'function'){
                    //     controller.model.options.onLoadPage()
                    // }
                }
                //this.view.searchClicked.notify()

                else if (controller.uri.checkStorage()) {
                    controller.uri.loadFromStorage();
                    controller.view.searchClicked.notify();

                }
                else {

                    if(controller.model.options.initial_page_load_data.length>0){
                        console.log('data from page load is available')
                        controller.model.loadData(controller.model.options.initial_page_load_data)
                        controller.view.addDataTable();
                        // if(typeof controller.model.options.onLoadPageComplete === 'function'){
                        //     controller.model.options.onLoadPageComplete();
                        // }
                        controller.setFocusToFirstInputOfSearch()
                    }
                    else{
                        console.log(controller.model.options.number_of_records_available)
                        let message = "There are " + controller.model.options.number_of_records_available + " records available, please search to limit the results.";
                        controller.view.addMessageInsteadOfTable(message)
                    }




                }
            }
        )
        controller.view.resetClicked.attach(
            function () {
                controller.onReset()
            }
        )
    }
}