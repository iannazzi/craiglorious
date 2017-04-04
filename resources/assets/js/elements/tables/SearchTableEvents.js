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

                    //this loads data to the search table fields
                    //and the sort array
                    controller.uri.loadFromUri(controller.model.options.search_query);
                    controller.uri.storeSearch();
                    controller.getSearchRecordsAndDisplay();


                    // if(typeof controller.model.options.onLoadPage === 'function'){
                    //     controller.model.options.onLoadPage()
                    // }
                }

                else if (controller.uri.checkStorage()) {
                    //Here we need to replace the route, then react to the route change....
                    // which should then call the function above....
                    let search_fields = controller.uri.loadFromStorage();
                    if (typeof controller.model.options.loadPageFromStorage === 'function') {
                        controller.model.options.loadPageFromStorage(search_fields);
                    }


                }
                else {
                    //no search set, we should NOW hit the server for Data
                    controller.getDefaultRecordsAndDisplay();









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