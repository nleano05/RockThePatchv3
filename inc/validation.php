<?php
$currentURL = lib_get::currentUrl();

$currentURLForCSS = $currentURL;
log_util::log(LOG_LEVEL_DEBUG, "currentURLForCSS: " . $currentURLForCSS);

$currentURL = "https://" . $currentURL;
log_util::log(LOG_LEVEL_DEBUG, "currentURL: " . $currentURL);
?>
<p>
    <a href="http://validator.w3.org/check?uri=<?php echo($currentURL); ?>&amp;ss=1"
       title="Check validation of this markup with HTML5 standards"><img src="/images/validation/html5.png"
                                                                         onmouseover="this.src='/images/validation/html5-hoover.png'"
                                                                         onmouseout="this.src='/images/validation/html5.png'"
                                                                         id="html5-validation-link"
                                                                         alt="Check validation of this markup with HTML5 standards"
                                                                         class="html5-icon"/></a>
    <a href="http://validator.w3.org/check?uri=<?php echo($currentURL); ?>&amp;doctype=XHTML+1.1&amp;=1"
       title="Check validation of this markup with XHTML 1.1 standards"><img src="/images/validation/valid-xhtml11.png"
                                                                             id="xhtml-validation-link"
                                                                             alt="Check validation of this markup with XHTML 1.1 standards"
                                                                             class="validation-icon"/></a>
    <a href="http://validator.w3.org/feed/check.cgi?url=https%3A//www.rockthepatch.com/rss/current-events.xml"
       title="Check validation of the RSS Feed"><img src="/images/validation/valid-rss.png" alt="Check validation of the RSS Feed"
                                                     id="rss-validation-link" class="validation-icon"/></a>
    <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo($currentURLForCSS); ?>&amp;profile=css3"
       title="Check validation of CSS stylesheets with CSS3 standards"><img src="/images/validation/valid-css.png"
                                                                            id="css-validation-link"
                                                                            alt="Check validation of CSS stylesheets with CSS3 standards"
                                                                            class="validation-icon"/></a>
</p>