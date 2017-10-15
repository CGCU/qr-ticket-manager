<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 15/10/2017
 * Time: 00:33
 */

/* Must be called from root of qr (due to relative links) */
function echo_navbar() {
    echo file_get_contents("html/navbar.html");
}

/* Must be called from root of qr (due to relative links) */
function echo__home_navbar() {
    echo file_get_contents("html/home-navbar.html");
}