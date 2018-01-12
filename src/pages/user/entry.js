/**
 * Created by embrasse-moi on 2/4/17.
 */
import {pageSetup} from './pageSetup'
import {createWaitModal} from '../../elements/modal/waitModal'
import {ErrorModal} from '../../elements/modal/ErrorModal'
import {SuccessModal} from '../../elements/modal/SuccessModal'

$(function(){
    let div = document.getElementById("modals");
    let waitModal = createWaitModal();
    let errorModal = new ErrorModal('error');
    let successModal = new SuccessModal('success');
    $(waitModal).modal('hide');
    div.appendChild(waitModal);
    div.appendChild(errorModal.createErrorModal());
    div.appendChild(successModal.create());


    $('#updatePassword').click(function(){
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
    })
    $('#updatePasscode').click(function(){
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
    })




});