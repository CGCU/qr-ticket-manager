<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 20/10/2017
 * Time: 08:23
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo_header_meta() ?>

<?php echo_header_scripts() ?>

<!-- Page Title -->
<title>On-the-night | QR Ticketing System :: CGCU</title>

</head>

<body>

<?php echo_navbar($event_id); ?>

<div class="container well white-bkg" style="margin-top: 60px; position: relative">

    <h2>On the night</h2>
    <h4><?php echo $event_name?></h4>
    <h5><?php echo $event_date?></h5>

    <br><a href="/qr/event/<?php echo $event_id?>/on-the-night/qr-check" class="btn btn-primary" role="button">QR Scanner</a><br><br>

    <?php /* Query for counting number of event attendees in total */
    $query = "SELECT SUM(quantity_purchased) AS sum FROM `qr_attendee` WHERE event_id = " . (string)$event_id;

    /* prepare sql statement */
    $stmt = $mysqli->prepare($query);

    /* execute prepared statement */
    $stmt->execute();

    /* get result obj */
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    echo 'You have ' . $row['sum'] . ' attendees.<br>';

    $stmt->close();
    unset($stmt);

    /* Query for counting number of event attendees arrived */
    $query = "SELECT SUM(quantity_collected) AS sum FROM `qr_attendee` WHERE event_id = " . (string)$event_id;

    /* prepare sql statement */
    $stmt = $mysqli->prepare($query);

    /* execute prepared statement */
    $stmt->execute();

    /* get result obj */
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    echo $row['sum'] . ' attendees have arrived.';

    $stmt->close();
    unset($stmt);
    ?>

    <!-- EVENT TABLE LIST -->
    <div class="">
        <table class="table table-striped">
            <colgroup>
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-2">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
            </colgroup>
            <thead>
            <tr>
                <th>Ticket</th>
                <th>CID</th>
                <th>Login</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity Purchased</th>
                <th>Quantity Collected</th>
                <th>Collect</th>
            </tr>
            </thead>

            <tbody>

            <?php
            /* Query for all attendees matching the event */
            $query = "SELECT id, cid, login, first_name, surname, email, product_name, price, quantity_purchased, quantity_collected, qr FROM qr_attendee WHERE event_id = " . (string)$event_id;

            /* prepare sql statement */
            $stmt = $mysqli->prepare($query);

            /* execute prepared statement */
            $stmt->execute();

            /* get result obj */
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['cid'] . '</td>';
                echo '<td>' . $row['login'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['surname'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['product_name'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td>' . $row['quantity_purchased'] . '</td>';
                echo '<td>' . $row['quantity_collected'] . '</td>';
                echo '<td> <a href="/qr/event/' . $event_id . '/on-the-night/qr-check/' . $row['qr'] . '">Collect for '. $row['first_name'] . '</a><td>';
                echo '</tr>';
            }

            $stmt->close();
            unset($stmt);
            ?>
            </tbody>
        </table>
    </div>
</div>
<!-- END EVENT TABLE LIST -->

<?php echo_footer() ?>

<?php echo_footer_scripts() ?>

</body>
</html>

