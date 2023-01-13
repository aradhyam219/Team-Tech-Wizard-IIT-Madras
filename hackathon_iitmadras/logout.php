<?php
session_start();

session_unset();
session_destroy();

header("location: net_banking_login.php");
exit;
?>