<?php

session_start();
session_destroy();
header('location:/staj-takip/Login/index.php');
?>