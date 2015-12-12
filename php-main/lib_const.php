<?php
define("MASTER_ADMIN_EMAIL", "patches@rockthepatch.com");
define("MASTER_ADMIN_NAME", "Patches");

define("ROLE_ADMIN", 1);
define("ROLE_USER", 2);

define("STATUS_LOGGED_IN", 1);
define("STATUS_LOGGED_OUT", 2);

define("RSS_MAX_DESC_CHARS", 100);

define("GITHUB_ISSUES_BASE_URL", "https://api.github.com/repos/isuPatches/RockThePatchv3/issues");
define("GITHUB_MILESTONES_BASE_URL", "https://api.github.com/repos/isuPatches/RockThePatchv3/milestones");
define("OPEN", "open");
define("CLOSED", "closed");
define("TODO", "TODO");
define("BUG", "bug");
define("PATCHES", "isuPatches");
define("ERROR_REPORT_MILESTONE_NUMBER", 2);
define("FEATURE_REQUEST_MILESTONE_NUMBER", 3);

define("NOTICE_MUST_BE_ADMIN", "Only administrators will be able to view this page");
define("NOTICE_MUST_BE_LOGGED_IN", "Only logged in users will be able to view this page");
define("NOTICE_YOU_ARE_ALREADY_AN_ADMIN", "You are already an administrator");

define("LOCK_TYPE_NORMAL", 1);
define("LOCK_TYPE_ADMIN", 2);

define("COOKIE_DEBUG_MODE", "debug_mode");
define("COOKIE_LOGIN_STATUS_KEY", "login_status_key");
define("COOKIE_USER_ID", "user_id");
define("COOKIE_USERNAME_OR_EMAIL", "username_or_email");
define("COOKIE_SESSION_ID", "session_id");

define("SELECT_SECURITY_QUESTION", "-- SELECT SECURITY QUESTION --");
define("SELECT_ANNOYANCE_LEVEL_TO_DELETE", "-- SELECT ANNOYANCE LEVEL TO DELETE --");
define("SELECT_ANNOYANCE_LEVEL_TO_EDIT", "-- SELECT ANNOYANCE LEVEL TO EDIT --");

define("SELECT_EMAIL_DISTRO_TO_DELETE", "-- SELECT EMAIL DISTRO TO DELETE --");
define("SELECT_EMAIL_DISTRO_TO_EDIT", "-- SELECT EMAIL DISTRO TO EDIT --");
define("SELECT_EMAIL_MEMBER_TO_REMOVE", "-- SELECT EMAIL DISTRO MEMBER TO REMOVE --");

define("SELECT_EMAIL_DISTRO", "-- SELECT EMAIL DISTRO --");

define("SELECT_ERROR_REPORT_CATEGORY_TO_DELETE", "-- SELECT ERROR REPORT CATEGORY TO DELETE --");
define("SELECT_ERROR_REPORT_CATEGORY_TO_EDIT", "-- SELECT ERROR REPORT CATEGORY TO EDIT --");

define("LENGTH_TEMP_PASSWORD", 12);
define("LENGTH_SESSION_ID", 15);
define("LENGTH_ACCESS_TOKEN", 40);

define("FIELD_SUCCESS", "success");

define("TABLE_PAGE_LOG", "page_log");
define("TABLE_PAGE_STATISTICS", "page_statistics");
define("TABLE_LOGIN_LOG", "login_log");
define("TABLE_LOGIN_STATISTICS", "login_statistics");
define("TABLE_ERROR_LOG", "error_log");
define("TABLE_ERROR_STATISTICS", "error_statistics");

define("PAGE_PAGE_LOG", "page-log.php");
define("PAGE_ERROR_LOG", "error-log.php");
define("PAGE_LOGIN_LOG", "login-log.php");
define("PAGE_LOGIN_STATISTICS", "login-statistics.php");
define("PAGE_PAGE_FLOW", "page-flow.php");

define("NO_LOCKED_USERS", "-- There are currently no locked users --");
define("NO_UNLOCKED_USERS", "-- There are currently no unlocked users --");
define("NO_BLOCKED_IP_GROUPS", "-- There are currently no blocked IP groups --");
define("NO_NON_ADMIN_USERS", "-- There are currently no non-admin users. --");