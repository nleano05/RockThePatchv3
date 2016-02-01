function toggleAccessControlBlockType() {
    var accessControlForm = document.getElementsByName("access-control");
    if(accessControlForm.length > 0) {
        var PRIVATE_toggleBlockOption = function (blockOption) {
            if(blockOption.value == "single") {
                blockIPGroup.style.display = "none";
                blockSingleIP.style.display = "block";
            } else {
                blockIPGroup.style.display = "block";
                blockSingleIP.style.display = "none";
            }
        };

        var blockOption = accessControlForm[0].elements['block-option'];

        var blockIPGroup = document.getElementById("block-group");
        var blockSingleIP = document.getElementById("block-single");

        blockOption.onload = function() {
            PRIVATE_toggleBlockOption(blockOption);
        };

        blockOption[0].onchange = function() {
            PRIVATE_toggleBlockOption(blockOption);
        };

        blockOption[1].onchange = function() {
            PRIVATE_toggleBlockOption(blockOption);
        };
    }
}

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

function toggleAccountInfoEditConfirmSecurityQuestionOneAnswer() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var securityQuestionOneAnswer = accountInfoEditForm[0].elements['security-question-one-answer'];
        var securityQuestionOneAnswerConfirm = document.getElementById('security-question-one-answer-confirm');
        var oldSecurityQuestionOneAnswer = getOldSecurityQuestionOneAnswer();

        if(typeof oldSecurityQuestionOneAnswer != "undefined") {
            if(securityQuestionOneAnswer.value.length == 0 || securityQuestionOneAnswer.value.toLowerCase().trim() != oldSecurityQuestionOneAnswer.toLowerCase().trim()) {
                securityQuestionOneAnswerConfirm.style.display = "block";
            } else {
                securityQuestionOneAnswerConfirm.style.display = "none";
            }
        } else {
            getOldSecurityQuestionOneAnswerForAccountInfoEdit();
            securityQuestionOneAnswerConfirm.style.display = "none";
        }

        securityQuestionOneAnswer.onkeypress = function() {
            toggleAccountInfoEditConfirmSecurityQuestionOneAnswer();
        };

        securityQuestionOneAnswer.onkeyup = function() {
            toggleAccountInfoEditConfirmSecurityQuestionOneAnswer();
        };

        securityQuestionOneAnswer.onkeydown = function() {
            toggleAccountInfoEditConfirmSecurityQuestionOneAnswer();
        };

        securityQuestionOneAnswer.onchange = function() {
            toggleAccountInfoEditConfirmSecurityQuestionOneAnswer();
        };

        securityQuestionOneAnswer.onblur = function() {
            toggleAccountInfoEditConfirmSecurityQuestionOneAnswer();
        };

        securityQuestionOneAnswer.oncut = function() {
            toggleAccountInfoEditConfirmSecurityQuestionOneAnswer();
        };

        securityQuestionOneAnswer.onpaste = function() {
            toggleAccountInfoEditConfirmSecurityQuestionOneAnswer();
        }
    }
}

function toggleAccountInfoEditConfirmSecurityQuestionTwoAnswer() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var securityQuestionTwoAnswer = accountInfoEditForm[0].elements['security-question-two-answer'];
        var securityQuestionTwoAnswerConfirm = document.getElementById('security-question-two-answer-confirm');
        var oldSecurityQuestionTwoAnswer = getOldSecurityQuestionTwoAnswer();

        if(typeof oldSecurityQuestionTwoAnswer != "undefined") {
            if(oldSecurityQuestionTwoAnswer.value.length == 0 || securityQuestionTwoAnswer.value.toLowerCase().trim() != oldSecurityQuestionTwoAnswer.toLowerCase().trim()) {
                securityQuestionTwoAnswerConfirm.style.display = "block";
            } else {
                securityQuestionTwoAnswerConfirm.style.display = "none";
            }
        } else {
            getOldSecurityQuestionTwoAnswerForAccountInfoEdit();
            securityQuestionTwoAnswerConfirm.style.display = "none";
        }

        securityQuestionTwoAnswer.onkeypress = function() {
            toggleAccountInfoEditConfirmSecurityQuestionTwoAnswer();
        };

        securityQuestionTwoAnswer.onkeyup = function() {
            toggleAccountInfoEditConfirmSecurityQuestionTwoAnswer();
        };

        securityQuestionTwoAnswer.onkeydown = function() {
            toggleAccountInfoEditConfirmSecurityQuestionTwoAnswer();
        };

        securityQuestionTwoAnswer.onchange = function() {
            toggleAccountInfoEditConfirmSecurityQuestionTwoAnswer();
        };

        securityQuestionTwoAnswer.onblur = function() {
            toggleAccountInfoEditConfirmSecurityQuestionTwoAnswer();
        };

        securityQuestionTwoAnswer.oncut = function() {
            toggleAccountInfoEditConfirmSecurityQuestionTwoAnswer();
        };

        securityQuestionTwoAnswer.onpaste = function() {
            toggleAccountInfoEditConfirmSecurityQuestionTwoAnswer();
        }
    }
}

function toggleAccountInfoEditConfirmSecurityQuestionThreeAnswer() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var securityQuestionThreeAnswer = accountInfoEditForm[0].elements['security-question-three-answer'];
        var securityQuestionThreeAnswerConfirm = document.getElementById('security-question-three-answer-confirm');
        var oldSecurityQuestionThreeAnswer = getOldSecurityQuestionThreeAnswer();

        if(typeof oldSecurityQuestionThreeAnswer != "undefined") {
            if(oldSecurityQuestionThreeAnswer.value.length == 0 || securityQuestionThreeAnswer.value.toLowerCase().trim() != oldSecurityQuestionThreeAnswer.toLowerCase().trim()) {
                securityQuestionThreeAnswerConfirm.style.display = "block";
            } else {
                securityQuestionThreeAnswerConfirm.style.display = "none";
            }
        } else {
            getOldSecurityQuestionTwoAnswerForAccountInfoEdit();
            securityQuestionThreeAnswerConfirm.style.display = "none";
        }

        securityQuestionThreeAnswer.onkeypress = function() {
            toggleAccountInfoEditConfirmSecurityQuestionThreeAnswer();
        };

        securityQuestionThreeAnswer.onkeyup = function() {
            toggleAccountInfoEditConfirmSecurityQuestionThreeAnswer();
        };

        securityQuestionThreeAnswer.onkeydown = function() {
            toggleAccountInfoEditConfirmSecurityQuestionThreeAnswer();
        };

        securityQuestionThreeAnswer.onchange = function() {
            toggleAccountInfoEditConfirmSecurityQuestionThreeAnswer();
        };

        securityQuestionThreeAnswer.onblur = function() {
            toggleAccountInfoEditConfirmSecurityQuestionThreeAnswer();
        };

        securityQuestionThreeAnswer.oncut = function() {
            toggleAccountInfoEditConfirmSecurityQuestionThreeAnswer();
        };

        securityQuestionThreeAnswer.onpaste = function() {
            toggleAccountInfoEditConfirmSecurityQuestionThreeAnswer();
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

function toggleAnnoyanceLevelsAddEditOrDelete() {
    var manageAnnoyanceLevelsForm = document.getElementsByName("manage-annoyance-levels");
    if(manageAnnoyanceLevelsForm.length > 0) {
        var PRIVATE_toggleAddEditOrDelete = function (addEditOrDelete) {
            if(addEditOrDelete.value == "Add") {
                addAnnoyanceLevel.style.display = "block";
                editAnnoyanceLevel.style.display = "none";
                deleteAnnoyanceLevel.style.display = "none";
            } else if(addEditOrDelete.value == "Edit") {
                addAnnoyanceLevel.style.display = "none";
                editAnnoyanceLevel.style.display = "block";
                deleteAnnoyanceLevel.style.display = "none";
            } else {
                addAnnoyanceLevel.style.display = "none";
                editAnnoyanceLevel.style.display = "none";
                deleteAnnoyanceLevel.style.display = "block";
            }
        };

        var addEditOrDelete = manageAnnoyanceLevelsForm[0].elements['add-edit-or-delete'];
        var addAnnoyanceLevel = document.getElementById('add-annoyance-level-container');
        var editAnnoyanceLevel = document.getElementById('edit-annoyance-level-container');
        var deleteAnnoyanceLevel = document.getElementById('delete-annoyance-level-container');

        addEditOrDelete.onload = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[0].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[1].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[2].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        }
    }
}

function toggleEmailDistrosAddEditOrDelete() {
    var manageEmailDistrosForm = document.getElementsByName("manage-email-distros");
    if(manageEmailDistrosForm.length > 0) {
        var PRIVATE_toggleAddEditOrDelete = function (addEditOrDelete) {
            if(addEditOrDelete.value == "Add") {
                addEmailDistro.style.display = "block";
                editEmailDistro.style.display = "none";
                deleteEmailDistro.style.display = "none";
            } else if(addEditOrDelete.value == "Edit") {
                addEmailDistro.style.display = "none";
                editEmailDistro.style.display = "block";
                deleteEmailDistro.style.display = "none";
            } else {
                addEmailDistro.style.display = "none";
                editEmailDistro.style.display = "none";
                deleteEmailDistro.style.display = "block";
            }
        };

        var addEditOrDelete = manageEmailDistrosForm[0].elements['add-edit-or-delete'];
        var addEmailDistro = document.getElementById('add-email-distro-container');
        var editEmailDistro = document.getElementById('edit-email-distro-container');
        var deleteEmailDistro = document.        getElementById('delete-email-distro-container');

        addEditOrDelete.onload = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[0].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[1].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[2].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        }
    }
}

function toggleErrorReportCategoryAddEditOrDelete() {
    var manageErrorReportCategoriesForm = document.getElementsByName("manage-error-report-categories");
    if(manageErrorReportCategoriesForm.length > 0) {
        var PRIVATE_toggleAddEditOrDelete = function (addEditOrDelete) {
            if(addEditOrDelete.value == "Add") {
                addErrorReportCategory.style.display = "block";
                editErrorReportCategory.style.display = "none";
                deleteErrorReportCategory.style.display = "none";
            } else if(addEditOrDelete.value == "Edit") {
                addErrorReportCategory.style.display = "none";
                editErrorReportCategory.style.display = "block";
                deleteErrorReportCategory.style.display = "none";
            } else {
                addErrorReportCategory.style.display = "none";
                editErrorReportCategory.style.display = "none";
                deleteErrorReportCategory.style.display = "block";
            }
        };

        var addEditOrDelete = manageErrorReportCategoriesForm[0].elements['add-edit-or-delete'];
        var addErrorReportCategory = document.getElementById('add-error-report-category-container');
        var editErrorReportCategory = document.getElementById('edit-error-report-category-container');
        var deleteErrorReportCategory = document.getElementById('delete-error-report-category-container');

        addEditOrDelete.onload = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[0].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[1].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[2].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        }
    }
}

function toggleFeatureRequestCategoryAddEditOrDelete() {
    var manageFeatureRequestCategoriesForm = document.getElementsByName("manage-feature-request-categories");
    if(manageFeatureRequestCategoriesForm.length > 0) {
        var PRIVATE_toggleAddEditOrDelete = function (addEditOrDelete) {
            if(addEditOrDelete.value == "Add") {
                addFeatureRequestCategory.style.display = "block";
                editFeatureRequestCategory.style.display = "none";
                deleteFeatureRequestCategory.style.display = "none";
            } else if(addEditOrDelete.value == "Edit") {
                addFeatureRequestCategory.style.display = "none";
                editFeatureRequestCategory.style.display = "block";
                deleteFeatureRequestCategory.style.display = "none";
            } else {
                addFeatureRequestCategory.style.display = "none";
                editFeatureRequestCategory.style.display = "none";
                deleteFeatureRequestCategory.style.display = "block";
            }
        };

        var addEditOrDelete = manageFeatureRequestCategoriesForm[0].elements['add-edit-or-delete'];
        var addFeatureRequestCategory = document.getElementById('add-feature-request-category-container');
        var editFeatureRequestCategory = document.getElementById('edit-feature-request-category-container');
        var deleteFeatureRequestCategory = document.getElementById('delete-feature-request-category-container');

        addEditOrDelete.onload = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[0].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[1].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[2].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        }
    }
}

function toggleSecurityQuestionAddEditOrDelete() {
    var manageSecurityQuestionsForms = document.getElementsByName("manage-security-questions");
    if(manageSecurityQuestionsForms.length > 0) {
        var PRIVATE_toggleAddEditOrDelete = function (addEditOrDelete) {
            if(addEditOrDelete.value == "Add") {
                addSecurityQuestion.style.display = "block";
                editSecurityQuestion.style.display = "none";
                deleteSecurityQuestion.style.display = "none";
            } else if(addEditOrDelete.value == "Edit") {
                addSecurityQuestion.style.display = "none";
                editSecurityQuestion.style.display = "block";
                deleteSecurityQuestion.style.display = "none";
            } else {
                addSecurityQuestion.style.display = "none";
                editSecurityQuestion.style.display = "none";
                deleteSecurityQuestion.style.display = "block";
            }
        };

        var addEditOrDelete = manageSecurityQuestionsForms[0].elements['add-edit-or-delete'];
        var addSecurityQuestion = document.getElementById('add-security-question-container');
        var editSecurityQuestion = document.getElementById('edit-security-question-container');
        var deleteSecurityQuestion = document.getElementById('delete-security-question-container');

        addEditOrDelete.onload = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[0].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[1].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        };

        addEditOrDelete[2].onchange = function() {
            PRIVATE_toggleAddEditOrDelete(addEditOrDelete);
        }
    }
}