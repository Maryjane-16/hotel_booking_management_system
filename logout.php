<?php

session_start();

require_once "includes/isloggedin.php";

// Unset all the session variables
$_SESSION = [];

// Destroy all the session
session_destroy();


header('Location: http://localhost:200/');
exit();