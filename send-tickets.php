<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 16/10/2017
 * Time: 02:10
 */

/* Encode image into base 64 */
/* Specify image path */
$img_path = 'https://cgcu.net/files/vat.jpg';

/* Read image from path then convert to base64 encoding */
$imgData = base64_encode(file_get_contents($img_path));

/* add meta creating the image src:  data:{mime};base64,{data}; */
$src = 'data: '.mime_content_type($img_path).';base64,'.$imgData;

/* Full img enclosed in html tags */
echo '<img src="'.$src.'">';
