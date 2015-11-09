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