<?php
session_save_path('/tmp');

include("php-main/lib.php");
include("php-main/cookie.php");

$timeModified = gmdate("F d, Y h:m:s", getlastmod());

$error = isset($_GET['error']) ? $_GET['error'] : "";

switch($error) {
    case 400:
        $title = "Bad Request";
        $description = "Bad syntax prevented the request from being processed.";
        $wikiDescription = "The request cannot be fulfilled due to bad syntax.";
        break;
    case 401:
        $title = "Unauthorized";
        $description = "Authentication is required or has failed.";
        $wikiDescription = "Similar to 403 Forbidden, but specifically for use when authentication is required and has failed or has not yet been provided. The response must include a WWW-Authenticate header field containing a challenge applicable to the requested resource. See Basic access authentication and Digest access authentication.";
        break;
    case 402:
        $title = "Payment Required";
        $description = "This code was intended to be used with digital cash systems but not really in use.";
        $wikiDescription = "Reserved for future use. The original intention was that this code might be used as part of some form of digital cash or micropayment scheme, but that has not happened, and this code is not usually used. As an example of its use, however, Apple's defunct MobileMe service generated a 402 error if the MobileMe account was delinquent.[citation needed] In addition, YouTube uses this status if a particular IP address has made excessive requests, and requires the person to enter a CAPTCHA.";
        break;
    case 403:
        $title = "Forbidden";
        $description = "The request was valid, but the server is refusing to respond to it.";
        $wikiDescription = "The request was a valid request, but the server is refusing to respond to it. Unlike a 401 Unauthorized response, authenticating will make no difference. On servers where authentication is required, this commonly means that the provided credentials were successfully authenticated but that the credentials still do not grant the client permission to access the resource (e.g. a recognized user attempting to access restricted content).";
        break;
    case 404:
        $title = "Not Found";
        $description = "The requested resource could not be found.";
        $wikiDescription = "The requested resource could not be found but may be available again in the future. Subsequent requests by the client are permissible.";
        break;
    case 405:
        $title = "Method Not Allowed";
        $description = "The request tried to use a method that's not supported by that resource.";
        $wikiDescription = "A request was made of a resource using a request method not supported by that resource; for example, using GET on a form which requires data to be presented via POST, or using PUT on a read-only resource.";
        break;
    case 406:
        $title = "Not Acceptable";
        $description = "The requested resource is only capable of generating content based on the Accept headers.";
        $wikiDescription = "The requested resource is only capable of generating content not acceptable according to the Accept headers sent in the request.";
        break;
    case 407:
        $title = "Proxy Authentication Required";
        $description = "The client must authenticate with the proxy first.";
        $wikiDescription = "The client must first authenticate itself with the proxy.";
        break;
    case 408:
        $title = "Request Timeout";
        $description = "The server timed out while waiting for the request.";
        $wikiDescription = "The server timed out waiting for the request. According to W3 HTTP specifications: 'The client did not produce a request within the time that the server was prepared to wait. The client MAY repeat the request without modifications at any later time.'";
        break;
    case 409:
        $title = "Conflict";
        $description = "The request could not be processed due to a conflict.";
        $wikiDescription = "Indicates that the request could not be processed because of conflict in the request, such as an edit conflict.";
        break;
    case 410:
        $title = "Gone";
        $description = "The resource requested is no longer available.";
        $wikiDescription = "Indicates that the resource requested is no longer available and will not be available again. This should be used when a resource has been intentionally removed and the resource should be purged. Upon receiving a 410 status code, the client should not request the resource again in the future. Clients such as search engines should remove the resource from their indices. Most use cases do not require clients and search engines to purge the resource, and a '404 Not Found' may be used instead.";
        break;
    case 411:
        $title = "Length Required";
        $description = "The request did not specify the length of its content.";
        $wikiDescription = "The request did not specify the length of its content, which is required by the requested resource.";
        break;
    case 412:
        $title = "Precondition Failed";
        $description = "The server does not meet one of the preconditions that was in the request.";
        $wikiDescription = "The server does not meet one of the preconditions that the requester put on the request.";
        break;
    case 413:
        $title = "Request Entity Too Large";
        $description = "The request is too large for the server to process.";
        $wikiDescription = "The request is larger than the server is willing or able to process.";
        break;
    case 414:
        $title = "Request-URI Too Long";
        $description = "The URI was too long for the server to process.";
        $wikiDescription = "The URI provided was too long for the server to process.";
        break;
    case 415:
        $title = "Unsupported Media Type";
        $description = "The request had a media type that the server does not support.";
        $wikiDescription = "The request entity has a media type which the server or resource does not support. For example, the client uploads an image as image/svg+xml, but the server requires that images use a different format.";
        break;
    case 416:
        $title = "Requested Range Not Satisfiable";
        $description = "The client has requested a portion of a file, but the server cannot supply it.";
        $wikiDescription = "The client has asked for a portion of the file, but the server cannot supply that portion. For example, if the client asked for a part of the file that lies beyond the end of the file.";
        break;
    case 417:
        $title = "Expectation Failed";
        $description = "The server did not meet the requirments in the request header.";
        $wikiDescription = "The server cannot meet the requirements of the Expect request-header field.";
        break;
    case 422:
        $title = "Unprocessable Entity (WebDAV; RFC 4918)";
        $description = "The request was not followed due to semantic errors.";
        $wikiDescription = "The request was well-formed but was unable to be followed due to semantic errors.";
        break;
    case 423:
        $title = "Locked (WebDAV; RFC 4918)";
        $description = "The resource is locked.";
        $wikiDescription = "The resource that is being accessed is locked.";
        break;
    case 424:
        $title = "Failed Dependency (WebDAV; RFC 4918) / Method Failure (WebDAV)";
        $description = "The request failed due to a previous request or method failure.";
        $wikiDescription = "The request failed due to failure of a previous request (e.g. a PROPPATCH). Indicates the method was not executed on a particular resource within its scope because some part of the method's execution failed causing the entire method to be aborted.";
        break;
    case 426:
        $title = "Upgrade Required (RFC 2817)";
        $description = "The client should switch to a different protocol.";
        $wikiDescription = "The client should switch to a different protocol such as TLS/1.0.";
        break;
    case 428:
        $title = "Precondition Required (RFC 6585)";
        $description = "The orgin server requires the request to be conditional.";
        $wikiDescription = "The origin server requires the request to be conditional. Intended to prevent 'the 'lost update' problem, where a client GETs a resource's state, modifies it, and PUTs it back to the server, when meanwhile a third party has modified the state on the server, leading to a conflict.'";
        break;
    case 429:
        $title = "Too Many Requests (RFC 6585)";
        $description = "The user has sent too many requests in a given amount of time.";
        $wikiDescription = "The user has sent too many requests in a given amount of time. Intended for use with rate limiting schemes.";
        break;
    case 431:
        $title = "Request Header Fields Too Large (RFC 6585)";
        $description = "The server is unwilling to process the request due to headers being too large.";
        $wikiDescription = "The server is unwilling to process the request because either an individual header field, or all the header fields collectively, are too large.";
        break;
    case 500:
        $title = "Internal Server Error";
        $description = "A generic message for a server level error because nothing else fits.";
        $wikiDescription = "A generic error message, given when no more specific message is suitable.";
        break;
    default:
        $title = "Title not found.";
        $description = "Description not found.";
        $wikiDescription = "Wikipedia description not found.";
        break;
}

lib_database::writeErrorStatisticsAndLog($error, $title);
?>
<!DOCTYPE html>
<!-- ### Sets the class and language for IE 7,8, and 9 ### -->
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->

<!-- ### Sends users with a older version of IE to a page so they can update ### -->
<!--[if lt IE 7]>
<meta http-equiv="refresh" content="0; url=/update-browser.php">
<![endif]-->

<!-- ### START Head ### -->
<head>
    <!-- ### Basic Page Needs and Meta Data ### -->
    <title>Rock the Patch! v3 - Error Doc</title>
    <meta name="robots" content="all"/>
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
    <meta name="description" content="Rock the Patch! Musician, Programmer, Artist, and More"/>
    <meta name="author" content="Patches"/>
    <meta name="keywords" content="patches, xhtml 1.1, html5, xhtml5, rss, css3, xsl(T), programmer, rock the patch, writer, artist, musician, mobile"/>

    <!--[if lt IE 9]>
    <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- ### Mobile Specific Meta Needs ###-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <!-- ### CSS Imports ### -->
    <link rel="stylesheet" href="/css/main.css" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/css/adjust.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="/css/print.css" type="text/css" media="print"/>

    <!-- ### Style Adjustments for IE 7 ### -->
    <!--[if IE 7]>
    <link rel="stylesheet" href="/css/ie7.css" type="text/css" media="screen"/>
    <![endif]-->

    <!-- ### Favicons ### -->
    <link rel="shortcut icon" href="/images/icons-and-logos/favicon.ico"/>
    <link rel="apple-touch-icon" href="/images/icons-and-logos/apple-touch-icon.png"/>
    <link rel="apple-touch-icon" href="/images/icons-and-logos/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon" href="/images/icons-and-logos/apple-touch-icon-114x114.png"/>

    <!-- ### JQuerey Imports ###, JSUnresolvedLibraryURL, JSUnresolvedLibraryURL -->
    <!--suppress JSUnresolvedLibraryURL -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <!-- ### Common Javascript Library Imports ### -->
    <script type="text/javascript" src="/js/lib.js"></script>
    <script type="text/javascript" src="/js/lib-autoformat.js"></script>
    <script type="text/javascript" src="/js/lib-gallery.js"></script>
    <script type="text/javascript" src="/js/lib-get.js"></script>
    <script type="text/javascript" src="/js/lib-populate.js"></script>
    <script type="text/javascript" src="/js/lib-sync.js"></script>
    <script type="text/javascript" src="/js/lib-toggle.js"></script>

    <!-- ### Javascript to preload images on the page ### -->
    <script type="text/javascript">
        preloadImages();
    </script>
</head>
<!-- ### END Head ### -->
<!-- ### START Body ### -->
<body>
<!-- ### START container ### -->
<div class="container">
    <!-- ### START header ### -->
    <div id="header">
        <!-- ### START site-nav -->
        <div id="site-nav">
            <!-- ### START nav-bar ### -->
            <div id="nav-bar">
                <?php require_once("inc/nav-bar.php"); ?>
            </div>
            <!-- ### END nav-bar ### -->
            <!-- ### START user-nav ### -->
            <div id="user-nav">
                <?php require_once("inc/user-nav.php"); ?>
            </div>
            <!-- ### END user-nav ### -->
        </div>
        <!-- ### END site-nav -### -->
    </div>
    <!-- ### END header ### -->
    <!-- ### START content-area-left ### -->
    <div id="content-area-left">
        <!-- ### START login-mobile ### -->
        <div id="login-mobile">
            <?php require("inc/login.php"); ?>
        </div>
        <!-- ### END login ### -->
        <!-- ### START recent-updates ### -->
        <div id="recent-updates">
            <?php require_once("inc/recent-updates.php"); ?>
        </div>
        <!-- ### END recent-updates ### -->
        <!-- ### START contact-info ### -->
        <div id="interactions">
            <?php require("inc/interactions.php"); ?>
        </div>
        <!-- ### END contact-info ### -->
    </div>
    <!-- ### END content-area-left ### -->
    <!-- ### START content-area ### -->
    <div id="content-area">
        <div id="bread-crumbs"><a href="/" title="Home">Home</a> / <?php echo($error); ?> <?php echo($title); ?> </div>
        <h1><?php if(($error >= 400) && ($error < 500)){ echo("Client Error"); }else if(($error >= 500) && ($error < 600)){ echo("Server Error"); } ?> - <?php echo($error); ?> <?php echo($title); ?> </h1>

        <p><?php echo($description); ?></p>

        <h2>Explanation of Error (taken from Wikipedia):</h2>

        <p><em>"<?php echo($wikiDescription); ?>"</em></p>
    </div>
    <!-- ### END content-area ### -->
    <!-- ### START content-area-right ### -->
    <div id="content-area-right">
        <!-- ### START login ### -->
        <div id="login">
            <?php require("inc/login.php"); ?>
        </div>
        <!-- ### END login ### -->
        <!-- ### START contact-info ### -->
        <div id="interactions-mobile">
            <?php require("inc/interactions.php"); ?>
        </div>
        <!-- ### END contact-info ### -->
        <!-- ### START RSS feed ### -->
        <div id="rss">
            <?php require_once('inc/rss.php'); ?>
        </div>
        <!-- ### END RSS feed ### -->
        <!-- ### START validation ### -->
        <div id="validation">
            <?php require_once("inc/validation.php"); ?>
        </div>
        <!-- ### END validation ### -->
    </div>
    <!-- ### END content-area-right ### -->
    <!-- ### START Footer ### -->
    <div id="footer">
        <?php require_once('inc/footer.php'); ?>
        <div id="footer-background"></div>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-64564354-1']);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>
    </div>
    <!-- ### END Footer ### -->
</div>
<!-- ### END Container ### -->
</body>
<!-- ### END Body ### -->
</html>