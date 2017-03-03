import {DashboardModel} from './DashboardModel'
import {DashboardView} from './DashboardView'
import {DashboardController} from './DashboardController'

export function roomsAndIconsJs(views) {

    let model = new DashboardModel(views);
    let view = new DashboardView(model);
    let controller = new DashboardController(model,view);
    view.render_page();

}