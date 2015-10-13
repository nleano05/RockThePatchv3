function autoformatPhoneNumberWatcher() {
    var phoneNumber;

    var registerForm = document.getElementsByName("register");
    if(registerForm.length > 0) {
        phoneNumber = document.getElementById('cell-phone');
        phoneNumber.onkeydown = function(event) {
            autoformatPhoneNumber(phoneNumber, event);
        }
    }

    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        phoneNumber = document.getElementById('cell-phone');
        phoneNumber.onkeydown = function(event) {
            autoformatPhoneNumber(phoneNumber, event);
        }
    }
}

function autoformatPhoneNumber(field, event) {
    var key = event.keyCode || event.charCode;

    if( key != 8 && key != 46 ) {
        if(field.value.length == 3 || field.value.length == 7) {
            field.value = field.value + "-";
        }
    }
}