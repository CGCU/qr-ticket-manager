<?php

include 'utils/utils.php';
include 'utils/template.php';

session_start();
redirect_if_not_logged_in($_SESSION);


if (isset($_GET['params'])) {
    /* Note params may be accessed in any 'include' later */
    $params = explode("/", $_GET['params']);

    if (count($params) < 2) {
        send404thendie();
    }

    //TODO: check what happens if params[0] is not a number, and 404 it
    //TODO: check own the event before you show it/let the user do any actions (security url manipulation)
    /* define event_id variable that can be seen from within any of the later 'include's */
    $event_id = (int)$params[0];

    /* Find Event Name and Date */
    /* Open DB Connection */

    /* Load databse config info */
    $db_ini = parse_ini_file('not-public/database.ini');
    $mysqli = new mysqli($db_ini['server_name'],
        $db_ini['db_user'],
        $db_ini['db_password'],
        $db_ini['db_name']
    );
    /* Delete database config info */
    unset($db_ini);

    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Database connection failed: %s\n", mysqli_connect_error());
        printf("Please email guilds@imperial.ac.uk!\n");
        exit();
    }

    /* Query for all events by the user */
    $username = $_SESSION['username'];
    $query = "SELECT name, date FROM qr_events WHERE id = '" . (string)$event_id . "'";

    /* prepare sql statement */
    $stmt = $mysqli->prepare($query);

    /* execute prepared statement */
    $stmt->execute();

    /* get result obj */
    $result = $stmt->get_result();

    /* Get row, should be only 1 as id is primary key */
    $row = $result->fetch_assoc();
    $event_name = $row['name'];
    $event_date = $row['date'];

    $stmt->close();
    unset($stmt);
    //$mysqli->close();
    /* END Find event name and Date */

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

    /* Close db connection here so can be used in includes */
    $mysqli->close();

} else {
    send404thendie();
}

?>
