<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 16/10/2017
 * Time: 02:10
 */

//include 'lib/phpqrcode/qrlib.php';
include 'lib/phpqrcode.php';

//$temp_file = tempnam(sys_get_temp_dir(), 'qr_');
$temp_file = '/tmp/qr_F5k6FE';

QRcode::png('code data text', $temp_file); // creates file

/* Encode image into base 64 */
/* Specify image path */
$img_path = $temp_file;

/* Read image from path then convert to base64 encoding */
$imgData = base64_encode(file_get_contents($img_path));

/* add meta creating the image src:  data:{mime};base64,{data}; */
$src = 'data: '.mime_content_type($img_path).';base64,'.$imgData;

/* Full img enclosed in html tags */
$qr_html_img = '<img src="'.$src.'">';

echo $qr_html_img;