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

<?php echo_footer() ?>

<?php echo_footer_scripts() ?>

</body>
</html>
