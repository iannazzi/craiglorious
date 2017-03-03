import {TableEvent} from './TableEvent'

export class SearchTableEvents {
    constructor(controller){

        controller.searchReturned = new TableEvent(controller)
        controller.searching = new TableEvent(controller)
        controller.loadPageEvent = new TableEvent(controller)
        controller.view.searchClicked = new TableEvent(controller.view);
        controller.view.resetClicked = new TableEvent(controller.view);


        controller.view.searchClicked.attach(
            function () {
                controller.submitSearch()
            }
        )
        controller.searching.attach(
            function () {
                console.log('searching....')
                controller.view.searching();
            }
        )
        controller.searchReturned.attach(
            function (sender, results) {
                controller.loadData(results);
            }
        )
        controller.loadPageEvent.attach(
            function () {
                console.log('loading page')
                //is there a search on the uri?
                if (controller.checkForUriSearch()) {
                    console.log('loading search from uri')
                    controller.populateSearchValuesFromUri()
                    controller.loadSortArrayFromUri()
                    controller.view.searchClicked.notify()
                }
                else {
                    if (controller.checkStorageForSearch()) {
                        console.log('loading search from storage')
                        controller.populateSearchValuesFromStorage()
                        controller.loadSortArrayFromSessionStorage()
                        controller.view.searchClicked.notify()
                    }
                    else {
                        console.log('no search present.. loading if results are < ' + controller.show_records_autmatically_below)
                        //controller.populateSearchValuesFromDefaultValues()
                        controller.loadInitialData();
                    }
                }
            }
        )
        controller.view.resetClicked.attach(
            function () {
                controller.resetSearch()
            }
        )
    }
}