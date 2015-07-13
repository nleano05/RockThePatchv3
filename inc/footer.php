<!-- ### Style Adjustments for IE 7 ### -->
<!--[if IE 7]>
<style>
    .share-button{margin: auto 15px;display: inline;}

    #social-media {
        margin-top: -7px;
    }

    #contact-info {
        margin-top: -7px;
    }
</style>
<![endif]-->
<?php
$currentURL = lib_get::currentUrl();

$currentURLForCSS = $currentURL;
log_util::log(LOG_LEVEL_DEBUG, "currentURLForCSS: " . $currentURLForCSS);

$currentURL = "https://" . $currentURL;
log_util::log(LOG_LEVEL_DEBUG, "currentURL: " . $currentURL);

//dbWritePageStatisticsAndLog($currentURL);
?>
<div id="social-media">
    <!--suppress HtmlUnknownTarget -->
    <a href="aim:addbuddy?screenname=isuPatches"><img src="/images/social-media/aim.png"
                                                      class="aim-icon"
                                                      alt="Add Patches on AIM"
                                                      title="Add Patches on AIM"/></a>
    <a href="https://www.facebook.com/isuPatches"><img src="/images/social-media/facebook.png"
                                                       class="facebook-icon"
                                                       alt="Add Patches on Facebook"
                                                       title="Add Patches on Facebook"/></a>
    <a href="https://www.facebook.com/rockthepatch"><img src="/images/social-media/facebook-alt.png"
                                                         class="facebook-alt-icon"
                                                         alt="Like Patches' Facebook Fan Page"
                                                         title="Like Patches' Facebook Fan Page"/></a>
    <a href="https://github.com/isuPatches"><img src="/images/social-media/github.png"
                                                 class="github-icon"
                                                 alt="Follow Patches on GitHub"
                                                 title="Follow Patches on GitHub"/></a>
    <a href="https://plus.google.com/u/0/+SarahKlinefelter89/posts"><img src="/images/social-media/google-plus.png"
                                                                         class="google-plus-icon"
                                                                         alt="Add Patches on Google+"
                                                                         title="Add Patches on Google+"/></a>
    <a href="http://pinterest.com/isuPatches/"><img src="/images/social-media/pinterest.png"
                                                    class="pinterest-icon"
                                                    alt="Follow Patches on Pintrest"
                                                    title="Follow Patches on Pintrest"/></a>
    <a href="http://www.last.fm/user/isuPatches"><img src="/images/social-media/lastfm.png"
                                                      class="lastfm-icon"
                                                      alt="Add Patches on Last FM"
                                                      title="Add Patches on Last FM"/></a>
    <a href="https://www.linkedin.com/pub/sarah-klinefelter/a8/b35/979"><img src="/images/social-media/linkedin.png"
                                                                             class="linkedin-icon"
                                                                             alt="Connect with Patches on LinkedIN"
                                                                             title="Connect with Patches on LinkedIN"/></a>
    <a href="http://www.pandora.com/profile/isupatches"><img src="/images/social-media/pandora.png"
                                                             class="pandora-icon"
                                                             alt="Add Patches on Pandora Radio"
                                                             title="Add Patches on Pandora Radio"/></a>
    <a href="https://www.rockthepatch.com/rss/current-events.xml" type="application/rss+xml"><img
            src="/images/icons-and-logos/rss.png" class="rss-icon" alt="View or Subscribe to Patches' RSS Feed" title="Patches' RSS Feed"/></a>
    <a href="https://soundcloud.com/isupatches"><img src="/images/social-media/soundcloud.png"
                                                     class="soundcloud-icon"
                                                     alt="Follow Patches on SoundCloud"
                                                     title="Follow Patches on SoundCloud"/></a>
    <a href="http://twitter.com/#!/isuPatches"><img src="/images/social-media/twitter.png"
                                                    alt="Follow Patches on Twitter" title="Follow Patches on Twitter"/></a>
    <!--suppress HtmlUnknownTarget -->
    <a href="ymsgr:addfriend?isuPatches"><img src="/images/social-media/yahoo.png"
                                              class="yahoo-icon"
                                              alt="Add Patches on Yahoo Messenger"
                                              title="Add Patches on Yahoo Messenger"/></a>
    <a href="http://www.youtube.com/isuPatches"><img src="/images/social-media/youtube.png"
                                                     class="youtube-icon"
                                                     alt="Subscribe to Patches on YouTube"
                                                     title="Subscribe to Patches on YouTube"/></a>
</div>
<div id="note">
    <p><em><strong>*NOTE*</strong> You must have the respective software installed on your computer to add/follow
            Patches on AIM, Yahoo Messenger, and Windows Live Messenger. Some messenger links will not work on
            mobile. You also may be required to log into an account depending on the service.</em></p>
</div>
<div id="share-buttons">
    <div class="share-button">
        <p>
            <a href="https://plus.google.com/share?url=<?php echo($currentURL); ?>">Share on Google</a>
        </p>
    </div>

    <div class="share-button">
        <p>
            <a href="http://www.facebook.com/share.php?u=<?php echo($currentURL); ?>">Share on Facebook</a>
        </p>
    </div>

    <div class="share-button">
        <p>
            <a href="http://twitter.com/share">Share on Twitter</a>
        </p>
    </div>
</div>
<div class="clear"></div>
<div id="contact-info">
    <p>
        <strong>Created by:</strong> Patches<br/> <a href="mailto:<?php if (isset($gMasterAdminEmail)) {
            echo($gMasterAdminEmail);
        } ?>?subject='Rock%20the%20Patch!'%20Email%20from%20user" title="Email <?php if (isset($gMasterAdminName)) {
            echo($gMasterAdminName);
        } ?>"><?php if (isset($gMasterAdminEmail)) {
                echo($gMasterAdminEmail);
            } ?></a><br/>
        <strong>Updated:</strong> <?php echo($timeModified . " GMT"); ?>
    </p>
</div>
<div id="v3"><p>v3</p></div>
<div class="clear"></div>