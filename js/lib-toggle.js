function toggleAccountInfoEditConfirmEmail() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var oldEmail = document.getElementById('old-email');
        var oldEmailValue = oldEmail.innerText.replace("OLD Email: ", "");
        var userEmail = accountInfoEditForm[0].elements['email'];
        var emailConfirm = document.getElementById('email-confirm');
        if(userEmail.value.toLowerCase().trim() != oldEmailValue.toLowerCase().trim()) {
            emailConfirm.style.display = "block";
        } else {
            emailConfirm.style.display = "none";
        }

        userEmail.onkeypress = function() {
            toggleAccountInfoEditConfirmEmail();
        };

        userEmail.onkeyup = function() {
            toggleAccountInfoEditConfirmEmail();
        };

        userEmail.onkeydown = function() {
            toggleAccountInfoEditConfirmEmail();
        };

        userEmail.onchange = function() {
            toggleAccountInfoEditConfirmEmail();
        };

        userEmail.onblur = function() {
            toggleAccountInfoEditConfirmEmail();
        };

        userEmail.oncut = function() {
            toggleAccountInfoEditConfirmEmail();
        };

        userEmail.onpaste = function() {
            toggleAccountInfoEditConfirmEmail();
        };
    }
}

function toggleAccountInfoEditConfirmSecurityAnswer() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var securityAnswer = accountInfoEditForm[0].elements['answer'];
        var securityAnswerConfirm = document.getElementById('answer-confirm');
        var oldSecurityAnswer = getOldSecurityAnswer();

        if(typeof oldSecurityAnswer != "undefined") {
            if(securityAnswer.value.toLowerCase().trim() != oldSecurityAnswer.toLowerCase().trim()) {
                securityAnswerConfirm.style.display = "block";
            } else {
                securityAnswerConfirm.style.display = "none";
            }
        } else {
            getOldSecurityAnswerForAccountInfoEdit();
            securityAnswerConfirm.style.display = "none";
        }

        securityAnswer.onkeypress = function() {
            toggleAccountInfoEditConfirmSecurityAnswer();
        };

        securityAnswer.onkeyup = function() {
            toggleAccountInfoEditConfirmSecurityAnswer();
        };

        securityAnswer.onkeydown = function() {
            toggleAccountInfoEditConfirmSecurityAnswer();
        };

        securityAnswer.onchange = function() {
            toggleAccountInfoEditConfirmSecurityAnswer();
        };

        securityAnswer.onblur = function() {
            toggleAccountInfoEditConfirmSecurityAnswer();
        };

        securityAnswer.oncut = function() {
            toggleAccountInfoEditConfirmSecurityAnswer();
        };

        securityAnswer.onpaste = function() {
            toggleAccountInfoEditConfirmSecurityAnswer();
        }
    }
}

function toggleAccountInfoEditNewPassword() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var useOldPassword = accountInfoEditForm[0].elements['use-old-password'];
        var setNewPassword = document.getElementById("set-new-password");

        if(useOldPassword.value == "yes") {
            setNewPassword.style.display = "none";
        }

        useOldPassword[0].onchange = function() {
            setNewPassword.style.display = "none";
        };

        useOldPassword[1].onchange = function() {
            setNewPassword.style.display = "block";
        }
    }
}