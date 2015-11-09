function populateAnnoyanceLevelEdit() {
    var manageAnnoyanceLevelsForm = document.getElementsByName("manage-annoyance-levels");
    if(manageAnnoyanceLevelsForm.length > 0) {
        var editAnnoyanceLevelSelect = document.getElementsByName("edit-annoyance-level-select");
        var editAnnoyanceLevelSelectValue = editAnnoyanceLevelSelect[0].value;

        //var editAnnoyanceLevelSelectValueSplit = editAnnoyanceLevelSelectValue.split(" - ");
        //
        //var editLevel = document.getElementsByName("edit-level");
        //var editName = document.getElementsByName("edit-name");

        if(editAnnoyanceLevelSelectValue != "-- SELECT ANNOYANCE LEVEL TO EDIT --"){
            setAppendString(editAnnoyanceLevelSelectValue[0]);
            createAccessToken(populateAnnoyanceLevelEditTokenCallback);
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

function getAppendString() {
    return gAppendString;
}

function setAppendString(appendString) {
    gAppendString = appendString;
}