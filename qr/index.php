<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 14/10/2017
 * Time: 00:38
 */

    //require("config.php");
    session_start();
    if(!$_SESSION['loggedIn']) {
        header("Location: login.php");
        die("Redirecting to login.php");
    }
?>

<html>

You made it :)

</html>