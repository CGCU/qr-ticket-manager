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
//redirect_if_not_logged_in($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- STD header v1.1.1 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- To ensure proper rendering and touch zooming on mobile, add the viewport meta tag to your <head>. -->
    <!-- maximum-scale=1, user-scalable=no" make it so that the page cannot be zoomed on touch devices-->
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Page Title -->
    <title>welcome :: CGCU</title>

    <!-- Enable below before upload to prod -->
    <!-- base href="/cgcu/" -->

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (e.g. social media icons) -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

    <!-- Stylesheet -->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<?php echo__home_navbar(); ?>

<!-- FOOTER -->
<footer>
    <div class="container well white-bkg footer-container">
        <img class="img-responsive" src="images/footer.png" alt="Footer Divider" width="1253" height="232">

        <div class="text-center text-muted">
            &copy; City and Guilds College Union 2016
        </div>
    </div>
</footer>
<!-- END FOOTER -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap: Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Main Javascript -->
<script type="text/javascript" src="js/main.js"></script>

<!-- Navbar JavaScript -->
<script type="text/javascript" src="js/navbar.js"></script>

<!-- GA - CGCU.net ------DISABLED FOR QR
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-104143018-1', 'auto');
    ga('send', 'pageview');
</script> -->

</body>
</html>
