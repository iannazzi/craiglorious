<template>
<div>
    <div class="panel-body passwords">
        <div class="panel panel-default password">
            <div class="panel-heading">
                <h3 class="panel-title">Update Password</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="password" placeholder="Password" :value="password">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="text" class="form-control" id="password_confirmation" placeholder="Confirm Password" :value="password">
                </div>
                <button id="updatePassword" type="submit" class="btn btn-default" @click="updatePassword">Update</button>
            </div>
        </div>

        <div class="panel panel-default passcode">
            <div class="panel-heading">
                <h3 class="panel-title">Update Manager Code</h3>
            </div>
            <div class="panel-body">
                <div class="form-group ">
                    <label for="passcode">Unique Code</label>
                    <input type="number" class="form-control" id="passcode" placeholder="Numeric Code" :value="passcode">
                </div>
                <div class="form-group ">
                    <label for="passcode_confirmation">Confirm Code</label>
                    <input type="number" class="form-control" id="passcode_confirmation" placeholder="Confirm Code" :value="passcode">
                </div>
                <button id="updatePasscode"  class="btn btn-default" @click="updatePasscode">Update</button>
            </div>
        </div>



    </div>
    <div class = "row col-md-8  col-md-offset-2">
        <p>Recommended values have been added. Passwords need to be longer than 8 characters and require numbers, uppercase, lowercase, and symbols. Manager Codes must be 5 or more and unique.</p>
    </div>
    <div id="modals"></div>
</div>
</template>

<script>

    import {createWaitModal} from '../../elements/modal/waitModal'
    import {ErrorModal} from '../../elements/modal/ErrorModal'
    import {SuccessModal} from '../../elements/modal/SuccessModal'

    let div = document.getElementById("modals");
    let waitModal = createWaitModal();
    let errorModal = new ErrorModal('error');
    let successModal = new SuccessModal('success');
    $(waitModal).modal('hide');
//    div.appendChild(waitModal);
//    div.appendChild(errorModal.createErrorModal());
//    div.appendChild(successModal.create());



    export default {
        data() {
            return {
                passcode:'',
                password:'',
            }
        },
        mounted: function () {
            //we need to get some data
            let self = this;

            getData('get', '/user', false, function(response){
                console.log(response);
                self.passcode = response.data.code;
                self.password = response.data.pass;
            })

        },
        methods: {
            updatePassword(){
                let data = {};
                data['password'] =$('#password').val();
                data['password_confirmation'] =$('#password_confirmation').val();
                console.log(data);
                console.log(JSON.stringify(data));
                $(waitModal).modal('show');
                $.ajax({
                    type: "POST",
                    url: '/user',
                    data: data,
                    success: function (result) {
                        console.log(result);
                        $(waitModal).modal('hide');
                        successModal.show('Password Updated');
                    },
                    error: function (response) {
                        console.log(response)
                        $(waitModal).modal('hide');
                        errorModal.addErrorMessage(response.responseJSON.message);
                        errorModal.show();
                    }
                });
            },
            updatePasscode(){
                let data = {};
                data['passcode'] =$('#passcode').val();
                data['passcode_confirmation'] =$('#passcode_confirmation').val();
                $(waitModal).modal('show');
                console.log(JSON.stringify(data));

                $.ajax({
                    type: "POST",
                    url: '/user',
                    data: data,
                    success: function (result) {
                        console.log(result);
                        $(waitModal).modal('hide');
                        successModal.show('Passcode Updated');
                    },
                    error: function (response) {
                        console.log(response)
                        $(waitModal).modal('hide');
                        errorModal.addErrorMessage(response.responseJSON.message);
                        errorModal.show();
                    }
                });

            }

        }
    }
</script>
