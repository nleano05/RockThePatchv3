window.onload = function() {
    document.getElementsByName('file').size = '2';

    autoformatPhoneNumberWatcher();

    populateAnnoyanceLevelEdit();
    populateEmailDistroEdit();
    populateErrorReportCategoryEdit();
    populateFeatureRequestCategoryEdit();
    populateSecurityQuestionEdit();

    syncLoginForms();

    toggleAccessControlBlockType();
    toggleAccountInfoEditConfirmEmail();
    toggleAccountInfoEditConfirmSecurityQuestionOneAnswer();
    toggleAccountInfoEditConfirmSecurityQuestionTwoAnswer();
    toggleAccountInfoEditConfirmSecurityQuestionThreeAnswer();
    toggleAccountInfoEditNewPassword();
    toggleAnnoyanceLevelsAddEditOrDelete();
    toggleEmailDistrosAddEditOrDelete();
    toggleErrorReportCategoryAddEditOrDelete();
    toggleFeatureRequestCategoryAddEditOrDelete();
    toggleSecurityQuestionAddEditOrDelete();
};

function createAccessToken(callback) {
    sendHTTPRequest("GET", getBaseURL() + "api/v1/token.php", callback, "Clientsecret", "fakeClientSecret");
}

function getBaseURL() {
    var baseUrl;
    if(document.URL.indexOf("https://www.rockthepatch.com") != -1){
        baseUrl = "https://www.rockthepatch.com/";
    } else if(document.URL.indexOf("https://rockthepatch.com") != -1){
        baseUrl = "https://rockthepatch.com/";
    } else if(document.URL.indexOf("https://staging.rockthepatch.com") != -1){
        baseUrl = "https://staging.rockthepatch.com/";
    } else if(document.URL.indexOf("https://integration.rockthepatch.com") != -1){
        baseUrl = "https://integration.rockthepatch.com/";
    } else if(document.URL.indexOf("https://v3.rockthepatch.com") != -1){
        baseUrl = "https://v3.rockthepatch.com/";
    } else if(document.URL.indexOf("127.0.0.1") != -1) {
        baseUrl = "http://127.0.0.1/";
    }

    return baseUrl;
}

/**
 *  This function hides an element/object on the screen
 *
 * @param what the element or object to hide
 *
 * @return bool false
 * @throws - Nothing
 * @global - None
 * @notes  - None
 *
 * @example - onclick="hidePageElement('possible-limitations')"
 *
 * @author - Patches
 * @version - 1.0
 * @history - Created 08/01/2015
 */
function hidePageElement(what) {
    var obj = typeof what == 'object' ? what : document.getElementById(what);

    obj.style.display = 'none';

    return false;
}

/**
 *  This function preloads images so the load time is better
 *
 * @param additionalImages array An array of additional images to preload for a page
 *
 * @return Nothing
 * @throws - Nothing
 * @global - None
 * @notes
 *      - Has a default list of images to preload that should be valid for all sections
 *      - Can pass in array of additonal image locations to preload for images not specific to all pages
 *
 * @example - preloadImages();
 * @example - preloadImages(additionalImages();
 *
 * @author - Patches
 * @version - 1.0
 * @history - Created 08/01/2015
 */
function preloadImages(additionalImages) {
    var mainImages = [
        "/images/validation/html5.png",
        "/images/validation/html5-hover.png",
        "/images/icons-and-logos/rss.png",
        "/images/icons-and-logos/rss-hover.png",
        "/images/validation/valid-css.png",
        "/images/validation/valid-rss.png",
        "/images/validation/valid-xhtml11.png",
        "/images/social-media/aim.png",
        "/images/social-media/aim-hover.png",
        "/images/social-media/facebook.png",
        "/images/social-media/facebook-hover.png",
        "/images/social-media/facebook-alt.png",
        "/images/social-media/facebook-alt-hover.png",
        "/images/social-media/github.png",
        "/images/social-media/github-hover.png",
        "/images/social-media/google-plus.png",
        "/images/social-media/google-plus-hover.png",
        "/images/social-media/pinterest.png",
        "/images/social-media/pinterest-hover.png",
        "/images/social-media/lastfm.png",
        "/images/social-media/lastfm-hover.png",
        "/images/social-media/linkedin.png",
        "/images/social-media/linkedin-hover.png",
        "/images/social-media/pandora.png",
        "/images/social-media/pandora-hover.png",
        "/images/social-media/soundcloud.png",
        "/images/social-media/soundcloud-hover.png",
        "/images/social-media/twitter.png",
        "/images/social-media/twitter-hover.png",
        "/images/social-media/yahoo.png",
        "/images/social-media/yahoo-hover.png",
        "/images/social-media/youtube.png",
        "/images/social-media/youtube-hover.png",
        // Start interactions section icons
        "/images/icons-and-logos/error-report.png",
        "/images/icons-and-logos/error-report-hover.png",
        "/images/icons-and-logos/feature-request.png",
        "/images/icons-and-logos/feature-request-hover.png",
        // Start validation section icons
        "/images/validation/html5.png",
        "/images/validation/html5-hover.png",
        "/images/validation/valid-css.png",
        "/images/validation/valid-rss.png",
        "/images/validation/valid-xhtml11.png"];

    var preloadArray = [];

    for (var i = 0; i < mainImages.length; i++) {
        preloadArray[i] = new Image();
        preloadArray[i].src = mainImages[i];
    }

    if(additionalImages !== undefined) {
        for(i = 0; i < additionalImages.length; i++) {
            preloadArray[i] = new Image();
            preloadArray[i].src = additionalImages[i];
        }
    }
}


/**
 *  This function rotates through a list of images given a holder element and start index
 *
 * @param whichHolder The element that is holding the images
 * @param startIndex The index of the image to start with
 *
 * @return Nothing
 * @throws - Nothing
 * @global - None
 * @notes  - None
 *
 * @example - rotateImages(1, 0);
 *
 * @author - Patches
 * @version - 1.0
 * @history - Created 08/01/2015
 */
function rotateImages(whichHolder, startIndex) {
    var rotatingImageArray = eval("rotatingImageArray" + whichHolder);
    var rotatingImageHolder = eval("rotatingImageHolder" + whichHolder);
    if(startIndex >= rotatingImageArray.length)
    {
        startIndex = 0;
    }
    rotatingImageHolder.src = rotatingImageArray[startIndex];
    window.setTimeout("rotateImages(" + whichHolder + "," + (startIndex + 1) + ")", 3000);
}

function sendHTTPRequest(method, url, callback, header, value) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open(method, url, true);
    if(header !== undefined && value !== undefined) {
        xmlHttp.setRequestHeader(header, value);
    }
    xmlHttp.onload = function (e) {
        if(xmlHttp.readyState === 4 && xmlHttp.status === 200) {
            callback(xmlHttp.responseText);
        }
    };
    xmlHttp.send(null);
}

/**
 *  This function makes an element/object on the screen visible
 *
 * @param what the element or object to show
 *
 * @return bool false
 * @throws - Nothing
 * @global - None
 * @notes  - None
 *
 * @example - onclick="showPageElement('possible-limitations')"
 *
 * @author - Patches
 * @version - 1.0
 * @history - Created 08/01/2015
 */
function showPageElement(what)  {
    var obj = typeof what == 'object' ? what : document.getElementById(what);

    obj.style.display = 'block';

    return false;
}


/**
 *  This function toggles the visibility of an element/object on the screen depending on if it's currently visible or not
 *
 * @param what the element or object to toggle the visibility of
 *
 * @return bool false
 * @throws - Nothing
 * @global - None
 * @notes  - None
 *
 * @example - onclick="togglePageElementVisibility('possible-limitations')"
 *
 * @author - Patches
 * @version - 1.0
 * @history - Created 08/01/2015
 */
function togglePageElementVisibility(what) {
    var obj = typeof what == 'object' ? what : document.getElementById(what);

    if (obj.style.display == 'none') {
        obj.style.display = 'block';
    } else {
        obj.style.display = 'none';
    }
    return false;
}