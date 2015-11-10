<?php
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

session_start(); 
session_destroy();
header('Location: index.php');
?>