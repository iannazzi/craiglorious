<template>
    <div id="vuedb" class="container-fluid">
        <div id="rooms_search_div" class="row">
            <div class='room_button_div' v-for="room in rooms" v-show="room.show">
                <button
                        v-on:click="roomClick(room, $event)"
                        v-bind:id="room.class"

                        v-bind:class="[room.class, {active: room.active }]"

                        type="button">
                    {{ room.name }}
                </button>
            </div>
            <div id="search_div" class="">
                <input id="search_input"

                       type="text"
                       placeholder="Search"
                       @keyup='searchKeyUp'
                       @keyup.enter="searchEnter"
                       v-model="query"
                >
            </div>


        </div>
        <div v-if="loaded" class="views_div row">
            <div v-for="view in views" v-show="view.show" class="dashbtn">
                <router-link :to="view.route">

                    <div id="dashicon"><i class="fa-3x" v-bind:class="view.icon" aria-hidden="true"></i>
                    </div>
                    <div id="dashbtnname">{{ view.name }}</div>

                </router-link>
            </div>
        </div>
        <div v-else class = "row">
            <zzi-matrix></zzi-matrix>
        </div>
    </div>
</template>
<script>

    export default {
        data() {
            return {
                query: '',
                views:[],
                rooms: [],
                loaded: false,
            }
        },

        mounted: function () {
            this.query = '';

            let self = this;

            if( ! cached_page_data.views)
            {
                if (1) ml('no cached_page_data got to go and get some')
                client({ path: '/dashboard'}).then(
                    function (response) {

                        self.views = response.entity.views;


                        self.views.forEach(function (entry) {
                            entry.show = true
                        });
                        self.loaded = true;
                        cached_page_data['views'] = self.views;
                        self.$root.cached_page_data['views'] = self.views;
                    },
                    function (response, status) {
                        console.log(response);
//                    if (_.contains([401, 500], status)) {
//                    }
                    });

            }
            else{
                if (1) ml('using cached data')
                self.views = cached_page_data['views'];
                self.loaded = true;
                self.loadIcons();
            }

            this.rooms = [
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
            $('#search_input').focus()

            $(function(){
            })

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
//                    console.log('no active room or search qiuery display all')
                    this.views.forEach(function (view) {
                        view.show = true
                    })
                }
            },
            searchKeyUp: function () {
                this.rooms.forEach(function (room) {
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
                this.rooms.forEach(function (room) {
                    if (room.name != selected_room.name) {
                        room.active = false
                    }
                });
                this.loadIcons()
            },
        }
    }
</script>
<style>

    .wait i {
        font-size: 500px;

    }
    .wait-text {
        display: table-cell;padding-left:30px;
    }
    .confirmModalDiv {

    }
</style>