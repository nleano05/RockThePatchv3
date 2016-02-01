var gOldSecurityQuestionOneAnswer;
var oldSecurityQuestionOneAnswerBase64;
var gOldSecurityQuestionTwoAnswer;
var oldSecurityQuestionTwoAnswerBase64;
var gOldSecurityQuestionThreeAnswer;
var oldSecurityQuestionThreeAnswerBase64;

function getOldSecurityQuestionOneAnswerForAccountInfoEdit() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var cookie = document.cookie;
        var cookieSplit = cookie.split(";");
        for(var x = 0; x < cookieSplit.length; x++) {
            if(cookieSplit[x].indexOf("security_question_one_answer") != -1) {
                oldSecurityQuestionOneAnswerBase64 = cookieSplit[x].replace("security_question_one_answer=", "");
                break;
            }
        }

        createAccessToken(getOldSecurityQuestionOneAnswerForAccountInfoEditTokenCallback);
    }
}

function getOldSecurityQuestionOneAnswerForAccountInfoEditTokenCallback(response) {
    var responseObject = JSON.parse(response);
    var accessToken = responseObject.accessToken;

    if(typeof oldSecurityQuestionOneAnswerBase64 != "undefined") {
        sendHTTPRequest("GET", getBaseURL() + "api/v1/base64decode.php?data=" + oldSecurityQuestionOneAnswerBase64, getOldSecurityQuestionOneAnswerCallback, "Authorizationtoken", accessToken);
    }
}

function getOldSecurityQuestionOneAnswerCallback(response) {
    var responseObject = JSON.parse(response);
    setOldSecurityQuestionOneAnswer(responseObject.data);
}

function getOldSecurityQuestionOneAnswer() {
    return gOldSecurityQuestionOneAnswer;
}

function setOldSecurityQuestionOneAnswer(oldSecurityQuestionOneAnswer) {
    gOldSecurityQuestionOneAnswer = oldSecurityQuestionOneAnswer;
}

function getOldSecurityQuestionTwoAnswerForAccountInfoEdit() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var cookie = document.cookie;
        var cookieSplit = cookie.split(";");
        for(var x = 0; x < cookieSplit.length; x++) {
            if(cookieSplit[x].indexOf("security_question_two_answer") != -1) {
                oldSecurityQuestionOneAnswerBase64 = cookieSplit[x].replace("security_question_two_answer=", "");
                break;
            }
        }

        createAccessToken(getOldSecurityQuestionTwoAnswerForAccountInfoEditTokenCallback);
    }
}

function getOldSecurityQuestionTwoAnswerForAccountInfoEditTokenCallback(response) {
    var responseObject = JSON.parse(response);
    var accessToken = responseObject.accessToken;

    if(typeof oldSecurityQuestionTwoAnswerBase64 != "undefined") {
        sendHTTPRequest("GET", getBaseURL() + "api/v1/base64decode.php?data=" + oldSecurityQuestionTwoAnswerBase64, getOldSecurityQuestionTwoAnswerCallback, "Authorizationtoken", accessToken);
    }
}

function getOldSecurityQuestionTwoAnswerCallback(response) {
    var responseObject = JSON.parse(response);
    setOldSecurityQuestionTwoAnswer(responseObject.data);
}

function getOldSecurityQuestionTwoAnswer() {
    return gOldSecurityQuestionTwoAnswer;
}

function setOldSecurityQuestionTwoAnswer(oldSecurityQuestionTwoAnswer) {
    gOldSecurityQuestionTwoAnswer = oldSecurityQuestionTwoAnswer;
}

function getOldSecurityQuestionThreeAnswerForAccountInfoEdit() {
    var accountInfoEditForm = document.getElementsByName("account-info-edit");
    if(accountInfoEditForm.length > 0) {
        var cookie = document.cookie;
        var cookieSplit = cookie.split(";");
        for(var x = 0; x < cookieSplit.length; x++) {
            if(cookieSplit[x].indexOf("security_question_three_answer") != -1) {
                oldSecurityQuestionOneAnswerBase64 = cookieSplit[x].replace("security_question_three_answer=", "");
                break;
            }
        }

        createAccessToken(getOldSecurityQuestionThreeAnswerForAccountInfoEditTokenCallback);
    }
}

function getOldSecurityQuestionThreeAnswerForAccountInfoEditTokenCallback(response) {
    var responseObject = JSON.parse(response);
    var accessToken = responseObject.accessToken;

    if(typeof oldSecurityQuestionThreeAnswerBase64 != "undefined") {
        sendHTTPRequest("GET", getBaseURL() + "api/v1/base64decode.php?data=" + oldSecurityQuestionThreeAnswerBase64, getOldSecurityQuestionThreeAnswerCallback, "Authorizationtoken", accessToken);
    }
}

function getOldSecurityQuestionThreeAnswerCallback(response) {
    var responseObject = JSON.parse(response);
    setOldSecurityQuestionThreeAnswer(responseObject.data);
}

function getOldSecurityQuestionThreeAnswer() {
    return gOldSecurityQuestionThreeAnswer;
}

function setOldSecurityQuestionThreeAnswer(oldSecurityQuestionThreeAnswer) {
    gOldSecurityQuestionThreeAnswer = oldSecurityQuestionThreeAnswer;
}