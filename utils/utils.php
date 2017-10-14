<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 14/10/2017
 * Time: 13:40
 */

function redirect_if_not_logged_in($session) {
    if(!$session['loggedIn']) {
        header("Location: login.php");
        die("Redirecting to login.php");
    }
}