function populateAnnoyanceLevelEdit() {
    var manageAnnoyanceLevelsForm = document.getElementsByName("manage-annoyance-levels");
    if(manageAnnoyanceLevelsForm.length > 0) {
        var editAnnoyanceLevelSelect = document.getElementsByName("edit-annoyance-level-select");
        var editAnnoyanceLevelSelectValue = editAnnoyanceLevelSelect[0].value;

        var editLevel = document.getElementsByName("edit-level");
        var editName = document.getElementsByName("edit-name");

        if(editAnnoyanceLevelSelectValue != "-- SELECT ANNOYANCE LEVEL TO EDIT --"){
            setAppendString(editAnnoyanceLevelSelectValue);
            createAccessToken(populateAnnoyanceLevelEditTokenCallback);
        } else {
            editLevel[0].value = "";
            editName[0].value = "";
        }

        editAnnoyanceLevelSelect[0].onchange = function() {
            populateAnnoyanceLevelEdit();
        }
    }
}

function populateAnnoyanceLevelEditTokenCallback(response) {
    var responseObject = JSON.parse(response);
    var accessToken = responseObject.accessToken;

    sendHTTPRequest("GET", getBaseURL() + "api/v1/annoyance-levels.php?id=" + getAppendString(), populateAnnoyanceLevelEditCallback, "Authorizationtoken", accessToken);
}

function populateAnnoyanceLevelEditCallback(response) {
    var editLevel = document.getElementsByName("edit-level");
    var editName = document.getElementsByName("edit-name");
    var editIsDefault = document.getElementsByName("edit-is-default");

    var responseObject = JSON.parse(response);

    editLevel[0].value = responseObject.level;
    editName[0].value = responseObject.name;

    if(responseObject.isDefault == 1) {
        editIsDefault[0].checked = true;
        editIsDefault[1].checked = false;
    } else {
        editIsDefault[0].checked = false;
        editIsDefault[1].checked = true;
    }
}

function populateEmailDistroEdit() {
    var manageEmailDistrosForm = document.getElementsByName("manage-email-distros");
    if(manageEmailDistrosForm.length > 0){
        var editEmailDistroSelect = document.getElementsByName("edit-email-distro-select");
        var editEmailDistroSelectValue = editEmailDistroSelect[0].value;

        var editName = document.getElementsByName("edit-name");
        var editCurrentMembers = document.getElementById("edit-email-distro-current-members");
        var editRemoveMembers = document.getElementsByName("edit-remove-member-select");

        if(editEmailDistroSelectValue != "-- SELECT EMAIL DISTRO TO EDIT --") {
            setAppendString(editEmailDistroSelectValue);
            createAccessToken(populateEmailDistroEditTokenCallback);
        } else {
            editName[0].value = "";
        }

        editEmailDistroSelect[0].onchange = function() {
            populateEmailDistroEdit();
        }
    }
}

function populateEmailDistroEditTokenCallback(response){
    var responseObject = JSON.parse(response);
    var accessToken = responseObject.accessToken;

    sendHTTPRequest("GET", getBaseURL() + "api/v1/email-distros.php?id=" + getAppendString(), populateEmailDistroEditCallback, "Authorizationtoken", accessToken);
}

function populateEmailDistroEditCallback(response) {
    var editName = document.getElementsByName("edit-name");
    var editCurrentMembers = document.getElementById("edit-email-distro-current-members");
    var editRemoveMembers = document.getElementsByName("edit-remove-member-select");

    var responseObject = JSON.parse(response);

    var emailMembers = responseObject.distroMembers;
    var currentEmailMembers = "";
    for(var x = 0; x < emailMembers.length; x++) {
        currentEmailMembers = currentEmailMembers + emailMembers[x].email + ", ";
    }
    currentEmailMembers = currentEmailMembers.substr(0, (currentEmailMembers.length - 2));

    editName[0].value = responseObject.name;
    editCurrentMembers.innerText = currentEmailMembers;

    editRemoveMembers[0].innerHTML = "";
    var members = currentEmailMembers.split(", ");

    option = document.createElement("option");
    option.text = "-- SELECT EMAIL DISTRO MEMBER TO REMOVE --";
    editRemoveMembers[0].add(option);


    for(x = 0; x < emailMembers.length; x++){
        var option = document.createElement("option");
        option.value = emailMembers[x].id;
        option.text = emailMembers[x].email;
        editRemoveMembers[0].add(option);
    }
}

function populateErrorReportCategoryEdit() {
    var manageErrorReportCategoriesForm = document.getElementsByName("manage-error-report-categories");
    if(manageErrorReportCategoriesForm.length > 0) {
        var editCategorySelect = document.getElementsByName("edit-category-select");
        var editCategorySelectValue = editCategorySelect[0].value;

        var editCategory = document.getElementsByName("edit-category");
        var editEmailDistro = document.getElementsByName("edit-email-distro");
        var editDefault = document.getElementsByName("edit-default");

        if(editCategorySelectValue != "-- SELECT ERROR REPORT CATEGORY TO EDIT --") {
            setAppendString(editCategorySelectValue);
            createAccessToken(populateErrorReportCategoryEditTokenCallback);
        } else {
            editCategory[0].value = "";
            editEmailDistro[0].value = "-- SELECT EMAIL DISTRO --";
            editDefault[0].checked = false;
            editDefault[1].checked = true;
        }

        editCategorySelect[0].onchange = function() {
            populateErrorReportCategoryEdit();
        }
    }
}

function populateErrorReportCategoryEditTokenCallback(response){
    var responseObject = JSON.parse(response);
    var accessToken = responseObject.accessToken;

    sendHTTPRequest("GET", getBaseURL() + "api/v1/error-report-categories.php?id=" + getAppendString(), populateErrorReportCategoryEditCallback, "Authorizationtoken", accessToken);
}

function populateErrorReportCategoryEditCallback(response)
{
    var editCategory = document.getElementsByName("edit-category");
    var editEmailDistro = document.getElementsByName("edit-email-distro");
    var editDefault = document.getElementsByName("edit-default");

    var responseObject = JSON.parse(response);

    editCategory[0].value = responseObject.name;
    editEmailDistro[0].value = responseObject.distro;
    if(responseObject.isDefault == 1) {
        editDefault[0].checked = true;
        editDefault[1].checked = false;
    } else {
        editDefault[0].checked = false;
        editDefault[1].checked = true;
    }
}

function populateFeatureRequestCategoryEdit() {
    var manageFeatureRequestCategoriesForm = document.getElementsByName("manage-feature-request-categories");
    if(manageFeatureRequestCategoriesForm.length > 0) {
        var editCategorySelect = document.getElementsByName("edit-category-select");
        var editCategorySelectValue = editCategorySelect[0].value;

        var editCategory = document.getElementsByName("edit-category");
        var editEmailDistro = document.getElementsByName("edit-email-distro");
        var editDefault = document.getElementsByName("edit-default");

        if(editCategorySelectValue != "-- SELECT FEATURE REQUEST CATEGORY TO EDIT --") {
            setAppendString(editCategorySelectValue);
            createAccessToken(populateFeatureRequestCategoryEditTokenCallback);
        } else {
            editCategory[0].value = "";
            editEmailDistro[0].value = "-- SELECT EMAIL DISTRO --";
            editDefault[0].checked = false;
            editDefault[1].checked = true;
        }

        editCategorySelect[0].onchange = function() {
            populateFeatureRequestCategoryEdit();
        }
    }
}

function populateFeatureRequestCategoryEditTokenCallback(response){
    var responseObject = JSON.parse(response);
    var accessToken = responseObject.accessToken;

    sendHTTPRequest("GET", getBaseURL() + "api/v1/feature-request-categories.php?id=" + getAppendString(), populateFeatureRequestCategoryEditCallback, "Authorizationtoken", accessToken);
}

function populateFeatureRequestCategoryEditCallback(response) {

    var editCategory = document.getElementsByName("edit-category");
    var editEmailDistro = document.getElementsByName("edit-email-distro");
    var editDefault = document.getElementsByName("edit-default");

    var responseObject = JSON.parse(response);

    editCategory[0].value = responseObject.name;
    editEmailDistro[0].value = responseObject.distro;
    if(responseObject.isDefault == 1) {
        editDefault[0].checked = true;
        editDefault[1].checked = false;
    } else {
        editDefault[0].checked = false;
        editDefault[1].checked = true;
    }
}

function populateSecurityQuestionEdit() {
    var manageFeatureRequestCategoriesForm = document.getElementsByName("manage-security-questions");
    if(manageFeatureRequestCategoriesForm.length > 0) {
        var editQuestionSelect = document.getElementsByName("edit-question-select");
        var editQuestionSelectValue = editQuestionSelect[0].value;

        var editQuestion = document.getElementsByName("edit-question");

        if(editQuestionSelectValue != "-- SELECT SECURITY QUESTION TO EDIT --") {
            setAppendString(editQuestionSelectValue);
            createAccessToken(populateSecurityQuestionEditTokenCallback);
        } else {
            editQuestion[0].value = "";
        }

        editQuestionSelect[0].onchange = function() {
            populateSecurityQuestionEdit();
        }
    }
}

function populateSecurityQuestionEditTokenCallback(response){
    var responseObject = JSON.parse(response);
    var accessToken = responseObject.accessToken;

    sendHTTPRequest("GET", getBaseURL() + "api/v1/security-questions.php?id=" + getAppendString(), populateSecurityQuestionEditCallback, "Authorizationtoken", accessToken);
}

function populateSecurityQuestionEditCallback(response) {
    var editQuestion = document.getElementsByName("edit-question");
    var responseObject = JSON.parse(response);
    editQuestion[0].value = responseObject.question;
}

function getAppendString() {
    return gAppendString;
}

function setAppendString(appendString) {
    gAppendString = appendString;
}