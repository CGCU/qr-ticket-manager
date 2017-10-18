<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 16/10/2017
 * Time: 02:04
 */

$err = '';
$msg = '';

if ( isset($_POST["submit"]) ) {

    if (isset($_FILES["file"])) {

        $tmpName = $_FILES['file']['tmp_name'];
        $csv_array = array_map('str_getcsv', file($tmpName));

        /* CSV sanity check */
        $num_cols = count($csv_array[0]);
        $num_cols_in_union_csv = 13;
        $num_rows = count($csv_array);


        if ($num_cols == $num_cols_in_union_csv && $num_rows > 1) {

            /* Import counter */
            $count = 0;

            /* Upload CSV to DB */
            for ($i = 1; $i < $num_rows; $i++) {
                //TODO: multiple row input in one sql statement
                /* Query for all attendees matching the event */
                $query = "INSERT INTO `qr_attendee`(`event_id`, `year`, `date`, `cid`, `login`, `first_name`, `surname`, `email`, `product_name`, `price`, `quantity_purchased`, `quantity_collected`) VALUES($event_id, " . $csv_array[$i][0] . "," . "'2017-09-21'" . "," . (int)$csv_array[$i][3] . ",'" . $csv_array[$i][4] . "','" . $csv_array[$i][5] . "','" . $csv_array[$i][6] . "','" . $csv_array[$i][7] . "','" . $csv_array[$i][8] . "'," . (int)$csv_array[$i][9] . "," . (int)$csv_array[$i][10] . "," . 0 . ")";                //STR_TO_DATE(?, '%m/%d/%Y')

                /* prepare sql statement */
                $stmt = $mysqli->prepare($query);
                /*$stmt->bind_param('dssdsssssddd',  $event_id,
                                                            $csv_array[$i][0], // year
                                                            '2017-20-20',//$csv_array[$i][1], // date
                                                            (int)$csv_array[$i][3], // cid
                                                            $csv_array[$i][4], // login
                                                            $csv_array[$i][5], // first_name
                                                            $csv_array[$i][6], // surname
                                                            $csv_array[$i][7], // email
                                                            $csv_array[$i][8], // product_name
                                                            (int)$csv_array[$i][9], // price
                                                            (int)$csv_array[$i][10], // quantity purchased
                                                            0 // quantity collected*/
                //);

                /* execute prepared statement */
                if (!$stmt->execute()) {
                    $err = "Database Error, please report to guilds@imperial.ac.uk";
                    break;
                }
                $stmt->close();

                $count++;
                $msg = 'Successfully imported ' . $count . 'attendees. Refresh the page to upload more.';
                unset($stmt);
            }

        } else {
            $err = "No file selected, incompatible file selected, or upload failed";
        }

    } else {
        $err = "No file selected";
    }
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo_header_meta() ?>

    <?php echo_header_scripts() ?>

    <!-- Page Title -->
    <title>Import CSV | QR Ticketing System :: CGCU</title>

</head>

<body>

<?php echo_navbar(); ?>

<div class="container well white-bkg" style="margin-top: 60px; position: relative">
    <div class="container">
        <h2>Import CSV from Union Shop Administration</h2>
        <br>
        <form action="/qr/event/<?php echo $event_id ?>/import-csv" method="post" enctype="multipart/form-data">
            <input type="file" name="file" id="file" /></td>
            <br>
            <input class="btn btn-primary" type="submit" name="submit" />
        </form>
        <br>
        <?php echo $err ?>
        <?php echo $msg ?>
    </div>
</div>
<!-- END EVENT TABLE LIST -->

<?php echo_footer() ?>

<?php echo_footer_scripts() ?>

</body>
</html>
