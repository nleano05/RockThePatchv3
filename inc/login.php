<?php
/** @noinspection PhpUndefinedVariableInspection */
if ($gLoginStatus != STATUS_LOGGED_IN) {
    log_util::log(LOG_LEVEL_DEBUG, "User IS NOT logged in");
    ?>
<!--    <h1 style="text-align:center;">Login</h1>-->

    <form method="post" name="login-form" action="/user-system/login.php" style="padding:0;margin:0;">

        <div class="login-field-container">

            <p><strong>Username / Email:</strong></p>
            <label><input type="text" name="login-user-name-or-email"/></label>
            <div class="clear"></div>

            <p><strong>Password:</strong></p>
            <label><input type="text" name="login-user-name-or-email"/></label>
            <div class="clear"></div>
        </div>


            <p><input type="submit" name="login" value="Login" title="Login" class="button" style="width: 100%;"/></p>
            <?php
            /** @noinspection PhpUndefinedVariableInspection */
            if ($gDebugMode) {
                ?>
                <p><input type="submit"
                          name="login-debug-mode"
                          value="Login With Debug Mode"
                          title="Login With Debug Mode"
                          class="button"
                          style="width: 100%;"/></p>
                <?php
            }
                ?>

        <div class="forgot-register">
            <p><a href="/user-system/forgot-password.php" title="Forgot your password?  Click here">Forgot Password?</a>
                <strong>/</strong>
                <a href="/user-system/forgot-username.php" title="Forgot your user name?  Click here">Forgot
                    Username?</a> <strong>/</strong>
                <a href="/user-system/register.php" title="Register as a 'Rock the Patch!' user">Register</a></p>
        </div>

        <div class="clear"></div>
    </form>
    <?php
} else {
    log_util::log(LOG_LEVEL_DEBUG, "User IS logged in");
    ?>
<!--    <h1 style="text-align:center;">Logged In</h1>-->
    <?php
    $currentUser = lib_get::currentUser();

    if ($currentUser->getUserName() != "" && $currentUser->getUserName() != NULL) {
        ?>
        <p><strong>Current User:</strong> <?php echo($currentUser->getUserName()); ?> </p>
        <?php
    } else if ($currentUser->getEmail() != "" && $currentUser->getEmail() != NULL) {
        ?>
        <p><strong>Current User:</strong> <?php echo($currentUser->getEmail()); ?> </p>
        <?php
    }
}
?>