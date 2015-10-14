<?php
include("php-main/lib.php");
lib::cookieDestroy("userScore");
lib::cookieDestroy("compScore");
lib::cookieDestroy("rounds");
lib::cookieDestroy("ties");
lib::redirect(FALSE, FALSE, FALSE, "/rock-paper-scissors.php");