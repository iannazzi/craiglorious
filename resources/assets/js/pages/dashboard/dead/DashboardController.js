/**
 * Created by embrasse-moi on 2/28/17.
 */
import {DashboardEvents} from './DashboardEvents';
export class DashboardController {
    constructor(model, view) {
        this.model = model;
        this.view = view;
        this.events = new DashboardEvents(this);

        $(function () {
            $('#search_input').focus()
        });
    }

    searchKeyUp() {
        console.log(this.view.search_input.value);
        this.model.query = this.view.search_input.value;
        this.model.rooms.forEach(function (room) {
            room.active = false
        });
        this.loadIcons();
    }

    loadIcons() {
        let that = this;
        //if a room is active display that
        let activeRoom = false;
        let name = '';
        let self = this;
        this.model.rooms.forEach(function (room) {
            if (room.active) {
                activeRoom = true
                name = room.key
            }
        })
        //if the search has a string display that
        if (self.model.query != '') {
            console.log('self.query !=')
            self.model.views.forEach(function (view) {
                if (view.name.toLowerCase().indexOf(that.query.toLowerCase()) >= 0) {
                    view.show = true
                }
                else {
                    view.show = false
                }
            })
        }
        else if (activeRoom) {
            console.log('active room is ' + name + ' ' + activeRoom)
            self.model.views.forEach(function (view) {
                if (view.place.indexOf(name) > -1) {
                    //console.log(view.name + ' room ' + name + ' show')
                    view.show = true
                }
                else {
                    //console.log(view.name + ' room ' + name + ' hide')
                    view.show = false
                }
            })
        }
        else {
            console.log('no active room or search qiuery display all')
            self.model.views.forEach(function (view) {
                view.show = true
            })
        }

        this.view.render_views();
    }

    roomClick(args) {

        let selected_room = args[1];
        $('#search_input').focus()
        this.model.query = ''
        selected_room.active = !selected_room.active
        //deactivate other rooms
        this.model.rooms.forEach(function (room) {
            if (room.name != selected_room.name) {
                room.active = false
            }
        });
        this.loadIcons()
    }
}