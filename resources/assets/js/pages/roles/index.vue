<template>
    <div>
        <div v-if="dataReady">
            <div id="data_table_view">
                <button class="btn-new" @click="$router.push('/roles/create')"><i class="fa fa-plus"
                                                                                  aria-hidden="true"></i>New
                    Role
                </button>
                <div id="roles"></div>
            </div>
        </div>
        <div v-else>
            <zzi-matrix></zzi-matrix>
        </div>
    </div>


</template>

<script>

    import columnDefinition from './columnDefinition'
    import {AwesomeTable} from '../../elements/tables/AwesomeTable';


    export default {
        data() {
            return {
                data: {},
                dataReady: false,
            }
        },
        props: ['page'],
        mounted: function () {
            this.dataReady = false;
            //we need to get some data
            let self = this;


            bus.$emit('zzwaitevent');

            getData(self, '/roles');
//            client({path: '/roles'}).then(
//                function (response) {
//                    console.log(response);
//                    self.data = response.data;
//                    self.dataReady = true;
//                    self.renderTable();
//                    cached_page_data['roles'] = self.data;
//                    bus.$emit('zzwaitoverevent');
//                });

        },
        methods: {
            renderTable(){
                let self = this;
                let searchableTable = new AwesomeTable({

                    name: "roles",
                    access: "read",
                    table_buttons: [],
                    table_view: self.page,
                    edit_display: 'on_page',
                    route: "/api/roles",
                    footer: [],
                    header: [],
                    column_definition: columnDefinition(self.data),
                    type: 'searchable',
                    data: self.data,
                    number_of_records_available: self.data.number_of_records_available,
                })
                $(function () {
                    searchableTable.addTo('roles')
                })


            }
        }
    }

</script>
