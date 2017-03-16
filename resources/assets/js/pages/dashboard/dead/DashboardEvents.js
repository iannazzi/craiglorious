/**
 * Created by embrasse-moi on 2/28/17.
 */
import {CIEvent} from '../../../events/CIEvent'
export class DashboardEvents {
    constructor(controller) {
        let view = controller.view;
        view.search_input_changed = new CIEvent(view);
        view.search_input_changed.attach(
            function () {
                 controller.searchKeyUp()
            }
        )
        controller.loadPageEvent = new CIEvent(controller);
        view.roomClicked = new CIEvent(view);
        view.roomClicked.attach(
            function (sender, args) {
                controller.roomClick(args);
            }
        )

    }
}