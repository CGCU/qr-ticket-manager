<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 15/10/2017
 * Time: 00:33
 */


/* Must be called from root of qr (due to relative links) */
function echo_header_meta() {
    echo file_get_contents("html/header-meta.html");
}

/* Must be called from root of qr (due to relative links) */
function echo_header_scripts() {
    echo file_get_contents("html/header-scripts.html");
}

/* Must be called from root of qr (due to relative links) */
function echo_navbar() {
    echo file_get_contents("html/navbar.html");
}

/* Must be called from root of qr (due to relative links) */
function echo_home_navbar() {
    echo file_get_contents("html/home-navbar.html");
}

/* Must be called from root of qr (due to relative links) */
function echo_footer() {
    echo file_get_contents("html/footer.html");
}

/* Must be called from root of qr (due to relative links) */
function echo_footer_scripts() {
    echo file_get_contents("html/footer-scripts.html");
}