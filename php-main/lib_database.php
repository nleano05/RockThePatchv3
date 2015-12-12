<?php

/**
 *  This class houses functions related to getting, setting, and updating data in the database
 */
class lib_database {

    /**
     *  This function connects to the database
     *
     * @param - None
     *
     * @return NULL|PDO
     * @throws - Nothing
     * @global - None
     * @notes
     *    - Used internally by lib_database class to create and return a PDO connection
     * @example - $pdo = lib_database::connect();
     * @author  - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    private static function connect() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        try {
            $pdo = new PDO(DB_HOST, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            $pdo = null;
            log_util::log(LOG_LEVEL_ERROR, "An error occurred while establishing PDO connection", $e);
        }

        log_util::logDivider();

        return $pdo;
    }

    public static function deleteAnnoyanceLevel($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM annoyance_levels WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    private static function deleteBlockedIPGroup($ip, $subnet) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM access_control WHERE ip = ? AND subnet = ?");
            $stmt->bindParam(1, $ip, PDO::PARAM_STR);
            $stmt->bindParam(2, $subnet, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function deleteEmailDistro($distroId) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM email_distros WHERE id = ?");
            $stmt->bindParam(1, $distroId, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function deleteEmailDistroMember($distroMemberId) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM email_distro_members WHERE id = ?");
            $stmt->bindParam(1, $distroMemberId, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function deleteEmailDistroMembers($distroId) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM email_distro_members WHERE distro = ?");
            $stmt->bindParam(1, $distroId, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function deleteErrorReportCategory($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM error_report_categories WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function deleteFeatureRequestCategory($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM feature_request_categories WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function deleteTables($tables) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            foreach($tables as $value) {
                log_util::log(LOG_LEVEL_DEBUG, "value: " . $value);

                $stmt = $pdo->prepare("DELETE FROM " . $value);
                $stmt->execute();
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function deleteUpdate($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM recent_updates WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function deleteUser($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function displayAdminUsers() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        echo("<p><select name='non-admin-users' style='width:90%;'>");
        if(!empty($pdo)) {
            log_util::logAsOption(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $role = ROLE_ADMIN;
            $stmt = $pdo->prepare("SELECT * FROM users WHERE role = ? ORDER BY lastName");
            $stmt->bindParam(1, $role, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::logAsOption(LOG_LEVEL_DEBUG, "row WAS NOT empty");
                echo("<option value='" . $row['id'] . "'> " . $row['lastName'] . ", " . $row['fname'] . " - " . $row['userName'] . "</option>");
                while($row = $stmt->fetch()) {
                    echo("<option value='" . $row['id'] . "'> " . $row['lastName'] . ", " . $row['fname'] . " - " . $row['userName'] . "</option>");
                }
            } else {
                log_util::logAsOption(LOG_LEVEL_WARNING, "row WAS empty");
                echo("<option>" . NO_NON_ADMIN_USERS . "</option>");
            }
        } else {
            log_util::logAsOption(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            echo("<option>" . NO_NON_ADMIN_USERS . "</option>");
        }
        echo("</select></p>");
        $pdo = NULL;

        log_util::logDivider();
    }

    private static function displayFilter($field, $labelText, $db) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT Count(DISTINCT $field) FROM $db");
            $stmt->execute();
            $row = $stmt->fetch();

            log_util::log(LOG_LEVEL_DEBUG, "row: ", $row);

            $count = $row[0];
            log_util::log(LOG_LEVEL_DEBUG, "count: ", $count);

            $stmt = $pdo->prepare("SELECT DISTINCT $field FROM $db ORDER BY $field ASC");
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        echo("<p style='float:left;padding:5px 18px'>" . $labelText . ":<br/><select name='" . $field . "' style='max-width:115px;display:inline-block;width:115px;'>");

        if(empty($_POST[$field]) || $_POST[$field] == 'all' || !isset($_POST[$field])) {
            echo("<option value='all' style='max-width:120px;' selected='selected'>-DISPLAY ALL-</option>");
        } else {
            echo("<option value='all' style='max-width:120px;'>-DISPLAY ALL-</option>");
        }

        for($x = 0; $x < $count; $x++) {
            $row = $stmt->fetch();

            log_util::logAsOption(LOG_LEVEL_DEBUG, "x: " . $x);
            $limit = 60;

            if($field == FIELD_SUCCESS) {
                log_util::logAsOption(LOG_LEVEL_DEBUG, "field WAS 'success', need to convert to true/false");
                log_util::logAsOption(LOG_LEVEL_DEBUG, "row[field]: " . $row[$field]);
                log_util::logAsOption(LOG_LEVEL_DEBUG, "strlen(row[field]): " . strlen($row[$field]));

                if($row[$field]) {
                    $fieldValue = "True";
                    $fieldDisplayValue = "True";
                } else {
                    $fieldValue = "False";
                    $fieldDisplayValue = "False";
                }
            } else {
                log_util::logAsOption(LOG_LEVEL_DEBUG, "field WAS NOT 'success', don't need to convert to true/false");

                $fieldValue = $row[$field];
                $fieldDisplayValue = $row[$field];
            }
            log_util::logAsOption(LOG_LEVEL_DEBUG, "fieldValue: " . $fieldValue);

            if(!empty($_POST[$field])) {
                log_util::logAsOption(LOG_LEVEL_DEBUG, "Post for the given field IS NOT empty");

                if($_POST[$field] == $fieldValue) {
                    log_util::logAsOption(LOG_LEVEL_DEBUG, "Post for the given field DID match the row");

                    if(strlen($fieldValue) > $limit) {
                        echo("<option value='" . $fieldValue . "' selected='selected'>" . substr($fieldDisplayValue, 0, $limit) . "...</option>");
                    } else {
                        echo("<option value='" . $fieldValue . "' selected='selected'>" . $fieldDisplayValue  . "</option>");
                    }
                } else {
                    log_util::logAsOption(LOG_LEVEL_DEBUG, "Post for the given field DID NOT match the row");

                    if(strlen($fieldValue) > $limit) {
                        echo("<option value='" . $fieldValue . "'>" . substr($fieldDisplayValue, 0, $limit)  . "...</option>");
                    } else {
                        echo("<option value='" . $fieldValue . "'>" . $fieldDisplayValue  . "</option>");
                    }
                }
            } else {
                log_util::logAsOption(LOG_LEVEL_DEBUG, "Post for the given field IS empty");


                if(strlen($fieldValue) > $limit) {
                    echo("<option value='" . $fieldValue . "'>" . substr($fieldDisplayValue, 0, $limit)  . "...</option>");
                } else {
                    echo("<option value='" . $fieldValue . "'>" . $fieldDisplayValue  . "</option>");
                }
            }
        }
        echo("</select></p>");

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function displayErrorStatistics() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $clientErrors = array(400 => "Bad Request",
            401 => "Unauthorized",
            402 => "Payment Required",
            403 => "Forbidden",
            404 => "Not Found",
            405 => "Method Not Allowed",
            406 => "Not Acceptable",
            407 => "Proxy Authentication Required",
            408 => "Request Timeout",
            409 => "Conflict",
            410 => "Gone",
            411 => "Length Required",
            412 => "Precondition Failed",
            413 => "Request Entity Too Large",
            414 => "Request-URI Too Long",
            415 => "Unsupported Media Type",
            416 => "Requested Range Not Satisfiable",
            417 => "Expectation Failed",
            422 => "Unprocessable Entity (WebDAV; RFC 4918)",
            423 => "Locked (WebDAV; RFC 4918)",
            424 => "Failed Dependency (WebDAV; RFC 4918) / Method Failure (WebDAV)",
            426 => "Upgrade Required (RFC 2817)",
            428 => "Precondition Required (RFC 6585)",
            429 => "Too Many Requests (RFC 6585)",
            431 => "Request Header Fields Too Large (RFC 6585)");

        $serverErrors = array(500 => "Internal Server Error",
            501 => "Not Implemented",
            502 => "Bad Gateway",
            503 => "Service Unavailable",
            504 => "Gateway Timeout",
            505 => "HTTP Version Not Supported",
            506 => "Variant Also Negotiates (RFC 2295)",
            507 => "Insufficient Storage (WebDAV; RFC 4918)",
            508 => "Loop Detected (WebDAV; RFC 5842)",
            510 => "Not Extended (RFC 2774)",
            511 => "Network Authentication Required (RFC 6585)");

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            echo("<h2>Client Errors</h2>");
            echo("<ul>");

            foreach($clientErrors as $key => $value) {
                log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
                log_util::log(LOG_LEVEL_DEBUG, "value: " . $value);

                // Queries the database for the number of occurrences for the client side error
                $stmt = $pdo->prepare("SELECT * FROM error_statistics WHERE errorCode = ?");
                $stmt->bindParam(1, $key, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();

                if(!empty($row)) {
                    log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");
                    $count = $row['count'];
                } else {
                    log_util::log(LOG_LEVEL_DEBUG, "row WAS empty");
                    $count = 0;
                }

                if($count > 0) {
                    echo("<li>" . $key . " " . $value . ": <span class='error'>" . $count . "</span></li>");
                } else {
                    echo("<li>" . $key . " " . $value . ": " . $count . "</li>");
                }
            }
            echo("</ul>");

            echo("<h2>Server Errors</h2>");
            echo("<ul>");

            foreach($serverErrors as $key => $value) {
                log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
                log_util::log(LOG_LEVEL_DEBUG, "value: " . $value);

                $stmt = $pdo->prepare("SELECT * FROM error_statistics WHERE errorCode = ?");
                $stmt->bindParam(1, $key, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();
                if(!empty($row)) {
                    log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");
                    $count = $row['count'];
                } else {
                    log_util::log(LOG_LEVEL_DEBUG, "row WAS empty");
                    $count = 0;
                }

                if($count > 0) {
                    echo("<li>" . $key . " " . $value . ": <font class='error'>" . $count . "</font></li>");
                } else {
                    echo("<li>" . $key . " " . $value . ": " . $count . "</li>");
                }
            }
            echo("</ul>");
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function displayPageStatistics() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM page_statistics ORDER BY page ASC");
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_ERROR, "row IS NOT empty");

                echo("<ul>");

                echo("<li style='word-break:break-all;'><strong>Page:</strong> " . $row['page'] . ", ");
                echo("<strong>Views:</strong> " . $row['views']. "</li>");

                while($row = $stmt->fetch()) {
                    log_util::log(LOG_LEVEL_ERROR, "row: ", $row);
                    echo("<li style='word-break:break-all;'><strong>Page:</strong> " . $row['page'] . ", ");
                    echo("<strong>Views:</strong> " . $row['views']. "</li>");
                }
                echo("</ul>");
            } else {
                log_util::log(LOG_LEVEL_ERROR, "row IS empty");
                echo("<p class='error'><em>Page Statistics table is empty</em></p>");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            echo("<p class='error'><em>Page Statistics table is empty</em></p>");
        }

        $pdo = NULL;


        log_util::logDivider();
    }

    public static function displayFilterForm($page, $action, $filters, $labels, $db) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        echo("<form name='" . $page . " Filters' method=post action='" . $action . "'>");
        echo("<h2>Filters for " . $page . "</h2>");
        for($x = 0; $x < count($filters);$x++) {
            log_util::log(LOG_LEVEL_DEBUG, "Filter at " . $x . ": " . $filters[$x] . "; Label at " . $x . ": " . $labels[$x]);

            lib_database::displayFilter($filters[$x], $labels[$x], $db);
        }
        echo("<div class='clear'></div>");
        echo("<p><input type='submit' class='button' name='Filter " . $page . "' value='Filter " . $page . "'/></p>");
        echo("</form>");
        echo("<div class='clear'></div>");

        log_util::logDivider();
    }

    public static function displayFilteredEntries($filters, $db, $page) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        echo("<h2>Filtered Entries</h2>");

        for($x = 0; $x < count($filters);$x++) {
            log_util::log(LOG_LEVEL_DEBUG, "Filter at " . $x . ": " . $filters[$x]);

            $filter = $filters[$x];
            $filterValues[$filter] = !empty($_POST[$filter]) && $_POST[$filter] != "all" && $_POST[$filter] != "empty" ? $_POST[$filter] : '*';
        }
        log_util::log(LOG_LEVEL_DEBUG, "filterValues: ", $filterValues);

        $displayAll = TRUE;
        foreach($filterValues as $key => $value) {
            log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
            log_util::log(LOG_LEVEL_DEBUG, "value: " . $value);

            if($value == "*") {
                log_util::log(LOG_LEVEL_DEBUG, "value: " . $value . ", DOES equal '*'");
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "value: " . $value . ", DOES NOT equal '*'");
                $displayAll = FALSE;
                break;
            }
        }
        log_util::log(LOG_LEVEL_DEBUG, "filterValues: ", $filterValues);
        log_util::log(LOG_LEVEL_DEBUG, "displayAll: ", $displayAll);


        if($displayAll) {
            log_util::log(LOG_LEVEL_DEBUG, "No filter was applied");
            $select = "SELECT * FROM " . $db;
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "There was a filter applied");

            $select = "SELECT * FROM " . $db . " WHERE ";

            $firstFilter = TRUE;
            foreach($filterValues as $key => $value) {
                log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
                log_util::log(LOG_LEVEL_DEBUG, "value: " . $value);

                if($value != '*') {
                    if($firstFilter) {
                        $select .= $key . " = ? ";
                        $firstFilter = FALSE;
                    } else {
                        $select .= "AND " . $key . " = ? ";
                    }
                }
            }
        }
        $countSelect = str_replace("*", "Count(*)", $select);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
            log_util::log(LOG_LEVEL_DEBUG, "select: " . $select);
            log_util::log(LOG_LEVEL_DEBUG, "countSelect: " . $countSelect);


            $stmt = $pdo->prepare($countSelect);

            $bindNumber = 1;
            foreach ($filterValues as $key => $value) {
                if ($value != '*') {
                    $stmt->bindParam($bindNumber, $filterValues[$key], PDO::PARAM_STR);
                    $bindNumber++;
                }
            }

            $stmt->execute();
            $row = $stmt->fetch();

            $count = $row[0];

            log_util::log(LOG_LEVEL_DEBUG, "row: ", $row);
            log_util::log(LOG_LEVEL_DEBUG, "count: " . $count);

            $stmt = $pdo->prepare($select);

            $bindNumber = 1;
            foreach ($filterValues as $key => $value) {
                if ($value != '*') {
                   if ($key == FIELD_SUCCESS) {
                       log_util::log(LOG_LEVEL_DEBUG, "key was success, need to convert the TRUE/FALSE value to 0/1");

                        if ($value == "True") {
                            $filterValues[$key] = TRUE;
                        } else {
                            $filterValues[$key] = FALSE;
                        }
                    }

                    $stmt->bindParam($bindNumber, $filterValues[$key], PDO::PARAM_STR);
                    $bindNumber++;
                }
            }

            $stmt->execute();

            if ($page != "page-flow.php") {
                echo("<p><strong>Entry Count:</strong> " . $count . "</p><hr/>");
            } else {
                echo("<hr/>");
            }

            if ($count != 0) {
                $pageFlow = array();
                $users = array();

                for ($x = 0; $x < $count; $x++) {
                    $row = $stmt->fetch();

                    log_util::log(LOG_LEVEL_DEBUG, "row: ", $row);

                    if ($page == PAGE_ERROR_LOG) {
                        log_util::log(LOG_LEVEL_DEBUG, "Matched error-log.php");

                        echo("<p style='word-break:break-all;'><strong>Error Code:</strong> " . $row['errorCode'] . ", ");
                        echo("<strong>Description:</strong> " . $row['description'] . ", ");
                        echo("<strong>Type:</strong> " . $row['type'] . "<br/>");
                        echo("<em>User:</em> " . $row['user'] . ", ");
                        echo("<em>Request URI:</em> " . $row['requestUri'] . ", ");
                        echo("<em>Referer:</em> " . $row['referer'] . ", ");
                        echo("<em>Time:</em> " . $row['time'] . "</p><hr/>");
                    } else if ($page == "page-log.php") {
                        log_util::log(LOG_LEVEL_DEBUG, "Matched page-log.php");

                        echo("<p style='word-break:break-all;'><strong>Page:</strong> " . $row['page'] . "<br/>");
                        echo("<em>User:</em> " . $row['user'] . "<br/>");
                        echo("<em>Referer:</em> " . $row['referer'] . "<br/>");
                        echo("<em>Full Agent:</em> " . $row['fullAgent'] . "<br/>");
                        echo("<em>Agent:</em> " . $row['agent'] . "<br/>");
                        echo("<em>Agent Version:</em> " . $row['agentVersion'] . "<br/>");
                        echo("<em>OS:</em> " . $row['os'] . "<br/>");
                        echo("<em>OS Version:</em> " . $row['osVersion'] . "<br/>");
                        echo("<em>Remote Address:</em> " . $row['remoteAddress'] . "<br/>");
                        echo("<em>ISP:</em> " . $row['isp'] . "<br/>");
                        echo("<em>Country:</em> " . $row['country'] . "<br/>");
                        echo("<em>State:</em> " . $row['state'] . "<br/>");
                        echo("<em>City:</em> " . $row['city'] . "<br/>");
                        echo("<em>Time:</em> " . $row['time'] . "<br/>");
                        echo("<em>Session Id:</em> " . $row['sessionId'] . "</p><hr/>");
                    } else if ($page == PAGE_LOGIN_LOG) {
                        log_util::log(LOG_LEVEL_DEBUG, "Matched login-log.php");

                        if ($row['success']) {
                            $succeeded = "Yes";

                            echo("<p><strong>Entry:</strong> <em>User:</em> " . $row['user'] . ", ");
                            echo("<em>Succeeded:</em> " . $succeeded . ", ");
                            echo("<em>Time:</em> " . $row['loginTime'] . "</p>");
                        } else {
                            $succeeded = "No";

                            echo("<p class='error'><strong>Entry:</strong> <em>User:</em> " . $row['user'] . ", ");
                            echo("<em>Succeeded:</em> " . $succeeded . ", ");
                            echo("<em>Time:</em> " . $row['loginTime'] . "</p>");
                        }
                    } else if ($page == PAGE_LOGIN_STATISTICS) {
                        log_util::log(LOG_LEVEL_DEBUG, "Matched login-statistics.php");

                        echo("<p><strong>User:</strong> " . $row['user'] . "<br/>");
                        echo("<em>Total Attempts:</em> " . $row['attempts'] . "<br/>");
                        echo("<em>Failed Login Attempts:</em> " . $row['failed'] . "<br/>");
                        echo("<em>Succeeded Login Attempts:</em> " . $row['succeeded'] . "</p><hr/>");
                    } else if ($page == PAGE_PAGE_FLOW) {
                        log_util::log(LOG_LEVEL_DEBUG, "Matched page-flow.php");

                        if (!isset($pageFlow[$row['sessionId']])) {
                            $pageFlow[$row['sessionId']] = "";
                        }

                        if (!isset($users[$row['sessionId']])) {
                            $users[$row['sessionId']] = "";
                        }

                        $pageFlow[$row['sessionId']] .= $row['page'] . " => ";
                        $users[$row['sessionId']] = $row['user'];
                    } else {
                        log_util::log(LOG_LEVEL_WARNING, "DID NOT match a listed database");
                    }
                }

                if ($page == PAGE_PAGE_FLOW) {
                    log_util::log(LOG_LEVEL_DEBUG, "Matched page-flow.php");
                    log_util::log(LOG_LEVEL_DEBUG, "pageFlow: ", $pageFlow);
                    log_util::log(LOG_LEVEL_DEBUG, "users: ", $users);

                    foreach ($pageFlow as $key => $value) {
                        log_util::log(LOG_LEVEL_DEBUG, "key: " . $key);
                        log_util::log(LOG_LEVEL_DEBUG, "value: ". $value);

                        echo("<p><strong>Session ID: <em>" . $key . "</em><br/>");
                        echo("User: <em>" . $users[$key] . "</em></strong></p>");
                        echo("<p style='word-break:break-all;'>" . $pageFlow[$key] . " DROP OFF</p><hr/>");
                    }
                }
            } else {
                echo("<p class='error'><em>No log entries matched the current filter or log is empty...</em></p>");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function displayNonAdminUsers() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        echo("<p><select name='non-admin-users' style='width:90%;'>");
        if(!empty($pdo)) {
            log_util::logAsOption(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $role = ROLE_USER;
            $stmt = $pdo->prepare("SELECT * FROM users WHERE role = ? ORDER BY lastName");
            $stmt->bindParam(1, $role, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::logAsOption(LOG_LEVEL_DEBUG, "row WAS NOT empty");
                echo("<option value='" . $row['id'] . "'> " . $row['lastName'] . ", " . $row['fname'] . " - " . $row['userName'] . "</option>");
                while($row = $stmt->fetch()) {
                    echo("<option value='" . $row['id'] . "'> " . $row['lastName'] . ", " . $row['fname'] . " - " . $row['userName'] . "</option>");
                }
            } else {
                log_util::logAsOption(LOG_LEVEL_WARNING, "row WAS empty");
                echo("<option>" . NO_NON_ADMIN_USERS . "</option>");
            }
        } else {
            log_util::logAsOption(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            echo("<option>" . NO_NON_ADMIN_USERS . "</option>");
        }
        echo("</select></p>");
        $pdo = NULL;

        log_util::logDivider();
    }

    public static function displayUserDemographic() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $agentSet = array();
        $osSet = array();
        $ispSet = array();
        $count = array();

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM page_log");
            $stmt->execute();
            $row = $stmt->fetch();

            log_util::log(LOG_LEVEL_DEBUG, "row: ", $row);

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row IS NOT empty");

                $tempAgent = $row['agent'] . " " . $row['agentVersion'];

                $count[$tempAgent] = 1;
                if(!in_array($tempAgent, $agentSet)) {
                    array_push($agentSet, $tempAgent);
                }

                $tempOS = $row['os'] . " " . $row['osVersion'];
                $count[$tempOS] = 1;
                if(!in_array($tempOS, $osSet)) {
                    array_push($osSet, $tempOS);
                }

                $tempISP = $row['isp'];
                $count[$tempISP] = 1;
                if(!in_array($tempISP, $ispSet)) {
                    array_push($ispSet, $tempISP);
                }
                log_util::log(LOG_LEVEL_DEBUG, "count: ", $count);

                while($row = $stmt->fetch()) {

                    $tempAgent = $row['agent'] . " " . $row['agentVersion'];

                    if(!isset($count[$tempAgent])) {
                        $count[$tempAgent] = 1;
                    } else {
                        $count[$tempAgent] = $count[$tempAgent] + 1;
                    }

                    if(!in_array($tempAgent, $agentSet)) {
                        array_push($agentSet, $tempAgent);
                    }

                    $tempOS = $row['os'] . " " . $row['osVersion'];
                    if(!isset($count[$tempOS])) {
                        $count[$tempOS] = 1;
                    } else {
                        $count[$tempOS] = $count[$tempOS] + 1;
                    }

                    if(!in_array($tempOS, $osSet)) {
                        array_push($osSet, $tempOS);
                    }

                    $tempISP = $row['isp'];
                    if(!isset($count[$tempISP])) {
                        $count[$tempISP] = 1;
                    } else {
                        $count[$tempISP] = $count[$tempISP] + 1;
                    }

                    if(!in_array($tempISP, $ispSet)) {
                        array_push($ispSet, $tempISP);
                    }

                    log_util::log(LOG_LEVEL_DEBUG, "row: ", $row);
                    log_util::log(LOG_LEVEL_DEBUG, "count: ", $count);
                }

                log_util::log(LOG_LEVEL_DEBUG, "agentSet: ", $agentSet);
                log_util::log(LOG_LEVEL_DEBUG, "osSet: ", $osSet);
                log_util::log(LOG_LEVEL_DEBUG, "ispSet: ", $ispSet);
                log_util::log(LOG_LEVEL_DEBUG, "count: ", $count);

                echo("<h2>Agents</h2>");
                echo("<ul>");
                sort($agentSet);
                foreach($agentSet as $value) {
                    echo("<li>" . $value . ", <em>Count: " . $count[$value] . "</em></li>");
                }
                echo("</ul>");

                echo("<h2>Operating Systems</h2>");
                echo("<ul>");
                sort($osSet);
                foreach($osSet as $value) {
                    echo("<li>" . $value . ", <em>Count: " . $count[$value] . "</em></li>");
                }
                echo("</ul>");

                echo("<h2>ISP's</h2>");
                echo("<ul>");
                sort($ispSet);
                foreach($ispSet as $value) {
                    echo("<li>" . $value . ", <em>Count: " . $count[$value] . "</em></li>");
                }
                echo("</ul>");
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row IS empty");
                echo("<p class='error'><em>Page Log is empty...</em></p>");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            echo("<p class='error'><em>Page Log is empty...</em></p>");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function displayUsersAccountLockAdministration($locked) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if($locked) {
            echo("<h2>Locked Users</h2>");
            echo("<form method='post' action='unlock-user.php' name='Unlock User'>");
            echo("<p><select name='locked-users' style='width:90%;'>");
        } else {
            echo("<h2>Unlocked Users</h2>");
            echo("<form method='post' action='lock-user.php' name='Lock User'>");
            echo("<p><select name='unlocked-users' style='width:90%;'>");
        }

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $locked = (int) $locked;

            $stmt = $pdo->prepare("SELECT * FROM users WHERE locked = ? ORDER BY lastName");
            $stmt->bindParam(1, $locked, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row IS NOT empty");

                echo("<option value=\"" . $row['id'] . "\" > " . $row['lastName'] . ", " . $row['firstName'] . " - " . $row['userName'] . "</option>");

                while($row = $stmt->fetch()) {
                    echo("<option value=\"" . $row['id'] . "\" >" . $row['lastName'] . ", " . $row['firstName'] . " - " . $row['userName'] . "</option>");
                }
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "row IS empty");

                if($locked) {
                    echo("<option>" . NO_LOCKED_USERS ."</option>");
                } else {
                    echo("<option>" . NO_UNLOCKED_USERS . "</option>");
                }
            }
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS empty");

            if($locked) {
                echo("<option>" . NO_LOCKED_USERS ."</option>");
            } else {
                echo("<option>" . NO_UNLOCKED_USERS . "</option>");
            }
        }

        echo("</select></p>");

        if($locked) {
            echo("<p><input type='submit' name='unlock-user.php' value='Unlock User' class='button' /></p>");
        } else {
            echo("<p><input type='submit' name='lock-user.php' value='Lock User' class='button' /></p>");
        }
        echo("</form>");

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function getAccessToken($token, $clientSecret) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        $accessToken = NULL;

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if(isset($token)){
                log_util::log(LOG_LEVEL_DEBUG, "Getting token by token");

                $stmt = $pdo->prepare("SELECT * FROM oauth WHERE accessToken = ?");
                $stmt->bindParam(1, $token, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch();
            } else if(isset($clientSecret)){
                log_util::log(LOG_LEVEL_DEBUG, "Getting token by client secret");

                $stmt = $pdo->prepare("SELECT * FROM oauth WHERE clientSecret = ?");
                $stmt->bindParam(1, $clientSecret, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch();
            }

            if(!empty($row)){
                log_util::log(LOG_LEVEL_WARNING, "row WAS NOT empty");

                $accessToken = new AccessToken();

                $accessToken->setId((int)$row['id']);
                $accessToken->setClientId($row['clientId']);
                $accessToken->setClientSecret($row['clientSecret']);
                $accessToken->setAccessToken($row['accessToken']);
                $accessToken->setTimeStamp($row['timeStamp']);
                $accessToken->setScope($row['scope']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "accessToken: ", $accessToken);
        log_util::logDivider();

        if(isset($accessToken)) {
            return $accessToken;
        }
    }

    public static function getAllEmails($display) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $mailingList = "";

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM users");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                log_util::log(LOG_LEVEL_DEBUG, "row['email']: " . $row['email']);
                $mailingList .= $row['email'] . ", ";
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $mailingList = trim($mailingList, ", ");

        if($display) {
            log_util::log(LOG_LEVEL_DEBUG, "display is true");
            echo("<p>" . $mailingList . "</p>");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "display is false");
        }

        $pdo = NULL;

        log_util::logDivider();

        return $mailingList;
    }

    public static function getAnnoyanceLevelById($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $annoyanceLevel = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection IS NOT empty");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt = $pdo->prepare("SELECT * FROM annoyance_levels WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!empty($row )) {
                $annoyanceLevel = new AnnoyanceLevel();
                $annoyanceLevel->setId((int)$row['id']);
                $annoyanceLevel->setName($row['name']);
                $annoyanceLevel->setLevel((int)$row['level']);
                $annoyanceLevel->setIsDefault((bool)$row['isDefault']);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "annoyanceLevel: ", $annoyanceLevel);
        log_util::logDivider();

        return $annoyanceLevel;
    }

    /**
     *  This function gets all of the annoyance levels
     *
     * @param    - None
     *
     * @return array of AnnoyanceLevel objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example  - $annoyanceLevels = lib_database::getAnnoyanceLevels();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function getAnnoyanceLevels() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $annoyanceLevels = [];

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection IS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM annoyance_levels ORDER BY level ASC");
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $annoyanceLevel = new AnnoyanceLevel();
                $annoyanceLevel->setId((int)$row['id']);
                $annoyanceLevel->setName($row['name']);
                $annoyanceLevel->setLevel((int)$row['level']);
                $annoyanceLevel->setIsDefault((bool)$row['isDefault']);

                array_push($annoyanceLevels, $annoyanceLevel);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "annoyanceLevels: ", $annoyanceLevels);
        log_util::logDivider();

        return $annoyanceLevels;
    }

    public static function getBlockedIPGroups() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $blockedIPGroups = array();

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM access_control");
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");
                $blockedIPGroup = new BlockedIPGroup();
                $blockedIPGroup->setId((int) $row['ip']);
                $blockedIPGroup->setIP($row['ip']);
                $blockedIPGroup->setSubnet($row['subnet']);

                array_push($blockedIPGroups, $blockedIPGroup);

                while($row = $stmt->fetch()){
                    $blockedIPGroup = new BlockedIPGroup();
                    $blockedIPGroup->setId((int) $row['ip']);
                    $blockedIPGroup->setIP($row['ip']);
                    $blockedIPGroup->setSubnet($row['subnet']);

                    array_push($blockedIPGroups, $blockedIPGroup);
                }
            } else {
                array_push($blockedIPGroups, NO_BLOCKED_IP_GROUPS);
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }
        } else {
            array_push($blockedIPGroups, NO_BLOCKED_IP_GROUPS);
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "blockedIPGroups: ", $blockedIPGroups);
        log_util::logDivider();

        return $blockedIPGroups;
    }

    /**
     *  This gets all of the email distros
     *
     * @param None
     *
     * @return array of EmailDistro objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $emailDistros = lib_database::getEmailDistros();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function getEmailDistros() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $emailDistros = [];

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM email_distros ORDER BY name ASC");
            $stmt->execute();
            $row = $stmt->fetch();

            if (!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty for distro.");

                $emailDistros = [];
                $emailDistro = new EmailDistro();
                $emailDistro->setId($row['id']);
                $emailDistro->setName($row['name']);
                array_push($emailDistros, $emailDistro);

                while ($row = $stmt->fetch()) {
                    $emailDistro = new EmailDistro();
                    $emailDistro->setId($row['id']);
                    $emailDistro->setName($row['name']);
                    array_push($emailDistros, $emailDistro);
                }

            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty for distro");
            }

            foreach($emailDistros as $emailDistro) {
                $stmt = $pdo->prepare("SELECT * FROM email_distro_members WHERE distro = ?");
                $distroId = $emailDistro->getId();
                $stmt->bindParam(1, $distroId, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();

                if (!empty($row)) {
                    log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty for distro members.");
                    $emailDistroMembers = [];
                    $emailDistroMember = new EmailDistroMember();
                    $emailDistroMember->setId($row['id']);
                    $emailDistroMember->setDistro($row['distro']);
                    $emailDistroMember->setEmail($row['email']);

                    array_push($emailDistroMembers, $emailDistroMember);

                    while ($row = $stmt->fetch()) {
                        $emailDistroMember = new EmailDistroMember();
                        $emailDistroMember->setId($row['id']);
                        $emailDistroMember->setDistro($row['distro']);
                        $emailDistroMember->setEmail($row['email']);

                        array_push($emailDistroMembers, $emailDistroMember);
                    }
                } else {
                    log_util::log(LOG_LEVEL_WARNING, "row WAS empty for distro members");
                }
            }

        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "emailDistros: ", $emailDistros);
        log_util::logDivider();

        return $emailDistros;
    }

    public static function getEmailDistroById($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM email_distros LEFT JOIN email_distro_members ON email_distros.id = email_distro_members.distro WHERE email_distros.id = ? ORDER BY name ASC");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty. row: ", $row);

                $emailDistroMembers = [];
                $emailDistro = new EmailDistro();

                $emailDistro->setId($row['distro']);
                $emailDistro->setName($row['name']);

                $emailDistroMember = new EmailDistroMember();
                $emailDistroMember->setId($row['id']);
                $emailDistroMember->setEmail($row['email']);
                array_push($emailDistroMembers, $emailDistroMember);
                $emailDistro->setDistroMembers($emailDistroMembers);

                log_util::log(LOG_LEVEL_DEBUG, "emailDistroMembers: ", $emailDistroMembers);

                while ($row = $stmt->fetch()) {
                    $emailDistroMember = new EmailDistroMember();
                    $emailDistroMember->setId($row['id']);
                    $emailDistroMember->setEmail($row['email']);
                    array_push($emailDistroMembers, $emailDistroMember);
                    $emailDistro->setDistroMembers($emailDistroMembers);
                    log_util::log(LOG_LEVEL_DEBUG, "emailDistroMembers: ", $emailDistroMembers);
                }
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }

        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "emailDistro: ", $emailDistro);
        log_util::logDivider();

        return $emailDistro;
    }

    public static function getErrorReportCategoryById($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $errorReportCategory = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM error_report_categories WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!empty($row)) {
                $errorReportCategory = new ErrorReportCategory();
                $errorReportCategory->setId((int)$row['id']);
                $errorReportCategory->setName($row['name']);
                $errorReportCategory->setDistro((int)$row['distro']);
                $errorReportCategory->setIsDefault((bool)$row['isDefault']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }

        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "errorReportCategory: ", $errorReportCategory);
        log_util::logDivider();

        return $errorReportCategory;
    }

    /**
     *  This
     *
     * @param string $identifier The identifier of the encryption object to get from the database
     * @param bool|null $noDebugModeOutput Whether or not to display output for debug mode if enabled
     *
     * @return EncryptionData|null
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - To get encryption data with output for debug mode if enabled: $encryptionData = lib_database::getEncryptionData($identifier);
     * @example - To get encryption data with no output even if debug mode is enabled: $encryptionData = lib_database::getEncryptionData($identifier, TRUE);
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/10/2015
     */
    public static function getEncryptionData($identifier, $noDebugModeOutput = FALSE){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $encryptionData = NULL;

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
            }

            $stmt = $pdo->prepare("SELECT * FROM encryption WHERE identifier = ?");
            $stmt->bindParam(1, $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");

                $encryptionData = new EncryptionData();
                $encryptionData->setId((int)$row['id']);
                $encryptionData->setIdentifier($row['identifier']);
                $encryptionData->setCipher($row['cipher']);
                $encryptionData->setKey($row['encryption_key']);
                $encryptionData->setIv($row['iv']);
                $encryptionData->setTime($row['encryption_time']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }

        } else {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "encryptionData: ", $encryptionData);
        log_util::logDivider();

        return $encryptionData;
    }

    /**
     *  This function gets all of the error report categories
     *
     * @param None
     *
     * @return array of ErrorReportCategory objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $errorReportCategories = lib_database::getErrorReportCategories();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function getErrorReportCategories($name = NULL) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        $errorReportCategories = [];

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if($name != NULL) {
                $stmt = $pdo->prepare("SELECT * FROM error_report_categories WHERE name = ? ORDER BY name ASC");
                $stmt->bindParam(1, $name, PDO::PARAM_STR);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM error_report_categories ORDER BY name ASC");
            }
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $errorReportCategory = new ErrorReportCategory();
                $errorReportCategory->setId((int)$row['id']);
                $errorReportCategory->setName($row['name']);
                $errorReportCategory->setDistro((int)$row['distro']);
                $errorReportCategory->setIsDefault((bool)$row['isDefault']);

                array_push($errorReportCategories, $errorReportCategory);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "errorReportCategories", $errorReportCategories);
        log_util::logDivider();

        return $errorReportCategories;
    }

    public static function getFeatureRequestCategoryById($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $featureRequestCategory = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM feature_request_categories WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!empty($row)) {
                $featureRequestCategory = new FeatureRequestCategory();
                $featureRequestCategory->setId((int)$row['id']);
                $featureRequestCategory->setName($row['name']);
                $featureRequestCategory->setDistro((int)$row['distro']);
                $featureRequestCategory->setIsDefault((bool)$row['isDefault']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }

        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "errorReportCategory: ", $featureRequestCategory);
        log_util::logDivider();

        return $featureRequestCategory;
    }

    /**
     *  This function gets all of the feature request categories
     *
     * @param None
     *
     * @return array of FeatureRequestCategory objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $featureRequestCategories = lib_database::getFeatureRequestCategories();
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/04/2015
     */
    public static function getFeatureRequestCategories($name = NULL) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $featureRequestCategories = [];

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

			if($name != NULL) {
                $stmt = $pdo->prepare("SELECT * FROM feature_request_categories WHERE name = ? ORDER BY name ASC");
                $stmt->bindParam(1, $name, PDO::PARAM_STR);
            } else {
                $stmt = $pdo->prepare("SELECT * FROM feature_request_categories ORDER BY name ASC");
            }
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $featureRequestCategory = new FeatureRequestCategory();
                $featureRequestCategory->setId((int)$row['id']);
                $featureRequestCategory->setName($row['name']);
                $featureRequestCategory->setDistro((int)$row['distro']);
                $featureRequestCategory->setIsDefault((bool)$row['isDefault']);

                array_push($featureRequestCategories, $featureRequestCategory);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "featureRequestCategories: ", $featureRequestCategories);
        log_util::logDivider();

        return $featureRequestCategories;
    }

    public static function getMailingList($display, $testMode = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $mailingList = "";

        if($testMode) {
            $mailingList = "isupatches@aim.com";
            //$mailingList = "patches@rockthepatch.com, isuPatches@yahoo.com, isuPatches@hotmail.com, isuPatches@gmail.com, isupatches@aim.com";
        } else {
            $pdo = lib_database::connect();

            $emailBlast = 1;

            if(!empty($pdo)) {
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

                $stmt = $pdo->prepare("SELECT * FROM users WHERE emailBlasts = ?");
                $stmt->bindParam(1, $emailBlast, PDO::PARAM_INT);
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    log_util::log(LOG_LEVEL_DEBUG, "row['email']: " . $row['email']);
                    $mailingList .= $row['email'] . ", ";
                }
            } else {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $mailingList = trim($mailingList, ", ");

        if($display) {
            log_util::log(LOG_LEVEL_DEBUG, "display is true");
            echo("<p>" . $mailingList . "</p>");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "display is false");
        }

        $pdo = NULL;

        log_util::logDivider();

        return $mailingList;
    }

    /**
     *  This function gets the most recent update from the database
     *
     * @param None
     *
     * @return Update|null
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $update = lib_database::getMostRecentUpdate();
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/22/2015
     */
    public static function getMostRecentUpdate() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $update = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates ORDER BY date DESC");
            $stmt->execute();
            $row = $stmt->fetch();

            /** @noinspection PhpAssignmentInConditionInspection */
            if (!empty($row )) {
                $update = new Update();
                $update->setId((int)$row['id']);
                $update->setTitle($row['title']);
                $update->setText($row['text']);
                $update->setDate($row['date']);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "update: ", $update);
        log_util::logDivider();

        return $update;
    }

    public static function getSecurityQuestionById($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM security_questions WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            /** @noinspection PhpAssignmentInConditionInspection */
            if (!empty($row )) {
                $securityQuestion = new SecurityQuestion();
                $securityQuestion->setId((int)$row['id']);
                $securityQuestion->setQuestion($row['question']);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "securityQuestion: ", $securityQuestion);
        log_util::logDivider();

        return $securityQuestion;
    }

    public static function getSecurityQuestions() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $securityQuestions = array();

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
            $stmt = $pdo->prepare("SELECT * FROM security_questions");
            $stmt->execute();

            while($row = $stmt->fetch()) {
                $securityQuestion = new SecurityQuestion();
                $securityQuestion->setId((int)$row['id']);
                $securityQuestion->setQuestion($row['question']);

                array_push($securityQuestions, $securityQuestion);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "securityQuestions: ", $securityQuestions);
        log_util::logDivider();

        return $securityQuestions;
    }

    public static function getTextList($display, $testMode = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $textOut = $textOutBuild = "";

        $textOutEmail = array();

        if($testMode) {
            $textOut = "317-432-5230";
            $textOutEmail["317-432-5230"] = "3174325230@txt.att.net";
        } else {
            $textBlast = 1;

            $pdo = lib_database::connect();

            if(!empty($pdo)) {
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

                $stmt = $pdo->prepare("SELECT * FROM users WHERE textBlasts = ?");
                $stmt->bindParam(1, $textBlast, PDO::PARAM_INT);
                $stmt->execute();

                while($row = $stmt->fetch()) {
                    log_util::log(LOG_LEVEL_DEBUG, "row['cell']: " . $row['cell']);

                    if(isset($row['cell'])) {
                        $phoneNumber = $row['cell'];
                    } else {
                        $phoneNumber = "";
                    }

                    $textOut .= $phoneNumber . ", ";

                    // *NOTE* $textOutBuild is a var that will contain a string of the user's phone number
                    // with the all of the supported carriers append that will be used later on for email

                    // Main Cell Phone Carriers
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@vtext.com, "; // For Verizon users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@txt.att.net, "; // For AT&T users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@messaging.sprintpcs.com, "; // For Sprint users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@tmomail.net, "; // For T-Mobile users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@messaging.nextel.com, "; // For Nextel users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@vmobl.com, "; // For  Virgin Mobile users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@myboostmobile.com, "; // For Boost Mobile users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@message.alltel.com, "; // For Alltel users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@sms.mycricket.com, "; // For Cricket Wireless users

                    // Other U.S. and Canada Carriers
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@csouth1.com, "; // For Cellular South users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@gocbw.com, "; // For Cincinnati Bell users
                    $textOutBuild .= str_replace("-", "", $phoneNumber) . "@email.uscc.net, "; // For U.S. Cellular users

                    // $textOutEmail is an associative array where the key is the user's phone number
                    // and the value is a string of the phone number with all of the supported carriers
                    // appended on so that it an be used later on for the email
                    $textOutEmail[$phoneNumber] = trim($textOutBuild, ", ");

                    // This needs to be reset for the next user's phone number
                    $textOutBuild = "";
                }
            } else {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $textOut = trim($textOut, ", ");

        if($display) {
            log_util::log(LOG_LEVEL_DEBUG, "display is true");
            echo("<p>" . $textOut . "</p>");
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "display is false");
        }

        $pdo = NULL;

        log_util::logDivider();

        return $textOutEmail;
    }

    /**
     *  This function gets an update based on unique id from the database
     *
     * @param None
     *
     * @return Update|null
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $update = lib_database::getUpdateById($id);
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/23/2015
     */
    public static function getUpdateById($id) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $update = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            /** @noinspection PhpAssignmentInConditionInspection */
            if (!empty($row )) {
                $update = new Update();
                $update->setId((int)$row['id']);
                $update->setTitle($row['title']);
                $update->setText($row['text']);
                $update->setDate($row['date']);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "update: ", $update);
        log_util::logDivider();

        return $update;
    }

    /**
     *  This function returns all of the updates from the database
     *
     * @param None
     *
     * @return array of Update objects
     * @throws - Nothing
     * @global - None
     * @notes  - None
     * @example - $updates = lib_database::getUpdates();
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/02/2015
     */
    public static function getUpdates() {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $updates = [];

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates ORDER BY date DESC");
            $stmt->execute();

            /** @noinspection PhpAssignmentInConditionInspection */
            while ($row = $stmt->fetch()) {
                $update = new Update();
                $update->setId((int)$row['id']);
                $update->setTitle($row['title']);
                $update->setText($row['text']);
                $update->setDate($row['date']);

                array_push($updates, $update);
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "updates: ", $updates);
        log_util::logDivider();

        return $updates;
    }


    /**
     *  This function gets a specific user based off unique fields
     *
     * @param $id (optional) The id of the user to search for
     * @param $email (optional) The email of the user to search for
     * @param $userName (optional) The user name of the user to search for
     * @param $password (optional)
     * @param $temp (optional)
     * @param $temp (optional)
     *
     * @return User|NULL
     * @throws - Nothing
     * @global - None
     * @notes  - None
     *
     * @example - To get user by id: $user = lib_database::getUser(1);
     * @example - To get user by email: $user = lib_database::getUser(NULL, "email@domain.com");
     * @example - To get user by userName: $user = lib_database::getUser(NULL, NULL, "userName");
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/03/2015
     */
    public static function getUser($id = NULL, $email = NULL, $userName = NULL, $password = NULL, $temp = FALSE, $noDebugModeOutput = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if(!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $user = NULL;

        $pdo = lib_database::connect();

        if (!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
			
            $db = $temp ? "users_temp" : "users";
			
            $stmt = $pdo->prepare("SELECT * FROM " . $db . " WHERE id = ? OR email = ? OR userName = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->bindParam(2, $email, PDO::PARAM_INT);
            $stmt->bindParam(3, $userName, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if (!empty($row)) {
                if(!$noDebugModeOutput) {
                    log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");
                }

                if($password != NULL) {
                    $id = $row['id'];

                    $decryptedPassword = lib::decrypt($id . "_pass", $noDebugModeOutput);
                    if(!$noDebugModeOutput) {
                        log_util::log(LOG_LEVEL_DEBUG, "id: " . $id);
                        log_util::log(LOG_LEVEL_DEBUG, "decryptedPassword: " . $decryptedPassword);
                    }

                    if(($decryptedPassword === $password) || ($decryptedPassword === $password)){
                        if(!$noDebugModeOutput) {
                            if(!$noDebugModeOutput) {
                                log_util::log(LOG_LEVEL_DEBUG, "Password DID match one of the decrypted passwords");
                            }
                        }

                        $user = new User();
                        $user->setId((int)$row['id']);
                        $user->setFirstName($row['firstName']);
                        $user->setLastName($row['lastName']);
                        $user->setUserName($row['userName']);
                        $user->setEmail($row['email']);
                        $user->setPassword($row['password']);
                        $user->setSecurityQuestion((int)$row['securityQuestion']);
                        $user->setSecurityQuestionAnswer($row['securityQuestionAnswer']);
                        $user->setEmailBlasts((bool)$row['emailBlasts']);
                        $user->setTextBlasts((bool)$row['textBlasts']);
						$user->setCell($row['cell']);
                        $user->setRole((int)$row['role']);
                        $user->setLocked((bool)$row['locked']);
                        $user->setLockedByAdmin((bool)$row['lockedByAdmin']);
                        $user->setTimeLocked($row['timeLocked']);
                        $user->setConsecutiveFailedLoginAttempts((int)$row['consecutiveFailedLoginAttempts']);
                        $user->setLastLoginAttemptTime($row['lastLoginAttemptTime']);
                    } else {
                        if(!$noDebugModeOutput) {
                            if(!$noDebugModeOutput) {
                                log_util::log(LOG_LEVEL_DEBUG, "Password DID NOT match one of the decrypted passwords");
                            }
                        }
                    }
                } else {
                    $user = new User();
                    $user->setId((int)$row['id']);
                    $user->setFirstName($row['firstName']);
                    $user->setLastName($row['lastName']);
                    $user->setUserName($row['userName']);
                    $user->setEmail($row['email']);
                    $user->setPassword($row['password']);
                    $user->setSecurityQuestion((int)$row['securityQuestion']);
                    $user->setSecurityQuestionAnswer($row['securityQuestionAnswer']);
                    $user->setEmailBlasts((bool)$row['emailBlasts']);
                    $user->setTextBlasts((bool)$row['textBlasts']);
					$user->setCell($row['cell']);
                    $user->setRole((int)$row['role']);
                    $user->setLocked((bool)$row['locked']);
                    $user->setLockedByAdmin((bool)$row['lockedByAdmin']);
                    $user->setTimeLocked($row['timeLocked']);
                    $user->setConsecutiveFailedLoginAttempts((int)$row['consecutiveFailedLoginAttempts']);
                    $user->setLastLoginAttemptTime($row['lastLoginAttemptTime']);
                }
            } else {
                if(!$noDebugModeOutput) {
                    log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
                }
            }
        } else {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $pdo = NULL;

        if(!$noDebugModeOutput) {
            log_util::log(LOG_LEVEL_DEBUG, "user: ", $user);
            log_util::logDivider();
        }
		
        return $user;
    }

    public static function getUsers($status, $sessionExpired = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $users = array();
        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM users");
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                    log_util::log(LOG_LEVEL_DEBUG, "row IS NOT empty");
                    log_util::log(LOG_LEVEL_DEBUG, "row: ", $row);

                    $id = isset($row['id']) ? $row['id'] : "";
                    $loginStatusFromDatabase = lib::decrypt($id . "_login");

                    log_util::log(LOG_LEVEL_DEBUG, "id: " . $id);
                    log_util::log(LOG_LEVEL_DEBUG, "loginStatusFromDatabase: ". $loginStatusFromDatabase);

                    $user = new User();
                    $user->setId((int)$row['id']);
                    $user->setFirstName($row['firstName']);
                    $user->setLastName($row['lastName']);
                    $user->setUserName($row['userName']);
                    $user->setEmail($row['email']);
                    $user->setPassword($row['password']);
                    $user->setSecurityQuestion((int)$row['securityQuestion']);
                    $user->setSecurityQuestionAnswer($row['securityQuestionAnswer']);
                    $user->setEmailBlasts((bool)$row['emailBlasts']);
                    $user->setTextBlasts((bool)$row['textBlasts']);
                    $user->setCell($row['cell']);
                    $user->setRole((int)$row['role']);
                    $user->setLocked((bool)$row['locked']);
                    $user->setLockedByAdmin((bool)$row['lockedByAdmin']);
                    $user->setTimeLocked($row['timeLocked']);
                    $user->setConsecutiveFailedLoginAttempts((int)$row['consecutiveFailedLoginAttempts']);
                    $user->setLastLoginAttemptTime($row['lastLoginAttemptTime']);

                    $currentTime = gmdate('Y/m/d H:i:s');
                    log_util::log(LOG_LEVEL_DEBUG, "currentTime: " . $currentTime);

                    $timeDifference = strtotime($currentTime) - strtotime($user->getLastLoginAttemptTime());
                    log_util::log(LOG_LEVEL_DEBUG, "timeDifference: " . $timeDifference);

                    if($status == STATUS_LOGGED_IN && $loginStatusFromDatabase == STATUS_LOGGED_IN) {
                        if($timeDifference < (60 * 60)) {
                            log_util::log(LOG_LEVEL_DEBUG, "User WAS logged in AND session HAS NOT expired");

                            if(!$sessionExpired) {
                                array_push($users, $user);
                            }
                        } else {
                            log_util::log(LOG_LEVEL_DEBUG, "User WAS logged in BUT session HAS expired");

                            if($sessionExpired) {
                                array_push($users, $user);
                            }
                        }
                    }

                    if($status == STATUS_LOGGED_OUT && $loginStatusFromDatabase == STATUS_LOGGED_OUT) {
                        array_push($users, $user);
                    }
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "Users: ", $users);
        log_util::logDivider();

        return $users;
    }

    public static function getUsersSecurityQuestion($userNameOrEmail) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();
        $securityQuestion = NULL;

        if(!empty($pdo)) {
            $stmt = $pdo->prepare("SELECT * FROM users INNER JOIN security_questions ON users.securityQuestion = security_questions.id WHERE email = ? OR userName = ?");
            $stmt->bindParam(1, $userNameOrEmail, PDO::PARAM_STR);
            $stmt->bindParam(2, $userNameOrEmail, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_ERROR, "row WAS NOT empty");

                $securityQuestion = new SecurityQuestion();
                $securityQuestion->setId((int)$row['id']);
                $securityQuestion->setQuestion($row['question']);
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::log(LOG_LEVEL_DEBUG, "securityQuestion: ", $securityQuestion);
        log_util::logDivider();

        return $securityQuestion;
    }

    public static function migrateUser($email, $userName, $firstName, $lastName) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $user = lib_database::getUser(NULL, $email, $userName, NULL, TRUE);
			
            if($user != NULL) {
                log_util::log(LOG_LEVEL_ERROR, "row WAS NOT empty");

                $firstNameMigrate = $user->getFirstName();
                $lastNameMigrate = $user->getLastName();
                $userNameMigrate = $user->getUserName();
                $emailMigrate = $user->getEmail();
                $passwordMigrate = $user->getPassword();
                $securityQuestionMigrate = $user->getSecurityQuestion();
                $securityQuestionAnswerMigrate = $user->getSecurityQuestionAnswer();
                $emailBlastsMigrate = $user->getEmailBlasts();
                $textBlastsMigrate = $user->getTextBlasts();
                $cellMigrate = $user->getCell();
                $roleMigrate = $user->getRole();

                $stmt = $pdo->prepare("INSERT INTO users (firstName, lastName, userName, email, password, securityQuestion, securityQuestionAnswer, emailBlasts, textBlasts, cell, role) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $firstNameMigrate, PDO::PARAM_STR);
                $stmt->bindParam(2, $lastNameMigrate, PDO::PARAM_STR);
                $stmt->bindParam(3, $userNameMigrate, PDO::PARAM_STR);
                $stmt->bindParam(4, $emailMigrate, PDO::PARAM_STR);
                $stmt->bindParam(5, $passwordMigrate, PDO::PARAM_STR);
                $stmt->bindParam(6, $securityQuestionMigrate, PDO::PARAM_INT);
                $stmt->bindParam(7, $securityQuestionAnswerMigrate, PDO::PARAM_STR);
                $stmt->bindParam(8, $emailBlastsMigrate, PDO::PARAM_INT);
                $stmt->bindParam(9, $textBlastsMigrate, PDO::PARAM_INT);
                $stmt->bindParam(10, $cellMigrate, PDO::PARAM_STR);
                $stmt->bindParam(11, $roleMigrate, PDO::PARAM_INT);
                $stmt->execute();

				$stmt = $pdo->prepare("SELECT * FROM users ORDER BY id DESC LIMIT 1");
                $stmt->execute();
				$row = $stmt->fetch();
			
				$decryptedPassword = lib::decrypt($emailMigrate . "_registration");
				$encryptedPassword = lib::encrypt($decryptedPassword, $row['id'] . "_pass");
				
				$stmt = $pdo->prepare("UPDATE users SET password=? WHERE id = ?");
				$stmt->bindParam(1, $encryptedPassword, PDO::PARAM_STR);
				$stmt->bindParam(2, $row['id'], PDO::PARAM_STR);
				$stmt->execute();

                $stmt = $pdo->prepare("DELETE FROM users_temp WHERE email = ? OR userName = ?");
                $stmt->bindParam(1, $email, PDO::PARAM_STR);
                $stmt->bindParam(2, $userName, PDO::PARAM_STR);
                $stmt->execute();
            } else {
				
                log_util::log(LOG_LEVEL_ERROR, "user WAS null");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function toggleAdminAccess($userId, $granted) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        $role = $granted ? ROLE_ADMIN : ROLE_USER;

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bindParam(1, $userId, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                $email = $user = $row['email'];

                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");
                log_util::log(LOG_LEVEL_DEBUG, "email: " . $email);

                $stmt = $pdo->prepare("UPDATE users SET role=? WHERE id = ?");
                $stmt->bindParam(1, $role, PDO::PARAM_INT);
                $stmt->bindParam(2, $userId, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                $email = $user = "";
                log_util::log(LOG_LEVEL_WARNING, "row WAS empty");
            }
        } else {
            $email = $user = "";
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        if($granted) {
            log_util::log(LOG_LEVEL_DEBUG, "Sending email for admin access being granted");

            $subject = "Rock the Patch! - Admin Access Granted";
            $body = "<h2 style='color:#e44d26;'>Rock The Patch! - Admin Access Granted</h2>\r\n\r\n"
                ."\r\n"
                ."The following 'Rock the Patch!' user has been granted admin access and will now have escalated privileges while logged in."
                ."<br/><br/>\r\n\r\n"
                ."<strong>User: </strong> $user\r\n\r\n"
                ."<br/><br/>\r\n\r\n";

            $success = lib::sendMail($email, $subject, $body);
            if($success) {
                echo("<p><strong><em>EMAIL SUCCESS -- The user has been sent a confirmation that they were added as an admin user.</em></strong></p>");
            } else {
                echo("<p><strong><em>EMAIL FAILURE -- Bummer, we were not able to email the confirmation that the user was added as an admin user. Please try later or contact $masterAdminName at: <a href='mailto:$masterAdminEmail' title='Email $masterAdminName'>$masterAdminEmail</a>.</em></strong></p>");
            }
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "Sending email for admin access being revoked");

            $subject = "Rock the Patch! - Admin Access Revoked";
            $body = "<h2 style='color:#e44d26;'>Rock The Patch! - Admin Access Revoked</h2>\r\n\r\n"
                ."\r\n"
                ."The following 'Rock the Patch!' user has had admin access revoked and will no longer have escalated privileges while logged in."
                ."<br/><br/>\r\n\r\n"
                ."<strong>User: </strong> $user\r\n\r\n"
                ."<br/><br/>\r\n\r\n";

            $success = lib::sendMail($email, $subject, $body);
            if($success) {
                echo("<p><strong><em>EMAIL SUCCESS -- The user has been sent a confirmation that they have had admin access revoked.</em></strong></p>");
            } else {
                echo("<p><strong><em>EMAIL FAILURE -- Bummer, we were not able to email the confirmation that the user has had admin access revoked. Please try later or contact $masterAdminName at: <a href='mailto:$masterAdminEmail' title='Email $masterAdminName'>$masterAdminEmail</a>.</em></strong></p>");
            }
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function toggleLock($id, $lock) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if($lock) {
            $locked = 1;
            $lockedByAdmin = 1;
            $timeLocked = "";
            $consecutiveFailedLoginAttempts = 0;
        } else {
            $locked = 0;
            $lockedByAdmin = 0;
            $timeLocked = "";
            $consecutiveFailedLoginAttempts = 0;
        }

        log_util::log(LOG_LEVEL_DEBUG, "locked: " . $locked);
        log_util::log(LOG_LEVEL_DEBUG, "lockedByAdmin: " . $lockedByAdmin);
        log_util::log(LOG_LEVEL_DEBUG, "timeLocked: " . $timeLocked);
        log_util::log(LOG_LEVEL_DEBUG, "consecutiveFailedLoginAttempts: " . $consecutiveFailedLoginAttempts);

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                $user = $row['lastName'] . ", " . $row['firstName'] . " - " .$row['userName'];
                $email = $row['email'];

                log_util::log(LOG_LEVEL_DEBUG, "row WAS NOT empty");
                log_util::log(LOG_LEVEL_DEBUG, "email: " . $email);

                $id = (int) $id;

                $stmt = $pdo->prepare("UPDATE users SET locked=?, lockedByAdmin=?, timeLocked=?, consecutiveFailedLoginAttempts=? WHERE id = ?");
                $stmt->bindParam(1, $locked, PDO::PARAM_INT);
                $stmt->bindParam(2, $lockedByAdmin, PDO::PARAM_INT);
                $stmt->bindParam(3, $timeLocked, PDO::PARAM_STR);
                $stmt->bindParam(4, $consecutiveFailedLoginAttempts, PDO::PARAM_INT);
                $stmt->bindParam(5, $id, PDO::PARAM_INT);
                $stmt->execute();

                if($lock) {
                    $subject = "Rock the Patch! User Locked";
                    $body = "<h2 style='color:#e44d26;'>The Following 'Rock The Patch!' User Has Been Locked</h2>\r\n\r\n"
                        ."\r\n"
                        ."The following 'Rock the Patch!' user has been locked and will NOT be able to log in again without contacting an administrator."
                        ."<br/><br/>\r\n\r\n"
                        ."<strong>User: </strong> $user\r\n\r\n"
                        ."<br/><br/>\r\n\r\n";
                } else {
                    $subject = "Rock the Patch! User Unlocked";
                    $body = "<h2 style='color:#e44d26;'>The Following 'Rock The Patch!' User Has Been Unlocked</h2>\r\n\r\n"
                        ."\r\n"
                        ."The following 'Rock the Patch!' user has been unlocked and will now be able to log in again."
                        ."<br/><br/>\r\n\r\n"
                        ."<strong>User: </strong> $user\r\n\r\n"
                        ."<br/><br/>\r\n\r\n";
                }

                $success = lib::sendMail($email, $subject, $body);
                if($success) {
                    if($lock) {
                        echo("<p><strong><em>EMAIL SUCCESS -- The user has been notified that their account is now locked</em></strong></p>");
                    } else {
                        echo("<p><strong><em>EMAIL SUCCESS -- The user has been notified that their account is now unlocked</em></strong></p>");
                    }
                } else {
                    if($lock) {
                        echo("<p><strong><em>EMAIL FAILURE -- Bummer, we were not able to notify the user that their account is now locked. Please try later or contact $masterAdminName at: <a href='mailto:$masterAdminEmail' title='Email $masterAdminName'>$masterAdminEmail</a>.</em></strong></p>");
                    } else {
                        echo("<p><strong><em>EMAIL FAILURE -- Bummer, we were not able to notify the user that their account is now unlocked. Please try later or contact $masterAdminName at: <a href='mailto:$masterAdminEmail' title='Email $masterAdminName'>$masterAdminEmail</a>.</em></strong></p>");
                    }
                }
            } else {
                log_util::log(LOG_LEVEL_WARNING, "row WAS NOT empty");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        lib::redirect(FALSE, NULL, FALSE, "../web-admin/account-lock-administration.php");

        log_util::logDivider();
    }


    public static function updateAccessToken($clientSecret) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $token = lib::generateRandomString(LENGTH_ACCESS_TOKEN);

        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $timeStamp = gmdate("Y/m/d H:i:s");
        log_util::log(LOG_LEVEL_DEBUG, "timeStamp: " . $timeStamp);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("UPDATE oauth SET accessToken=?, timeStamp=? WHERE clientSecret=?");
            $stmt->bindParam(1, $token, PDO::PARAM_INT);
            $stmt->bindParam(2, $timeStamp, PDO::PARAM_INT);
            $stmt->bindParam(3, $clientSecret, PDO::PARAM_INT);
            $stmt->execute();

            $accessToken = lib_database::getAccessToken($token, null);

        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();

        if(isset($accessToken)) {
            return $accessToken;
        }
    }

    public static function updateAnnoyanceLevel($id, $level, $name, $isDefault) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if($isDefault == "yes") {
                $isDefault = 1;

                $newIsDefault = 0;

                $stmt = $pdo->prepare("UPDATE annoyance_levels SET isDefault = ? WHERE isDefault = ?");
                $stmt->bindParam(1, $newIsDefault, PDO::PARAM_INT);
                $stmt->bindParam(2, $isDefault, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                $isDefault = 0;
            }

            $stmt = $pdo->prepare("UPDATE annoyance_levels SET level=?, name=?, isDefault=? WHERE id = ?");
            $stmt->bindParam(1, $level, PDO::PARAM_INT);
            $stmt->bindParam(2, $name, PDO::PARAM_STR);
            $stmt->bindParam(3, $isDefault, PDO::PARAM_INT);
            $stmt->bindParam(4, $id, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function updateEmailDistro($distroId, $name) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("UPDATE email_distros SET name=? WHERE id=?");
            $stmt->bindParam(1, $name, PDO::PARAM_INT);
            $stmt->bindParam(2, $distroId, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function updateErrorReportCategory($categoryId, $category, $distro, $isDefault) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if($isDefault == "yes") {
                $isDefault = 1;
            } else {
                $isDefault = 0;
            }

            $stmt = $pdo->prepare("UPDATE error_report_categories SET name=?, distro=?, isDefault=? WHERE id = ?");
            $stmt->bindParam(1, $category, PDO::PARAM_STR);
            $stmt->bindParam(2, $distro, PDO::PARAM_INT);
            $stmt->bindParam(3, $isDefault, PDO::PARAM_INT);
            $stmt->bindParam(4, $categoryId, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function updateFeatureRequestCategory($categoryId, $category, $distro, $isDefault) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if($isDefault == "yes") {
                $isDefault = 1;
            } else {
                $isDefault = 0;
            }

            $stmt = $pdo->prepare("UPDATE feature_request_category SET name=?, distro=?, isDefault=? WHERE id = ?");
            $stmt->bindParam(1, $category, PDO::PARAM_STR);
            $stmt->bindParam(2, $distro, PDO::PARAM_INT);
            $stmt->bindParam(3, $isDefault, PDO::PARAM_INT);
            $stmt->bindParam(4, $categoryId, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    /**
     *  This function writes encryption data out to the database
     *
     * @param EncryptionData $encryptionData The encryption data to be updated
     * @param bool|NULL $noDebugModeOutput If debug mode output is echoed out or not
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes  - None
     *
     * @example - To update encryption data with debugMode output (if enabled) = lib_database::updateEncryptionData($encryptionData);
     * @example - To update encryption data with no debugMode output = lib_database::updateEncryptionData($encryptionData, TRUE);
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/05/2015
     */
    public static function updateEncryptionData(EncryptionData $encryptionData, $noDebugModeOutput = FALSE) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if(!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            if (!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
            }

            $identifier = $encryptionData->getIdentifier();
            $cipher = $encryptionData->getCipher();
            $key = $encryptionData->getKey();
            $iv = $encryptionData->getIv();
            $time = $encryptionData->getTime();

            $stmt = $pdo->prepare("UPDATE encryption SET cipher=?, encryption_key=?, iv=?, encryption_time=? WHERE identifier = ?");
            $stmt->bindParam(1, $cipher, PDO::PARAM_STR);
            $stmt->bindParam(2, $key, PDO::PARAM_STR);
            $stmt->bindParam(3, $iv, PDO::PARAM_STR);
            $stmt->bindParam(4, $time, PDO::PARAM_STR);
            $stmt->bindParam(5, $identifier, PDO::PARAM_STR);
            $stmt->execute();

        } else {
            if(!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $pdo = NULL;

        if(!$noDebugModeOutput) {
            log_util::logDivider();
        }
    }

    public static function updateIPGroupBlock($ip, $subnet, $block) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        if($block) {
            log_util::log(LOG_LEVEL_DEBUG, "Blocking ip: " . $ip . " with subnet: " . $subnet);
            lib_database::writeBlockedIPGroup($ip, $subnet);
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "Unlocking ip: " . $ip . " with subnet: " . $subnet);
            lib_database::deleteBlockedIPGroup($ip, $subnet);
        }

        log_util::logDivider();
    }

    public static function updateUserLockAttributes($id, $passed) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $lastLoginAttemptTime = gmdate("Y-m-d H:i:s");

        log_util::log(LOG_LEVEL_DEBUG, "lastLoginAttemptTime: " . $lastLoginAttemptTime);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if(!$passed) {
                $user = lib_database::getUser($id);

                $consecutiveFailedLoginAttemptsFromDB = $user->getConsecutiveFailedLoginAttempts();
                $timeLockedFromDB = $user->getTimeLocked();

                log_util::log(LOG_LEVEL_DEBUG, "consecutiveFailedLoginAttemptsFromDB: " . $consecutiveFailedLoginAttemptsFromDB);
                log_util::log(LOG_LEVEL_DEBUG, "timeLockedFromDB: " . $timeLockedFromDB);

                if(! $user->getLockedByAdmin()) {
                    log_util::log(LOG_LEVEL_DEBUG, "User WAS NOT locked by administrator");

                    if($consecutiveFailedLoginAttemptsFromDB < 4) {
                        log_util::log(LOG_LEVEL_DEBUG, "Below max consecutive number of failed login attempts");
                        $locked = FALSE;
                        $lockedByAdmin = FALSE;
                        $timeLocked = "";
                        $consecutiveFailedLoginAttempts = ((int)$consecutiveFailedLoginAttemptsFromDB) + 1;
                    } else if($consecutiveFailedLoginAttemptsFromDB == 4) {
                        log_util::log(LOG_LEVEL_DEBUG, "Reached max consecutive number of failed login attempts, locking user");
                        $locked = TRUE;
                        $lockedByAdmin = FALSE;
                        $timeLocked = gmdate('Y/m/d H:i:s');
                        $consecutiveFailedLoginAttempts = ((int)$consecutiveFailedLoginAttemptsFromDB) + 1;
                    }  else if($consecutiveFailedLoginAttemptsFromDB > 4) {
                        log_util::log(LOG_LEVEL_DEBUG, "Exceeded max consecutive number of failed login attempts");
                        $timeDifference = strtotime(gmdate('Y/m/d H:i:s')) - strtotime($timeLockedFromDB);
                        log_util::log(LOG_LEVEL_DEBUG, "timeDifference: " . $timeDifference);

                        if($timeDifference >= (30 * 60)) {
                            log_util::log(LOG_LEVEL_DEBUG, "timeDifference IS greater than 30 minutes...unlocking the user");
                            $locked = FALSE;
                            $lockedByAdmin = FALSE;
                            $consecutiveFailedLoginAttempts = 0;
                            $timeLocked = "";
                        } else {
                            log_util::log(LOG_LEVEL_DEBUG, "timeDifference IS NOT greater than 30 minutes...NOT unlocking the user");
                            $locked = TRUE;
                            $lockedByAdmin = FALSE;
                            $consecutiveFailedLoginAttempts = ((int)$consecutiveFailedLoginAttemptsFromDB) + 1;
                            $timeLocked = $timeLockedFromDB;
                        }
                    }
                } else {
                    log_util::log(LOG_LEVEL_DEBUG, "user WAS locked by administrator");
                    $locked = TRUE;
                    $lockedByAdmin = TRUE;
                    $timeLocked = "00:00:00";
                    $consecutiveFailedLoginAttempts = ((int)$consecutiveFailedLoginAttemptsFromDB) + 1;
                }
            } else {
                $locked = FALSE;
                $lockedByAdmin = FALSE;
                $timeLocked = "";
                $consecutiveFailedLoginAttempts = 0;
            }

            $locked = (int) $locked;
            $lockedByAdmin = (int) $lockedByAdmin;

            log_util::log(LOG_LEVEL_DEBUG, "locked: " . $locked);
            log_util::log(LOG_LEVEL_DEBUG, "lockedByAdmin: " . $lockedByAdmin);
            log_util::log(LOG_LEVEL_DEBUG, "timeLocked: " . $timeLocked);
            log_util::log(LOG_LEVEL_DEBUG, "consecutiveFailedLoginAttempts: " . $consecutiveFailedLoginAttempts);

            $stmt = $pdo->prepare("UPDATE users SET locked=?, lockedByAdmin=?, timeLocked=?, consecutiveFailedLoginAttempts=?, lastLoginAttemptTime=? WHERE id = ?");
            $stmt->bindParam(1, $locked, PDO::PARAM_INT);
            $stmt->bindParam(2, $lockedByAdmin, PDO::PARAM_INT);
            $stmt->bindParam(3, $timeLocked, PDO::PARAM_STR);
            $stmt->bindParam(4, $consecutiveFailedLoginAttempts, PDO::PARAM_INT);
            $stmt->bindParam(5, $lastLoginAttemptTime, PDO::PARAM_STR);
            $stmt->bindParam(6, $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;
        log_util::logDivider();
    }

    /**
     *  This function updates an update in the database
     *
     * @param Update $update The update to be updated
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes - None
     * @example - lib_database::update($update);
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/23/2015
     */
    public static function updateUpdate(Update $update) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("UPDATE recent_updates SET title=?, text=?, date=? WHERE id = ?");
            $title = $update->getTitle();
            $text = $update->getText();
            $date = $update->getDate();
            $id = $update->getId();
            $timestamp = date('Y-m-d H:i:s', strtotime($date));
            $stmt->bindParam(1, $title, PDO::PARAM_STR);
            $stmt->bindParam(2, $text, PDO::PARAM_STR);
            $stmt->bindParam(3, $timestamp, PDO::PARAM_STR);
            $stmt->bindParam(4, $id, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function updateUser($id, $firstName, $lastName, $userName, $email, $password, $securityQuestion, $securityQuestionAnswer, $emailBlasts, $textBlasts, $cellPhone) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("UPDATE users SET firstName=?, lastName=?, userName=?, email=?, password=?, securityQuestion=?, securityQuestionAnswer=?, emailBlasts=?, textBlasts=?, cell=? WHERE id = ?");
            $stmt->bindParam(1, $firstName, PDO::PARAM_STR);
            $stmt->bindParam(2, $lastName, PDO::PARAM_STR);
            $stmt->bindParam(3, $userName, PDO::PARAM_STR);
            $stmt->bindParam(4, $email, PDO::PARAM_STR);
            $stmt->bindParam(5, $password, PDO::PARAM_STR);
            $stmt->bindParam(6, $securityQuestion, PDO::PARAM_INT);
            $stmt->bindParam(7, $securityQuestionAnswer, PDO::PARAM_STR);
            $stmt->bindParam(8, $emailBlasts, PDO::PARAM_INT);
            $stmt->bindParam(9, $textBlasts, PDO::PARAM_INT);
            $stmt->bindParam(10, $cellPhone, PDO::PARAM_STR);
            $stmt->bindParam(11, $id, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function updateUserPassword($id, $newPassword) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        $encryptedPassword = lib::encrypt($newPassword, $id . "_pass");

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bindParam(1, $encryptedPassword, PDO::PARAM_STR);
            $stmt->bindParam(2, $id, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function writeAnnoyanceLevel($level, $name, $isDefault) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            if($isDefault == "yes") {
                $isDefault = 1;
                $newIsDefault = 0;

                $stmt = $pdo->prepare("UPDATE annoyance_levels SET isDefault = ? WHERE isDefault = ?");
                $stmt->bindParam(1, $newIsDefault, PDO::PARAM_INT);
                $stmt->bindParam(2, $isDefault, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                $isDefault = 0;
            }

            $stmt = $pdo->prepare("INSERT INTO annoyance_levels (level, name, isDefault) VALUE (?, ?, ?)");
            $stmt->bindParam(1, $level, PDO::PARAM_INT);
            $stmt->bindParam(2, $name, PDO::PARAM_STR);
            $stmt->bindParam(3, $isDefault, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    /**
     *  This function writes encryption data out to the database
     *
     * @param EncryptionData $encryptionData The encryption data to be written out
     * @param bool|NULL $noDebugModeOutput If debug mode output is echoed out or not
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes
     *      - Calls lib_database::updateEncryptionData() if there is already an entry for the identifier
     * @example - To write encryption data with debugMode output (if enabled) = lib_database::writeEncryptionData($encryptionData);
     * @example - To write encryption data with no debugMode output = lib_database::writeEncryptionData($encryptionData, TRUE);
     *
     * @author - Patches
     * @version - 1.0
     * @history - Created 07/05/2015
     */
    public static function writeEncryptionData(EncryptionData $encryptionData, $noDebugModeOutput = FALSE){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        if(!$noDebugModeOutput) {
            log_util::logFunctionStart($args);
        }

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            if (!$noDebugModeOutput) {
                log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");
            }

            $identifier = $encryptionData->getIdentifier();
            $stmt = $pdo->prepare("SELECT * FROM encryption WHERE identifier = ?");
            $stmt->bindParam(1, $identifier, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(empty($row)) {
                $cipher = $encryptionData->getCipher();
                $key = $encryptionData->getKey();
                $iv = $encryptionData->getIv();
                $time = $encryptionData->getTime();
                $stmt = $pdo->prepare("INSERT INTO encryption (identifier, cipher, encryption_key, iv, encryption_time) VALUE (?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $identifier, PDO::PARAM_STR);
                $stmt->bindParam(2, $cipher, PDO::PARAM_STR);
                $stmt->bindParam(3, $key, PDO::PARAM_STR);
                $stmt->bindParam(4, $iv, PDO::PARAM_STR);
                $stmt->bindParam(5, $time, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                lib_database::updateEncryptionData($encryptionData, $noDebugModeOutput);
            }

        } else {
            if(!$noDebugModeOutput) {
               log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
            }
        }

        $pdo = NULL;

        if(!$noDebugModeOutput) {
            log_util::logDivider();
        }
    }

    public static function writeErrorStatisticsAndLog($errorCode, $description) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $requestUri = lib_get::requestUri();
        log_util::log(LOG_LEVEL_DEBUG, "requestUri: " . $requestUri);

        $referer = lib_get::referer();
        if($referer == NULL) {
            $referer = "Unknown Referer - Referer not set";
        }
        log_util::log(LOG_LEVEL_DEBUG, "referer: " . $referer);

        $currentUser = lib_get::currentUser();
        if($currentUser != NULL) {
            $user = $currentUser->getEmail();
        } else {
            $user = "Anonymous";
        }
        log_util::log(LOG_LEVEL_DEBUG, "user: " . $user);

        $time = gmdate('Y/m/d H:i:s');
        log_util::log(LOG_LEVEL_DEBUG, "time: " . $time);

        $internalReference = lib_check::internalReference($referer);
        if($internalReference) {
            $type = "Internal";
        } else {
            $type = "External";
        }
        log_util::log(LOG_LEVEL_DEBUG, "type: " . $type);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM error_statistics WHERE errorCode = ?");
            $stmt->bindParam(1, $errorCode, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "Error code is already logged in the statistics table, doing UPDATE");

                $count = $row['count'] + 1;

                $stmt = $pdo->prepare("UPDATE error_statistics SET count=? WHERE errorCode = ?");
                $stmt->bindParam(1, $count, PDO::PARAM_INT);
                $stmt->bindParam(2, $errorCode, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "Error code is NOT logged in the statistics table, doing INSERT");

                $count = 1;

                $stmt = $pdo->prepare("INSERT INTO error_statistics(errorCode, count) VALUE (?, ?)");
                $stmt->bindParam(1, $errorCode, PDO::PARAM_INT);
                $stmt->bindParam(2, $count, PDO::PARAM_INT);
                $stmt->execute();
            }

            $stmt = $pdo->prepare("INSERT INTO error_log (errorCode, description, user, requestUri, referer, time, type) VALUE (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $errorCode, PDO::PARAM_INT);
            $stmt->bindParam(2, $description, PDO::PARAM_STR);
            $stmt->bindParam(3, $user, PDO::PARAM_BOOL);
            $stmt->bindParam(4, $requestUri, PDO::PARAM_STR);
            $stmt->bindParam(5, $referer, PDO::PARAM_STR);
            $stmt->bindParam(6, $time, PDO::PARAM_STR);
            $stmt->bindParam(7, $type, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    private static function writeBlockedIPGroup($ip, $subnet) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("INSERT INTO access_control (ip, subnet) VALUE (?, ?)");
            $stmt->bindParam(1, $ip, PDO::PARAM_STR);
            $stmt->bindParam(2, $subnet, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function writeEmailDistro($name) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("INSERT INTO email_distros (name) VALUE (?)");
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function writeEmailDistroMember($distroId, $email) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("INSERT INTO email_distro_members (distro, email) VALUE (?, ?)");
            $stmt->bindParam(1, $distroId, PDO::PARAM_INT);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function writeErrorReportCategory($category, $distro, $isDefault) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if($isDefault == "yes") {
                $isDefault = 1;
                $defaultUnset = 1;
                $defaultSet = 0;

                $stmt = $pdo->prepare("UPDATE error_report_categories SET isDefault=? WHERE isDefault = ?");
                $stmt->bindParam(1, $defaultSet, PDO::PARAM_BOOL);
                $stmt->bindParam(2, $defaultUnset, PDO::PARAM_BOOL);
                $stmt->execute();
            } else {
                $isDefault = 0;
            }

            $stmt = $pdo->prepare("INSERT INTO error_report_categories(name, distro, isDefault) VALUE (?, ?, ?)");
            $stmt->bindParam(1, $category, PDO::PARAM_STR);
            $stmt->bindParam(2, $distro, PDO::PARAM_STR);
            $stmt->bindParam(3, $isDefault, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function writeFeatureRequestCategory($category, $distro, $isDefault) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            if($isDefault == "yes") {
                $isDefault = 1;
                $defaultUnset = 1;
                $defaultSet = 0;

                $stmt = $pdo->prepare("UPDATE feature_request_categories SET isDefault=? WHERE isDefault = ?");
                $stmt->bindParam(1, $defaultSet, PDO::PARAM_BOOL);
                $stmt->bindParam(2, $defaultUnset, PDO::PARAM_BOOL);
                $stmt->execute();
            } else {
                $isDefault = 0;
            }

            $stmt = $pdo->prepare("INSERT INTO feature_request_categories(name, distro, isDefault) VALUE (?, ?, ?)");
            $stmt->bindParam(1, $category, PDO::PARAM_STR);
            $stmt->bindParam(2, $distro, PDO::PARAM_STR);
            $stmt->bindParam(3, $isDefault, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function writeLoginLogAndStatistics($user, $passed) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM login_statistics WHERE user = ?");
            $stmt->bindParam(1, $user, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                $attempts = $row['attempts'] + 1;
                if($passed) {
                    $succeeded = $row['succeeded'] + 1;
                    $failed = $row['failed'];
                } else {
                    $succeeded = $row['succeeded'];
                    $failed = $row['failed'] + 1;
                }

                $stmt = $pdo->prepare("UPDATE login_statistics SET attempts=?, failed=?, succeeded=? WHERE user = ?");
                $stmt->bindParam(1, $attempts, PDO::PARAM_INT);
                $stmt->bindParam(2, $failed, PDO::PARAM_INT);
                $stmt->bindParam(3, $succeeded, PDO::PARAM_INT);
                $stmt->bindParam(4, $user, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                $attempts = 1;
                if($passed) {
                    $succeeded = 1;
                    $failed = 0;
                } else {
                    $succeeded = 0;
                    $failed = 1;
                }

                $stmt = $pdo->prepare("INSERT INTO login_statistics (user, attempts, failed, succeeded) VALUE (?, ?, ?, ?)");
                $stmt->bindParam(1, $user, PDO::PARAM_STR);
                $stmt->bindParam(2, $attempts, PDO::PARAM_INT);
                $stmt->bindParam(3, $failed, PDO::PARAM_INT);
                $stmt->bindParam(4, $succeeded, PDO::PARAM_INT);
                $stmt->execute();
            }

            $timezone = date_default_timezone_get();
            date_default_timezone_set($timezone);
            $time = gmdate('Y/m/d H:i:s');

            $passed = (int) $passed;

            $stmt = $pdo->prepare("INSERT INTO login_log (user, success, loginTime) VALUE (?, ?, ?)");
            $stmt->bindParam(1, $user, PDO::PARAM_STR);
            $stmt->bindParam(2, $passed, PDO::PARAM_INT);
            $stmt->bindParam(3, $time, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function writePageLogAndStatistics($page) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $currentUser = lib_get::currentUser();
        if($currentUser != NULL) {
            $user = $currentUser->getEmail();
        } else {
            $user = "Anonymous";
        }
        log_util::log(LOG_LEVEL_DEBUG, "user: " . $user);

        $fullAgent = lib_get::fullAgent();
        if($fullAgent == NULL) {
            $fullAgent = "Unknown Full Agent - Full agent not set";
        }
        log_util::log(LOG_LEVEL_DEBUG, "fullAgent: " . $fullAgent);

        $referer = $referer = lib_get::referer();
        if($referer == NULL) {
            $referer = "Unknown Referer - Referer not set";
        }
        log_util::log(LOG_LEVEL_DEBUG, "referer: " . $referer);

        $agentInfo = lib_get::agent();
        $agent = $agentInfo['Agent'];
        $agentVersion = $agentInfo['Version'];
        log_util::log(LOG_LEVEL_DEBUG, "agent: " . $agent);
        log_util::log(LOG_LEVEL_DEBUG, "agentVersion: " . $agentVersion);

        $osInfo = lib_get::os();
        $os = $osInfo['OS'];
        $osVersion = $osInfo['Version'];
        log_util::log(LOG_LEVEL_DEBUG, "os: " . $os);
        log_util::log(LOG_LEVEL_DEBUG, "osVersion: " . $osVersion);

        $remoteAddress = lib_get::remoteAddress();
        log_util::log(LOG_LEVEL_DEBUG, "remoteAddress: " . $remoteAddress);

        $geoLocation = lib_get::geoLocation($remoteAddress);
        log_util::log(LOG_LEVEL_DEBUG, "geoLocation: ", $geoLocation);

        $isp = lib_get::isp($remoteAddress);
        log_util::log(LOG_LEVEL_DEBUG, "isp: " . $isp);

        $country = $geoLocation->getCountry();
        $state = $geoLocation->getState();
        $city = $geoLocation->getCity();
        log_util::log(LOG_LEVEL_DEBUG, "country: " . $country);
        log_util::log(LOG_LEVEL_DEBUG, "state: " . $state);
        log_util::log(LOG_LEVEL_DEBUG, "city: " . $city);

        $time = gmdate('Y/m/d H:i:s');
        log_util::log(LOG_LEVEL_DEBUG, "time: " . $time);

        if(isset($_COOKIE[COOKIE_SESSION_ID])) {
            $sessionId = $_COOKIE[COOKIE_SESSION_ID];
        } else {
            $sessionId = "No Session ID";
        }

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM page_statistics WHERE page = ?");
            $stmt->bindParam(1, $page, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(!empty($row)) {
                log_util::log(LOG_LEVEL_DEBUG, "Page IS in the database, doing UPDATE");

                $views = $row['views'] + 1;

                $stmt = $pdo->prepare("UPDATE page_statistics SET views=? WHERE page = ?");
                $stmt->bindParam(1, $views, PDO::PARAM_INT);
                $stmt->bindParam(2, $page, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                log_util::log(LOG_LEVEL_DEBUG, "Page IS NOT in the database already, doing INSERT");

                $views = 1;

                $stmt = $pdo->prepare("INSERT INTO page_statistics (page, views) VALUE (?, ?)");
                $stmt->bindParam(1, $page, PDO::PARAM_STR);
                $stmt->bindParam(2, $views, PDO::PARAM_INT);
                $stmt->execute();
            }

            $stmt = $pdo->prepare("INSERT INTO page_log (page, user, referer, fullAgent, agent, agentVersion, os, osVersion, remoteAddress, isp, country, state, city, time, sessionId) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $page, PDO::PARAM_STR);
            $stmt->bindParam(2, $user, PDO::PARAM_STR);
            $stmt->bindParam(3, $referer, PDO::PARAM_STR);
            $stmt->bindParam(4, $fullAgent, PDO::PARAM_STR);
            $stmt->bindParam(5, $agent, PDO::PARAM_STR);
            $stmt->bindParam(6, $agentVersion, PDO::PARAM_STR);
            $stmt->bindParam(7, $os, PDO::PARAM_STR);
            $stmt->bindParam(8, $osVersion, PDO::PARAM_STR);
            $stmt->bindParam(9, $remoteAddress, PDO::PARAM_STR);
            $stmt->bindParam(10, $isp, PDO::PARAM_STR);
            $stmt->bindParam(11, $country, PDO::PARAM_STR);
            $stmt->bindParam(12, $state, PDO::PARAM_STR);
            $stmt->bindParam(13, $city, PDO::PARAM_STR);
            $stmt->bindParam(14, $time, PDO::PARAM_STR);
            $stmt->bindParam(15, $sessionId, PDO::PARAM_STR);
            $stmt->execute();
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    /**
     *  This function writes update data out to the database
     *
     * @param Update $update The update data to be written
     *
     * @return None
     * @throws - Nothing
     * @global - None
     * @notes
     *  - Calls lib_database::updateUpdate() if there is already an entry for the update id
     * @example - lib_database::writeUpdate($update);
     * @author - Patches
     * @version - 1.0
     * @history - Created 08/23/2015
     */
    public static function writeUpdate(Update $update){
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $pdo = lib_database::connect();

        if(!empty($pdo)) {
            log_util::log(LOG_LEVEL_DEBUG, "pdo connection WAS NOT empty");

            $stmt = $pdo->prepare("SELECT * FROM recent_updates WHERE id = ?");
            $id = $update->getId();
            $stmt->bindParam(1, $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if(empty($row)) {
                $stmt = $pdo->prepare("INSERT INTO recent_updates (title, text, date) VALUE (?, ?, ?)");
                $title = $update->getTitle();
                $text = $update->getText();
                $date = $update->getDate();
                $timestamp = date('Y-m-d H:i:s', strtotime($date));
                $stmt->bindParam(1, $title, PDO::PARAM_STR);
                $stmt->bindParam(2, $text, PDO::PARAM_STR);
                $stmt->bindParam(3, $timestamp, PDO::PARAM_STR);
                $stmt->execute();
            } else {
                lib_database::updateUpdate($update);
            }

        } else {
           log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }

    public static function writeUsersTemp($firstName, $lastName, $userName, $email, $password, $securityQuestion, $answer, $emailBlasts, $textBlasts, $cell, $role) {
        $reflector = new ReflectionClass(__CLASS__);
        $parameters = $reflector->getMethod(__FUNCTION__)->getParameters();
        $args = [];
        foreach ($parameters as $parameter) {
            $args[$parameter->name] = ${$parameter->name};
        }
        log_util::logFunctionStart($args);

        $dbh = lib_database::connect();

        if(!empty($dbh)) {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS NOT empty");

            $exists = lib_check::userInDb(NULL, $email, $userName, NuLL, TRUE);

            if(!$exists) {
                log_util::log(LOG_LEVEL_ERROR, "user DOES NOT exist");

                $encryptedPassword = lib::encrypt($password, $email . "_registration");

                $stmt = $dbh->prepare("INSERT INTO users_temp (firstName, lastName, userName, email, password, securityQuestion, securityQuestionAnswer, emailBlasts, textBlasts, cell, role) VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindParam(1, $firstName, PDO::PARAM_STR);
                $stmt->bindParam(2, $lastName, PDO::PARAM_STR);
                $stmt->bindParam(3, $userName, PDO::PARAM_STR);
                $stmt->bindParam(4, $email, PDO::PARAM_STR);
                $stmt->bindParam(5, $encryptedPassword, PDO::PARAM_STR);
                $stmt->bindParam(6, $securityQuestion, PDO::PARAM_INT);
                $stmt->bindParam(7, $answer, PDO::PARAM_STR);
                $stmt->bindParam(8, $emailBlasts, PDO::PARAM_INT);
                $stmt->bindParam(9, $textBlasts, PDO::PARAM_INT);
                $stmt->bindParam(10, $cell, PDO::PARAM_STR);
                $stmt->bindParam(11, $role, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                log_util::log(LOG_LEVEL_ERROR, "user DOES exist");
            }
        } else {
            log_util::log(LOG_LEVEL_ERROR, "pdo connection WAS empty");
        }

        $pdo = NULL;

        log_util::logDivider();
    }
}