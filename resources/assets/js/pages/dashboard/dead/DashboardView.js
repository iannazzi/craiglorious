/**
 * Created by embrasse-moi on 2/28/17.
 */
export class DashboardView {
    constructor(model) {
        this.model = model;
    }
    render_page(){
        let div = document.getElementById('dashboard');

        let template = `

    <div id ="vuedb" class="container-fluid">
        <div id="rooms_search_div" class="row">
           
            
        </div>
        <div id = "views_div" class="views_div" class="row">
        </div>
    </div>
    
    `
        div.innerHTML = template;

        this.render_rooms();
        //this.render_views();
    }
    render_views() {
        let views_div = document.getElementById('views_div');
        views_div.innerHTML = '';
        this.model.views.forEach(function (view) {
            console.log(view)
            if (view.entry) {
                views_div.innerHTML += `
                <div  class="dashbtn">
                    <a href="${view.route}" role="button">
                        <div id="dashicon">
                            <i class="fa-3x" v-bind:class="${view.icon}" ></i>
                        </div>
                        <div id="dashbtnname">${ view.name }</div>
                    </a>
                </div>
                `
            }
        });

    }
    render_rooms() {
        let rooms_search_div = document.getElementById('rooms_search_div');
        let room_button_div, button;
        let self = this;
        this.model.rooms.forEach(function (room) {
            if (room.show) {
                room_button_div = document.createElement('div');
                room_button_div.className = "room_button_div";
                button = document.createElement('button');
                button.addEventListener('click', self.roomClicked.notify(self,[event,room]));
                button.id = room.class;
                button.className = room.class;
                button.type = 'button';
                button.innerHTML = room.name;
                if (room.active) {
                    button.className = room.class + " active"
                }
                room_button_div.appendChild(button);
                rooms_search_div.appendChild(room_button_div);
            }
        });

        let search_button_div = document.createElement('div');
        search_button_div.id = 'search_div';
        let search_input = document.createElement('input');
        search_input.type = "text";
        search_input.id = "search_input";
        search_input.placeholder = "Search";
        console.log(this);
        search_input.addEventListener('keyup', self.search_input_changed.notify());
        this.search_input = search_input;
        search_button_div.appendChild(search_input);
        rooms_search_div.appendChild(search_button_div);




    }
}