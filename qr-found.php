<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 20/10/2017
 * Time: 07:01
 */
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php echo_header_meta() ?>

        <?php echo_header_scripts() ?>

        <!-- Page Title -->
        <title>QR-Scanner | QR Ticketing System :: CGCU</title>

    </head>

<body>

<?php echo_navbar($event_id); ?>

<div class="container well white-bkg" style="margin-top: 60px; position: relative">
    <h2>QR Scanner</h2>
    <h4><?php echo $event_name?></h4>
    <h5><?php echo $event_date?></h5>
    <br>

<?php
/* Query for all attendees matching the event */
$query = "SELECT cid, login, first_name, surname, email, product_name, price, quantity_purchased, quantity_collected FROM `qr_attendee` WHERE qr = '" . $qr_string . "'";

/* prepare sql statement */
$stmt = $mysqli->prepare($query);

/* execute prepared statement */
$stmt->execute();

/* get result obj */
$result = $stmt->get_result();

$found = false;

/* Assumes QR is unique */
if ($row = $result->fetch_assoc()) {
    $attendee_first_name = $row['first_name'];

    echo '<div class="">
        <table class="table table-striped">
            <colgroup>
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-2">
                <col class="col-md-3">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
            </colgroup>
            <thead>
            <tr>
                <th>CID</th>
                <th>Login</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity Purchased</th>
                <th>Quantity Collected</th>
            </tr>
            </thead>

            <tbody>';
    echo '<tr>';
    echo '<td>' . $row['cid'] . '</td>';
    echo '<td>' . $row['login'] . '</td>';
    echo '<td>' . $row['first_name'] . '</td>';
    echo '<td>' . $row['surname'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['product_name'] . '</td>';
    echo '<td>' . $row['price'] . '</td>';
    echo '<td>' . $row['quantity_purchased'] . '</td>';
    echo '<td>' . $row['quantity_collected'] . '</td>';
    echo '</tr>';
    echo '            </tbody>
        </table>
    </div>';

    /* check not already collected too many */
    if ($row['quantity_collected'] >= $row['quantity_purchased']) {
        /* Already collected */
        echo "<h4 style='color: red;'>$attendee_first_name has already collected all their tickets</h4>";
    } else {
        /* Get excited and allow collection */
        $found = true;
        echo "<h4 style='color: green;'>$attendee_first_name has been checked in!</h4>";
    }
} else {
    echo "<h4 style='color: red;'>No matching QR code found...</h4>";
}
echo "<a href=\"/qr/event/$event_id/on-the-night/qr-check\" class=\"btn btn-primary\" role=\"button\">Back to Scanner</a>    ";
echo "<a style='padding-left: 10px' href=\"/qr/event/$event_id/on-the-night/\" class=\"btn btn-info\" role=\"button\">Back to collection list</a>";

$stmt->close();
unset($stmt);

if ($found) {
    /* Query to update quantity collected */
    $query = "UPDATE qr_attendee SET quantity_collected = quantity_collected + 1 WHERE qr ='" . $qr_string . "'";

    /* prepare sql statement */
    $stmt = $mysqli->prepare($query);

    /* execute prepared statement */
    $stmt->execute();

    $stmt->close();
    unset($stmt);
}

?>
</div>

<?php echo_footer() ?>

<?php echo_footer_scripts() ?>

</body>
</html>