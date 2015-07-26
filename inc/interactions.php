<h1>Contact Us</h1>
<p class="interactions-description">
    Have a request or a bad experience? Let us know!
</p>
<div class="interactions-section">
    <a href="/user-system/feature-request.php"
       onmouseover="onHoverFeatureRequest();"
       onmouseout="offHoverFeatureRequest();"
       title="Request a feature">
        <img src="/images/icons-and-logos/feature-request.png"
             class="feature-request-img"
             alt="Request feature"/>
        <span style="margin-left:5px;">Request a feature</span></a>
</div>
<div class="interactions-section">
    <a href="/user-system/error-report.php"
       onmouseover="onHoverErrorReport();"
       onmouseout="offHoverErrorReport();"
       title="Report an issue">
        <img src="/images/icons-and-logos/error-report.png"
             class="error-report-img"
             alt="Report issue"/>
        <span style="">Report an issue</span></a>
</div>
<script type='text/javascript'>
    function onHoverFeatureRequest() {
        $(".feature-request-img").attr("src", "/images/icons-and-logos/feature-request-hover.png");
    }

    function offHoverFeatureRequest() {
        $(".feature-request-img").attr("src", "/images/icons-and-logos/feature-request.png");
    }

    function onHoverErrorReport() {
        $(".error-report-img").attr("src", "/images/icons-and-logos/error-report-hover.png");
    }
    function offHoverErrorReport() {
        $(".error-report-img").attr("src", "/images/icons-and-logos/error-report.png");
    }
</script>