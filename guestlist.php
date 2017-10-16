<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 16/10/2017
 * Time: 02:03
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

<?php echo_navbar(); ?>

<div class="container well white-bkg" style="margin-top: 60px; position: relative">

    <!-- Event Name and Date -->
    <h2>
        <?php echo $event_name ?>
    </h2>
    <h4>
        <?php echo $event_date ?>
    </h4>

    <!-- EVENT TABLE LIST -->
    <div class="">
        <table class="table table-striped">
            <colgroup>
                <col class="col-md-8">
                <col class="col-md-4">
            </colgroup>
            <thead>
            <tr>
                <th>Event Name</th>
                <th>Event Date</th>
            </tr>
            </thead>

            <tbody>

              <?php
//            /* Query for all events by the user */
//            $username = $_SESSION['username'];
//            $query = "SELECT name, date FROM qr_events WHERE owner_username = '" . $username . "'";
//
//            /* prepare sql statement */
//            $stmt = $mysqli->prepare($query);
//
//            /* execute prepared statement */
//            $stmt->execute();
//
//            /* get result obj */
//            $result = $stmt->get_result();
//
//            while ($row = $result->fetch_assoc()) {
//                echo '<tr>';
//                echo '<td>' . $row['name'] . '</td>';
//                echo '<td>' . $row['date'] . '</td>';
//                echo '</tr>';
//            }
//
//            $stmt->close();
              //unset($stmt);
//
//            ?>
            </tbody>
        </table>
    </div>
</div>
<!-- END EVENT TABLE LIST -->

<?php echo_footer() ?>

<?php echo_footer_scripts() ?>

</body>
</html>
