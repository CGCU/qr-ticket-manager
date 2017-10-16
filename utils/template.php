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

function echo_navbar() {
    echo file_get_contents("html/navbar.html");
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