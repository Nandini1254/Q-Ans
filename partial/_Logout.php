<?php
session_start();
session_destroy();
//echo "log out";
header("location: /FORUM/index.php");
?>