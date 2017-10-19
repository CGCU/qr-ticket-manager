<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 19/10/2017
 * Time: 19:14
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo_header_meta() ?>

    <?php echo_header_scripts() ?>

    <!-- Page Title -->
    <title>Guestlist | QR Ticketing System :: CGCU</title>

</head>

<body>

<?php echo_navbar($event_id); ?>

<div class="container well white-bkg" style="margin-top: 60px; position: relative">
    <h2>Remove Guest - Confirmation</h2>
    <h4><?php echo $event_name?></h4>
    <h5><?php echo $event_date?></h5>
    <br>
    The row below has been deleted.

    <!-- EVENT TABLE LIST -->
    <div class="">
        <table class="table table-striped">
            <colgroup>
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-1">
                <col class="col-md-3">
                <col class="col-md-3">
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
                <th>Quantity</th>
            </tr>
            </thead>

            <tbody>

            <?php
            /* Query for atendee row */
            $query = "SELECT id, cid, login, first_name, surname, email, product_name, price, quantity_purchased FROM qr_attendee WHERE id = " . (int)$attendee_id_to_delete;

            /* prepare sql statement */
            $stmt = $mysqli->prepare($query);

            /* execute prepared statement */
            $stmt->execute();

            /* get result obj */
            $result = $stmt->get_result();

            /* Sanity Check */
            if ($result->num_rows != 1) {
                echo "Database error on removing guest (action). Please emaiil guilds@imperial.ac.uk";
            }

            /* Fetch Deleted Row */
            $row = $result->fetch_assoc();
            echo '<tr>';
            echo '<td>' . $row['cid'] . '</td>';
            echo '<td>' . $row['login'] . '</td>';
            echo '<td>' . $row['first_name'] . '</td>';
            echo '<td>' . $row['surname'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['product_name'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '<td>' . $row['quantity_purchased'] . '</td>';
            echo '</tr>';

            $stmt->close();
            unset($stmt);

            /* Query to delete attendee */
            $query = "DELETE FROM `qr_attendee` WHERE `qr_attendee`.`id` = " . (int)$attendee_id_to_delete;

            /* prepare sql statement */
            $stmt = $mysqli->prepare($query);

            /* execute prepared statement */
            $stmt->execute();

            /* get result obj */
            $result = $stmt->get_result();

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