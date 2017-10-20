<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 20/10/2017
 * Time: 07:01
 */

/* Query for all attendees matching the event */
$query = "SELECT qr FROM `qr_attendee` WHERE qr = '" . $qr_string . "'";

/* prepare sql statement */
$stmt = $mysqli->prepare($query);

/* execute prepared statement */
$stmt->execute();

/* get result obj */
$result = $stmt->get_result();

$found = false;

while ($row = $result->fetch_assoc()) {
    $found = true;
}

$stmt->close();
unset($stmt);

if ($found) {
    echo 'found';
} else {
    echo 'qr not found';
}

?>