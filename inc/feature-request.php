<h1>Feature Request</h1>
<p>
    Have a great idea for the site? Want to make the experience better for everyone? Fill in the details and hit 'Submit
    Request' below to share it so Patches
    can put some consideration towards it and make it a possibility!
</p>
<form method="post" name="feature-request" action="/user-system/feature-request-validate.php">
    <p><strong>Name:</strong><label>

            <input type="text" name="name" style="width:100%;"/>
        </label></p>

    <p><strong>Email:</strong> <label>
            <input type="text" name="email" style="width:100%;"/>
        </label></p>
    <?php
    $featureRequestCategories = lib_database::getFeatureRequestCategories();
    if (!empty($featureRequestCategories)) {
        echo("<p><strong>Category:</strong>");
        echo("<select name='category' style='width:100%;'>");
        foreach ($featureRequestCategories as $featureRequestCategory) {
            /** @noinspection PhpUndefinedMethodInspection */
            if ($featureRequestCategory->isDefault()) {
                /** @noinspection PhpUndefinedMethodInspection */
                echo("<option selected='selected'>" . $featureRequestCategory->getName() . "</option>");
            } else {
                /** @noinspection PhpUndefinedMethodInspection */
                echo("<option>" . $featureRequestCategory->getName() . "</option>");
            }
        }
        echo("</select>");
        echo("</p>");
    }
    ?>
    <p><strong>Request:</strong><label>

            <textarea name="request" rows="20" cols="50" style="width:100%;height:40px;"></textarea>
        </label></p>

    <p><input type="submit" name="submit-feature-request" value="Submit Request" class="button" style="width:100%;"/>
    </p>
</form>