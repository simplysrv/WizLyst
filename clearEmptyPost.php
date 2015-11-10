<?php
session_start();

//Database Connectivity
include_once "dbinfo.inc.oop.php";

clearEmptyPosts();
echo "Done!";

?>