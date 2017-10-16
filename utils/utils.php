<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 14/10/2017
 * Time: 13:40
 */

function redirect_if_not_logged_in($session) {
    if(!$session['loggedIn']) {
        header("Location: /qr/login.php");
        die("Redirecting to login.php");
    }
}

function send404() {
    http_response_code(404);
    die();
}

/* Connection will need closing after!!
function create_mysqli_obj() {
    // Load databse config info
    $db_ini = parse_ini_file('not-public/database.ini');
    $mysqli = new mysqli($db_ini['server_name'],
        $db_ini['db_user'],
        $db_ini['db_password'],
        $db_ini['db_name']
    );
    // Delete database config info
    unset($db_ini);
    // Return mysql obj
    return $mysqli;
}*/