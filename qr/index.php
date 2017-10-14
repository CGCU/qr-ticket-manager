<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 14/10/2017
 * Time: 00:38
 */

    require 'utils.php';

    session_start();
    redirect_if_not_logged_in($_SESSION);

?>

<html>

You made it :)

</html>