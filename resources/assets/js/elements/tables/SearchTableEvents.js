import {TableEvent} from './TableEvent'

export class SearchTableEvents {
    constructor(controller) {

        controller.searchReturned = new TableEvent(controller)
        controller.searching = new TableEvent(controller)
        controller.view.searchClicked = new TableEvent(controller.view);
        controller.view.resetClicked = new TableEvent(controller.view);


        controller.view.searchClicked.attach(
            function () {
                console.log('search clicked');

                //store the search
                controller.uri.storeSearch();
                //this will set the url
                let search_fields = controller.uri.getSearchUrlData()

                //push a url change, then watch for the change, then fire page load event
                if (typeof controller.model.td.onSearchClick === 'function') {
                    controller.model.td.onSearchClick(search_fields);
                }

                //i was expecting a reload at this point..... but noooooo
                //could do location .reload.....very obstructive... no reload then...
                //location.reload();
                //controller.getSearchRecordsAndDisplay();



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
                    if(typeof controller.model.options.onLoadPageStart === 'function'){
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

                else {
                    if (controller.uri.checkStorage()) {
                        controller.uri.loadFromStorage();
                        //this will NOT send you to the if block right above this,
                        // controller.options.onSearchClick(controller.getSearchPostData())
                        //console.log('')
                        //push w/query
                        controller.view.searchClicked.notify();

                    }
                    else {
                        // get and
                        //display the data or the number of records.....
                        console.log('no search present.. loading if results are < ' + this.show_records_autmatically_below)
                        //this.populateSearchValuesFromDefaultValues()
                        //this.loadInitialData();
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