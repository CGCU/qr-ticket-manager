<?php

include 'utils/utils.php';

session_start();
var_dump($_SESSION);
redirect_if_not_logged_in($_SESSION);


if (isset($_GET['params'])) {
    /* Note params may be accessed in any 'include' later */
    $params = explode("/", $_GET['params']);

    if (count($params) < 2) {
        send404thendie();
    }

    //TODO: check what happens if params[0] is not a number, and 404 it
    /* define event_id variable that can be seen from within any of the later 'include's */
    $event_id = (int)$params[0];

    if (strcasecmp($params[1], 'on-the-night') === 0) {
        include 'on-the-night.php';
    } elseif (strcasecmp($params[1], 'guestlist') === 0) {
        include 'guestlist.php';
    } elseif (strcasecmp($params[1], 'import-csv') === 0) {
        include 'import-csv.php';
    } elseif (strcasecmp($params[1], 'add-guests') === 0) {
        include 'add-guests.php';
    } elseif (strcasecmp($params[1], 'remove-guests') === 0) {
        include 'remove-guests.php';
    } elseif (strcasecmp($params[1], 'plus1-solver') === 0) {
        include 'plus1-solver.php';
    } elseif (strcasecmp($params[1], 'send-tickets') === 0) {
        include 'send-tickets.php';
    }

    //var_dump($params);

} else {
    send404thendie();
}

?>
