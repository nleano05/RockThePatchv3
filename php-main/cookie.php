<?php
/** @noinspection PhpUndefinedVariableInspection */
if($gDebugMode) {
    echo("<div style='width:100%;text-align:center;'><p style='color:red;'><strong><em>");
    echo("#########################################################################################################<br/>");
    echo("#########################################################################################################<br/>");
    echo("########################################  DEBUG MODE IS ENABLED NOW...OUTPUT WILL BE RIDICULOUS  #######################<br/>");
    echo("##########################################################################################################<br/>");
    echo("##########################################################################################################");
    echo("</em></strong></p></div>");
    echo("<p><strong><em>*NOTES*<br/>");
    echo("<br/>- To logout in debug mode, you must use the 'Logout In Debug Mode' link in the user nav area");
    echo("<br/>- To login after logging out via 'Logout In Debug Mode' you must use the 'Login With Debug Mode' button in the Login area</em></strong></p>");
    ?>
    <form action="../web-admin/modify-debug-mode-edit.php" method="post">
        <p><input type="submit" value="Disable Debug Mode For This Session" name="disable" class="button" /></p>
    </form>
    <?php
}

$gLoginStatus = lib_get::loginStatus();
lib_check::sessionId();

$blocked = lib_check::blocked();
if($blocked) {
    lib::redirect(FALSE, NULL, FALSE, lib_get::baseUrl() . "blocked.php");
}