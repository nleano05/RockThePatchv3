<?php
global $gDebugMode, $gLoginStatus;

$isAdmin = lib_check::userIsAdmin();

if ($gLoginStatus == STATUS_LOGGED_IN) {
    log_util::log(LOG_LEVEL_DEBUG, "user IS logged in");

    if ($isAdmin) {
        log_util::log(LOG_LEVEL_DEBUG, "user IS an admin");
        if ($gDebugMode) {
            log_util::log(LOG_LEVEL_DEBUG, "we ARE in debug mode");
            ?>
            <ul>
                <li>
                    <a href="/user-bonuses/special-news.php" title="Special News" id="special-news">Special News</a>
                </li>
                <li>
                    <a href="/user-bonuses/video-blog.php" title="Video Blog" id="video-blog">Video Blog</a>
                </li>
                <li>
                    <a href="/user-bonuses/downloads.php" title="Downloads" id="downloads">Downloads</a>
                </li>
                <li>
                    <a href="/user-bonuses/music.php" title="Music" id="music">Music</a>
                </li>
                <li>
                    <a href="/user-system/change-password.php" title="Change Password" id="change-password">Change Password</a>
                </li>
                <li>
                    <a href="/user-system/deactivate-account.php" title="Deactivate Account" id="deactivate-account">Deactivate Account</a>
                </li>
                <li>
                    <a href="/user-system/account-info.php" title="Account Info" id="account-info">Account Info</a>
                </li>
                <li>
                    <a href="/social/main.php" title="Social" id="social">Social</a>
                </li>
                <li>
                    <a href="/web-admin/main.php" title="Web Admin" id="web-admin">Web Admin</a>
                </li>
                <li>
                    <a href="/user-system/logout.php" title="Logout" id="logout">Logout</a>
                </li>
                <li>
                    <a href="/user-system/logout-debug-mode.php" title="Logout In Debug Mode" id="logout-debug-mode">Logout In Debug Mode</a>
                </li>
            </ul>
            <?php
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "we ARE NOT in debug mode");
            ?>
            <ul>
                <li>
                    <a href="/user-bonuses/special-news.php" title="Special News" id="special-news">Special News</a>
                </li>
                <li>
                    <a href="/user-bonuses/video-blog.php" title="Video Blog" id="video-blog">Video Blog</a>
                </li>
                <li>
                    <a href="/user-bonuses/downloads.php" title="Downloads" id="downloads">Downloads</a>
                </li>
                <li>
                    <a href="/user-bonuses/music.php" title="Music" id="music">Music</a>
                </li>
                <li>
                    <a href="/user-system/change-password.php" title="Change Password" id="change-password">Change Password</a>
                </li>
                <li>
                    <a href="/user-system/deactivate-account.php" title="Deactivate Account" id="deactivate-account">Deactivate Account</a>
                </li>
                <li>
                    <a href="/user-system/account-info.php" title="Account Info" id="account-info">Account Info</a>
                </li>
                <li>
                    <a href="/social/main.php" title="Social" id="social">Social</a>
                </li>
                <li>
                    <a href="/web-admin/main.php" title="Web Admin" id="web-admin">Web Admin</a>
                </li>
                <li>
                    <a href="/user-system/logout.php" title="Logout" id="logout">Logout</a>
                </li>
            </ul>
            <?php
        }
    } else {
        log_util::log(LOG_LEVEL_DEBUG, "user IS NOT an admin");
        if ($gDebugMode) {
            log_util::log(LOG_LEVEL_DEBUG, "we ARE in debug mode");
            ?>
            <ul>
                <li>
                    <a href="/user-bonuses/special-news.php" title="Special News" id="special-news">Special News</a>
                </li>
                <li>
                    <a href="/user-bonuses/video-blog.php" title="Video Blog" id="video-blog">Video Blog</a>
                </li>
                <li>
                    <a href="/user-bonuses/downloads.php" title="Downloads" id="downloads">Downloads</a>
                </li>
                <li>
                    <a href="/user-bonuses/music.php" title="Music" id="music">Music</a>
                </li>
                <li>
                    <a href="/user-system/change-password.php" title="Change Password" id="change-password">Change Password</a>
                </li>
                <li>
                    <a href="/user-system/deactivate-account.php" title="Deactivate Account" id="deactivate-account">Deactivate Account</a>
                </li>
                <li>
                    <a href="/user-system/account-info.php" title="Account Info" id="account-info">Account Info</a>
                </li>
                <li>
                    <a href="/user-system/request-admin-access.php" title="Request Admin Access" id="request-admin-access">Request Admin Access</a>
                </li>
                <li>
                    <a href="/user-system/logout.php" title="Logout" id="logout">Logout</a>
                </li>
                <li>
                    <a href="/user-system/logout-debug-mode.php" title="Logout In Debug Mode" id="logout-debug-mode">Logout In Debug Mode</a>
                </li>
            </ul>
            <?php
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "we ARE NOT in debug mode");
            ?>
            <ul>
                <li>
                    <a href="/user-bonuses/special-news.php" title="Special News" id="special-news">Special News</a>
                </li>
                <li>
                    <a href="/user-bonuses/video-blog.php" title="Video Blog" id="video-blog">Video Blog</a>
                </li>
                <li>
                    <a href="/user-bonuses/downloads.php" title="Downloads" id="downloads">Downloads</a>
                </li>
                <li>
                    <a href="/user-bonuses/music.php" title="Music" id="music">Music</a>
                </li>
                <li>
                    <a href="/user-system/change-password.php" title="Change Password" id="change-password">Change Password</a>
                </li>
                <li>
                    <a href="/user-system/deactivate-account.php" title="Deactivate Account" id="deactivate-account">Deactivate Account</a>
                </li>
                <li>
                    <a href="/user-system/account-info.php" title="Account Info" id="account-info">Account Info</a>
                </li>
                <li>
                    <a href="/user-system/request-admin-access.php" title="Request Admin Access" id="request-admin-access">Request Admin Access</a>
                </li>
                <li>
                    <a href="/user-system/logout.php" title="Logout" id="logout">Logout</a>
                </li>
            </ul>
            <?php
        }
    }
} else {
    log_util::log(LOG_LEVEL_DEBUG, "user IS NOT logged in");
    echo("<p style='height:25px;'></p>");
}
?>