<?php 
	$currentURL = lib_get::currentUrl();
	
	$currentURLforCSS = $currentURL;
	log_util::log(LOG_LEVEL_DEBUG, "currentURLforCSS: " . $currentURLforCSS);
	
	$currentURL = "https://" . $currentURL;
	log_util::log(LOG_LEVEL_DEBUG, "currentURL: " . $currentURL);
	
	//dbWritePageStatisticsAndLog($currentURL);
?>
<div id="social-media">
	<a href="aim:addbuddy?screenname=isuPatches"><img src="/images/social-media/aim.png" alt="Add Patches on AIM" title="Add Patches on AIM"/></a>
	<a href="https://www.facebook.com/isuPatches"><img src="/images/social-media/facebook.png" alt="Add Patches on Facebook" title="Add Patches on Facebook"/></a>
	<a href="https://www.facebook.com/rockthepatch"><img src="/images/social-media/facebookalt.png" alt="Like Patches' Facebook Fan Page" title="Like Patches' Facebook Fan Page"/></a>
	<a href="https://github.com/isuPatches"><img src="/images/social-media/github.png" alt="Follow Patches on GitHub" title="Follow Patches on GitHub" style="width:35px;height:auto"/></a>		
	<a href="https://plus.google.com/u/0/+SarahKlinefelter89/posts"><img src="/images/social-media/google.png" alt="Add Patches on Google+" title="Add Patches on Google+"/></a>	
	<a href="https://plus.google.com/u/0/+Rockthepatch/posts"><img src="/images/social-media/googlefan.png" alt="Follow Patches' Google+ Fan Page" title="Follow Patches' Google+ Fan Page"/></a>	
	<a href="http://pinterest.com/isuPatches/"><img src="/images/social-media/pinterest.png" alt="Follow Patches on Pintrest" title="Follow Patches on Pintrest" style="width:28px;height:auto"/></a>	
	<a href="http://www.last.fm/user/isuPatches"><img src="/images/social-media/lastfm.png" alt="Add Patches on Last FM" title="Add Patches on Last FM"/></a>
	<a href="https://www.linkedin.com/pub/sarah-klinefelter/a8/b35/979"><img src="/images/social-media/linkedIN.png" alt="Connect with Patches on LinkedIN" title="Connect with Patches on LinkedIN"/></a>
	<a href="http://www.pandora.com/profile/isupatches"><img src="/images/social-media/pandora.png" alt="Add Patches on Pandora Radio" title="Add Patches on Pandora Radio"/></a>
	<a href="https://www.rockthepatch.com/rss/current-events.xml" type="application/rss+xml"><img src="/images/social-media/rss.png" alt="View or Subscribe to Patches' RSS Feed" title="Patches' RSS Feed"/></a>
	<a href="https://soundcloud.com/isupatches"><img src="/images/social-media/soundcloud.png" alt="Follow Patches on SoundCloud" title="Follow Patches on SoundCloud"/></a>
	<a href="http://twitter.com/#!/isuPatches"><img src="/images/social-media/twitter.png" alt="Follow Patches on Twitter" title="Follow Patches on Twitter"/></a>
	<a href="http://pulse.yahoo.com/_FWIZRSMLF3GEXRTMKJKO3TDUVY"><img src="/images/social-media/yahoo.png" alt="Add Patches on Yahoo" title="Add Patches on Yahoo"/></a>
	<a href="ymsgr:addfriend?isuPatches"><img src="/images/social-media/yahoomessenger.png" alt="Add Patches on Yahoo Messenger" title="Add Patches on Yahoo Messenger"/></a>
	<a href="http://www.youtube.com/isuPatches"><img src="/images/social-media/youtube.png" alt="Subscribe to Patches on YouTube (current)" title="Subscribe to Patches on YouTube (current)"/></a>
	<a href="http://www.youtube.com/ccPatches"><img src="/images/social-media/youtubealt.png" alt="Subscribe to Patches on YouTube (old)" title="Subscribe to Patches on YouTube (old)"/></a>
</div>
<div id="note">
	<p><em><strong>*NOTE*</strong> You must have the respective software installed on your computer to add/follow 
	Patches on AIM, Yahoo Messenger, and Windows Live Messenger. Some messenger links will not work on 
	mobile. You also may be required to log into an account depending on the service.</em></p>	
</div>
<div id="contact-info">
	<p>   
		<strong>Created by:</strong> Patches<br />
		<strong>Last Updated:</strong> <?php echo($timeModified . " GMT"); ?><br/>
		<strong>Email: </strong><a href="mailto:<?php echo($gMasterAdminEmail); ?>?subject='Rock%20the%20Patch!'%20Email%20from%20user" title="Email <?php echo($gMasterAdminName); ?>"><?php echo($gMasterAdminEmail); ?></a>
	</p>
</div>
<div id="share-buttons">	
	<div class="share-button">
		<p>
			<a href="https://plus.google.com/share?url=<?php echo($currentURL); ?>" >Share on Google</a>
		</p>
	</div>
	
	<div class="share-button">
		<p>
			<a href="http://www.facebook.com/share.php?u=<?php echo($currentURL); ?>" >Share on Facebook</a>
		</p>
	</div>
	
	<div class="share-button">
		<p>
			<a href="http://twitter.com/share" >Share on Twitter</a>
		</p>
	</div>
</div>
<div class="clear"></div>
<div id="validation">
	<p>
		<a href="http://validator.w3.org/check?uri=<?php echo($currentURL); ?>&amp;ss=1" title="Check validation of this markup with HTML5 standards"><img src="/images/html5.png" id="html5-validation-link" alt="Check validation of this markup with HTML5 standards" class="html5" /></a>
	</p>
	<p>
		<a href="http://validator.w3.org/feed/check.cgi?url=https%3A//www.rockthepatch.com/rss/current-events.xml" title="Check validation of the RSS Feed"><img src="/images/valid-rss.png" alt="Check validation of the RSS Feed" id="rss-validation-link" class="valid"/></a>
		<a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo($currentURLforCSS); ?>&amp;profile=css3" title="Check validation of CSS stylesheets with CSS3 standards"><img src="/images/valid-css.png" id="css-validation-link" alt="Check validation of CSS stylesheets with CSS3 standards" class="valid"/></a>	              
		<a href="http://validator.w3.org/check?uri=<?php echo($currentURL); ?>&amp;doctype=XHTML+1.1&amp;=1" title="Check validation of this markup with XHTML 1.1 standards"><img src="/images/valid-xhtml11.png" id="xhtml-validation-link" alt="Check validation of this markup with XHTML 1.1 standards" class="valid" /></a>	
	</p>
	<div id="click">
		<p>
       	   	<em>(Click on the icon to see the validation thanks to the W3C)</em>
       	</p>
	</div>
</div>