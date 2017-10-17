<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 14/10/2017
 * Time: 00:38
 */

require 'utils/utils.php';
require 'utils/template.php';

session_start();
redirect_if_not_logged_in($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo_header_meta() ?>

    <?php echo_header_scripts() ?>

    <!-- Page Title -->
    <title>QR Ticketing System :: CGCU</title>

</head>

<body>

<?php echo_home_navbar(); ?>

<div class="container well white-bkg" style="margin-top: 60px; position: relative">
    <h2>Events:</h2>
    <!-- EVENT TABLE LIST -->
    <div class="">
        <table class="table table-hover">
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
            $query = "SELECT id, name, date FROM qr_events WHERE owner_username = '" . $username . "'";

            /* prepare sql statement */
            $stmt = $mysqli->prepare($query);

            /* execute prepared statement */
            $stmt->execute();

            /* get result obj */
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo '<tr onclick="window.document.location=\'' . 'event/' . $row['id'] . '/guestlist' . '\';">';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['date'] . '</td>';
                echo '</tr>';
            }

            $stmt->close();
            $mysqli->close();

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
