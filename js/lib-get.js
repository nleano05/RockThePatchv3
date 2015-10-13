var gOldSecurityAnswer;
var oldSecurityAnswerBase64;

function getOldSecurityAnswerForAccountInfoEdit() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var cookie = document.cookie;
        var cookieSplit = cookie.split(";");
        for(var x = 0; x < cookieSplit.length; x++) {
            if(cookieSplit[x].indexOf("securityAnswer") != -1) {
                oldSecurityAnswerBase64 = cookieSplit[x].replace("securityAnswer=", "");
                break;
            }
        }

        createAccessToken(getOldSecurityAnswerForAccountInfoEditTokenCallback);
    }
}

function getOldSecurityAnswerForAccountInfoEditTokenCallback(response) {
    var responseObject = JSON.parse(response);
    var accessToken = responseObject.accessToken;

    if(typeof oldSecurityAnswerBase64 != "undefined") {
        sendHTTPRequest("GET", getBaseURL() + "api/v1/base64decode.php?data=" + oldSecurityAnswerBase64, getOldSecurityAnswerCallback, "Authorizationtoken", accessToken);
    }
}

function getOldSecurityAnswerCallback(response) {
    var responseObject = JSON.parse(response);
    setOldSecurityAnswer(responseObject.data);
}

function getOldSecurityAnswer() {
    return gOldSecurityAnswer;
}

function setOldSecurityAnswer(oldSecurityAnswer) {
    gOldSecurityAnswer = oldSecurityAnswer;
}