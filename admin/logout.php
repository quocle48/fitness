<?php
include_once("../application/libraries/config.php");
session_unset();
session_destroy();
header("Location: index.php");
?>