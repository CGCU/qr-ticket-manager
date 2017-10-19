<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 16/10/2017
 * Time: 02:09
 */

if(count($params) == 2 || count($params) == 3 && $params[2] == '') {
    /* Display guestlist with remove button */
    include 'remove-guests-page.php';
} elseif (count($params) == 3 || count($params) == 4 && $params[3] == '') {
    /* $params[2] contains the attendee ID of the row to delete */
    $attendee_id_to_delete = $params[2];
    include 'remove-guests-action.php';
}

?>