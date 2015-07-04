<h1>Error Report</h1>
<p>
    See anything Funky? Have a bad experience? Report it!
</p>

<form method="post" name="error-report-form" action="/user-system/error-report-validate.php"
      enctype="multipart/form-data">
    <p><strong>Name:</strong> <label>
            <input type="text" name="name" style="width:100%;"/>
        </label></p>

    <p><strong>Email:</strong> <label>
            <input type="text" name="email" style="width:100%;"/>
        </label></p>

    <p><strong>Issue:</strong> <label>
            <textarea name="issue" rows="20" cols="50" style="width:100%;height:40px;"></textarea>
        </label></p>
    <?php
    $annoyanceLevels = lib_database::getAnnoyanceLevels();
    if (!empty($annoyanceLevels)) {
        echo("<p><strong>Annoyance Level:</strong>");
        echo("<select name='annoyance-level' style='width:100%;'>");
        foreach ($annoyanceLevels as $annoyanceLevel) {
            /** @noinspection PhpUndefinedMethodInspection */
            if ($annoyanceLevel->isDefault()) {
                /** @noinspection PhpUndefinedMethodInspection */
                echo("<option selected='selected'>" . $annoyanceLevel->getLevel() . " - " . $annoyanceLevel->getName() . "</option>");
            } else {
                /** @noinspection PhpUndefinedMethodInspection */
                echo("<option>" . $annoyanceLevel->getLevel() . " - " . $annoyanceLevel->getName() . "</option>");
            }
        }
        echo("</select>");
        echo("</p>");
    }

    $errorReportCategories = lib_database::getErrorReportCategories();
    if (!empty($errorReportCategories)) {
        echo("<p><strong>Category:</strong>");
        echo("<select name='category' style='width:100%;'>");
        foreach ($errorReportCategories as $errorReportCategory) {
            /** @noinspection PhpUndefinedMethodInspection */
            if ($errorReportCategory->isDefault()) {
                /** @noinspection PhpUndefinedMethodInspection */
                echo("<option selected='selected'>" . $errorReportCategory->getName() . "</option>");
            } else {
                /** @noinspection PhpUndefinedMethodInspection */
                echo("<option>" . $errorReportCategory->getName() . "</option>");
            }
        }
        echo("</select>");
        echo("</p>");
    }
    ?>
    <p><strong>Screen Shot:</strong></p>

    <div class="file-input"><p><input type="file" name="file"/></p></div>
    <p><em><strong>*NOTE*</strong> Only .gif, .jpeg, and .png files that are less than 20MB will be allowed as
            attachments.</em></p>

    <p><input type="submit" name="submit-error-report" value="Submit Report" class="button" style="width:100%;"/></p>
</form>

<p style="word-break:break-all;">
    Need anything else? Email <?php if(isset($gMasterAdminName)) { echo($gMasterAdminName); } ?> at:<br/> <a href="mailto:<?php if(isset($gMasterAdminEmail)) { echo($gMasterAdminEmail); } ?>?subject='Rock%20the%20Patch!'%20Email%20from%20user" title="Email <?php  if(isset($gMasterAdminName)) { echo($gMasterAdminName); } ?>"><?php if(isset($gMasterAdminEmail)) { echo($gMasterAdminEmail); } ?></a>
</p>