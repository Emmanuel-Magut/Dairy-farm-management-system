 <!-- Sessions to prevent unauthorized members from accessing private pages in -->
<?php
session_start(); //#1
if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 2))
{ 
header("Location: login.php");
 exit();
}
?>