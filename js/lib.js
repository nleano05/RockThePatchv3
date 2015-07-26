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

    // Handles the images common to all pages
    for (i = 0; i < mainImages.length; i++) {
        preloadArray[i] = new Image();
        preloadArray[i].src = mainImages[i];
    }

    if(additionalImages !== undefined) {
        // Handles the additional images that are passed in (for images specific to only certain pages)
        for(i = 0; i < additionalImages.length; i++) {
            preloadArray[i] = new Image();
            preloadArray[i].src = additionalImages[i];
        }
    }
}