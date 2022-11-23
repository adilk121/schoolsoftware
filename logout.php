<?php
require_once("includes/dbsmain.inc.php");
ob_start();
session_destroy();
unset($_SESSION["login"]);
unset($_SESSION["user_id"]);
header("Location:login.php");

?>