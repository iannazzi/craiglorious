<template>
    <div class="modal" id="wait_modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modalWaitContents">
                        <div class="modalWaitIconDiv">
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                        </div>
                        <div class="modalWaitText">
                            <h2>{{msg1}}</h2>
                            <p>{{msg2}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        data() {
            return {
                msg1: 'Please wait...',
                msg2: 'I am communicating with the server...',
            }
        },
        created(){

        },
        mounted(){
            let self = this;
            bus.$on('zzwaitevent', function () {
                console.log(' wait ')
                self.show();
            });
            bus.$on('zzwaitoverevent', function () {
                console.log(' wait over ')
                self.hide();
            });
        },
        methods: {
            show(){
                $('#wait_modal').modal('show')
            },
            hide(){
                $('#wait_modal').modal('hide');
            }
        }
    }
</script>
