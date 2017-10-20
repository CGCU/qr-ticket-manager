<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 20/10/2017
 * Time: 06:26
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo_header_meta() ?>

    <?php echo_header_scripts() ?>

    <!-- Page Title -->
    <title>QR Scanner | QR Ticketing System :: CGCU</title>

</head>

<body>

<?php echo_navbar($event_id); ?>

<div class="container well white-bkg" style="margin-top: 60px; position: relative">

    <h2>QR Code Scanning</h2>
    <h4><?php echo $event_name?></h4>
    <h5><?php echo $event_date?></h5>
    <br>

    <video id="preview"></video>

</div>

<?php echo_footer() ?>

<?php echo_footer_scripts() ?>

<script type="text/javascript" src="js/instascan.min.js"></script>

<script type="text/javascript">
    var scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
    scanner.addListener('scan', function (content) {
        qrCodeFound(content)
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });

    function qrCodeFound(qr) {
        console.log(qr);
    }

</script>

</body>
</html>
