<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 15/10/2017
 * Time: 00:33
 */

/* Must be called first inside header tag */
function echo_header_meta() {
    echo file_get_contents("html/header-meta.html");
}

function echo_header_scripts() {
    echo file_get_contents("html/header-scripts.html");
}

function echo_navbar($event_id) {
    //echo file_get_contents("html/navbar.html");
    echo "<!-- IGNORE PHPSTORM RELATIVE LINKS HERE -->
<!-- WHEN CHANGING: Check home-navbar.html for any possible required changes -->

<!-- NAVBAR -->

<nav class=\"navbar navbar-default navbar-fixed-top\" id=\"navbar\">
    <!-- VARIABLE: <div class=\"container-fluid\"> when less than 1200
         or <div class=\"container\">
     -->
    <div class=\"container\">
        <div class=\"variable-fluid\">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\"
                        data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <img class=\"img-responsive navbar-logo\" src=\"/qr/images/cgcu_logo_small.jpg\" alt=\"CGCU Logo\" width=\"60\">
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                <ul class=\"nav navbar-nav navbar-hover navbar-autoactivate\" id=\"navlist\">
                    <li><a href=\"/qr/index.php\">Home</a></li>
                    <li><a href=\"/qr/account.php\">Account</a></li>
                    <p class=\"navbar-text\"> <span style=\"font-size: 110%\"> || </span> </p>
                    <li><a href=\"/qr/event/$event_id/guestlist\">Guest List</a></li>
                    <li><a href=\"/qr/event/$event_id/on-the-night\">On The Night</a></li>
                    <li><a href=\"/qr/event/$event_id/import-csv\">Import CSV</a></li>
                    <li><a href=\"/qr/event/$event_id/add-guests\">Add Guests</a></li>
                    <li><a href=\"/qr/event/$event_id/remove-guests\">Remove Guests</a></li>
                    <li><a href=\"/qr/event/$event_id/plus1-solver\">+1 Solver</a></li>
                    <li><a href=\"/qr/event/$event_id/send-tickets\">Send Tickets</a></li>
                </ul>

                <!-- END Fixed right side of the navbar -->

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </div>
</nav>

<!-- END NAVBAR -->";

}

function echo_home_navbar() {
    echo file_get_contents("html/home-navbar.html");
}

function echo_footer() {
    echo file_get_contents("html/footer.html");
}

function echo_footer_scripts() {
    echo file_get_contents("html/footer-scripts.html");
}