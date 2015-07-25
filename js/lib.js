function preloadImages(additionalImages) {
    var mainImages = [
        "/images/html5.png",
        "/images/html5-hoover.png",
        "/images/icons-and-logos/rss.png",
        "/images/icons-and-logos/rss-hoover.png",
        "/images/valid-css.png",
        "/images/valid-rss.png",
        "/images/valid-xhtml11.png",
        "/images/social-media/aim.png",
        "/images/social-media/aim-hoover.png",
        "/images/social-media/facebook.png",
        "/images/social-media/facebook-hoover.png",
        "/images/social-media/facebook-alt.png",
        "/images/social-media/facebook-alt-hoover.png",
        "/images/social-media/github.png",
        "/images/social-media/github-hoover.png",
        "/images/social-media/google-plus.png",
        "/images/social-media/google-plus-hoover.png",
        "/images/social-media/pinterest.png",
        "/images/social-media/pinterest-hoover.png",
        "/images/social-media/lastfm.png",
        "/images/social-media/lastfm-hoover.png",
        "/images/social-media/linkedIN.png",
        "/images/social-media/linkedIN-hoover.png",
        "/images/social-media/pandora.png",
        "/images/social-media/pandora-hoover.png",
        "/images/social-media/soundcloud.png",
        "/images/social-media/soundcloud-hoover.png",
        "/images/social-media/twitter.png",
        "/images/social-media/twitter-hoover.png",
        "/images/social-media/yahoo.png",
        "/images/social-media/yahoo-hoover.png",
        "/images/social-media/youtube.png",
        "/images/social-media/youtube-hoover.png"];

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