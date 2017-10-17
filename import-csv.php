<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 16/10/2017
 * Time: 02:04
 */

if ( isset($_POST["submit"]) ) {

    if ( isset($_FILES["file"])) {

        $tmpName = $_FILES['file']['tmp_name'];
        $csvAsArray = array_map('str_getcsv', file($tmpName));

        var_dump($csvAsArray);

    } else {
        echo "No file selected <br />";
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
    </div>
</div>
<!-- END EVENT TABLE LIST -->

<?php echo_footer() ?>

<?php echo_footer_scripts() ?>

</body>
</html>
