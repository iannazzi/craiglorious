export function roomsAndIconsVue(views){
    let template= `      
`;
    // let div = document.getElementById('dashboard');
    //
    // div.innerHTML= template;
    views.forEach(function (entry) {
        entry.show = true
    });
    let rooms = [
        {
            name: 'Sales',
            key: 'Customer Counter',
            icon: 'fa fa-door',
            show: true,
            active: false,
            class: 'customer_counter',
        },
        {
            name: 'Operations',
            key: 'Back Room',
            icon: 'fa fa-door',
            show: true,
            active: false,
            class: 'back-room',
        },
        {
            name: 'Accounting',
            key: 'Office',
            icon: 'fa fa-door',
            show: true,
            active: false,
            class: 'office',
        },
        {
            name: 'Systems',
            key: 'System',
            icon: 'fa fa-door',
            show: true,
            active: false,
            class: 'system',
        }

    ]
    // console.log(rooms);
    // console.log(views)
    new Vue({
        el: '#vuedb',
        data: {
            query: '',
            views: views,
            rooms: rooms,
        },
        mounted: function () {
            $('#search_input').focus()
        },
        methods: {
            loadIcons: function () {
                let that = this;
                //if a room is active display that
                let activeRoom = false;
                let name = '';
                this.rooms.forEach(function (room) {
                    if (room.active) {
                        activeRoom = true
                        name = room.key
                    }
                })
                //if the search has a string display that
                if (this.query != '') {
                    console.log('this.query !=')
                    this.views.forEach(function (view) {
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
                    this.views.forEach(function (view) {
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
                    views.forEach(function (view) {
                        view.show = true
                    })
                }
            },
            searchKeyUp: function () {
                rooms.forEach(function (room) {
                    room.active = false
                });
                this.loadIcons()
            },
            searchEnter: function () {
            },
            roomActivate: function (active) {
            },
            roomClick: function (selected_room, event) {

                //console.log(event.currentTarget)
                //set the UI State
                $('#search_input').focus()
                this.query = ''
                selected_room.active = !selected_room.active
                //deactivate other rooms
                rooms.forEach(function (room) {
                    if (room.name != selected_room.name) {
                        room.active = false
                    }
                });
                this.loadIcons()
            },
        }
    })
}