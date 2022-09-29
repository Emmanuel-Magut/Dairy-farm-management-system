<!-- this is the code that processes logout -->
<?php
session_start();//access the current session. #1
// if no session variable exists then redirect the user
if (!isset($_SESSION['member_id'])) { //#2
header("location:index.php"); //direct user to landing page
exit();
//cancel the session and redirect the user:
}

else{ //cancel the session //#3
 $_SESSION = array(); // Destroy the variables
 $params = session_get_cookie_params();
 // Destroy the cookie
 Setcookie(session_name(), time() +10,
 $params["path"], $params["domain"],
 $params["secure"], $params["httponly"]);
if (session_status() == PHP_SESSION_ACTIVE) {
 session_destroy(); } // Destroy the session itself
 header("location:index.php");
 }

?>
