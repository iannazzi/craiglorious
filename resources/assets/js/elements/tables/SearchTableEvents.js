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
                controller.onSearch()
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