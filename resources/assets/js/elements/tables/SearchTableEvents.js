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
                if (typeof controller.model.td.onSearchClicked === 'function') {
                    controller.model.td.onSearchClicked();
                }
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
                controller.onSearchReturned(results);
            }
        )
        controller.loadPageEvent.attach(
            function () {
                controller.onLoadPage();
            }
        )
        controller.view.resetClicked.attach(
            function () {
                controller.onReset()
            }
        )
    }
}