import {TableEvent} from './TableEvent'

export class SearchTableEvents {
    constructor(controller) {

        controller.searchReturned = new TableEvent(controller)
        controller.searching = new TableEvent(controller)
        controller.loadPageEvent = new TableEvent(controller)
        controller.view.searchClicked = new TableEvent(controller.view);
        controller.view.resetClicked = new TableEvent(controller.view);


        controller.view.searchClicked.attach(
            function () {
                console.log('search clicked');
                //store the search
                controller.uri.storeSearch();
                if (typeof controller.model.td.onSearchClick === 'function') {
                    let search_fields = controller.getSearchPostData()
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
        controller.loadPageEvent.attach(
            function () {
                if(typeof controller.model.options.onLoadPage === 'function'){
                    controller.model.options.onLoadPage()
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