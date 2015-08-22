<h1>Recent Updates</h1>

<?php
    $update = lib_database::getMostRecentUpdate();

    if(!empty($update)) {
        echo("<h2 style='text-align:center'>" . $update->getTitle() . "</h2>");
        $updateText = substr($update->getText(), 0, 325);
        echo("<p>" . $updateText . "<em><a href='/recent-updates-log.php' title='Recent Updates Log'>...continue reading</a></em></p>");
        echo("<p>Date Posted: " . $update->getDate() . "</p>");
    }
?>

<p><em><a href="/recent-updates-log.php" title="Recent Updates Log">Want to see more?</a></em></p>