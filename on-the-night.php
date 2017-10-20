<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 16/10/2017
 * Time: 01:28
 */


if(count($params) == 2 || count($params) == 3 && $params[2] == '') {
    /* Display this page with collect buttons */
} elseif (count($params) == 3 || count($params) == 4 && $params[3] == '') {
    /* $params[2] contains the attendee ID of the row to delete */
    include 'qr-reader.php';
} elseif (count($params) == 4 || count($params) == 5 && $params[4] == '') {
    /* $params[3] contains qr code string */
    $qr_string = $params[3];
    include 'qr-found.php';
}

?>