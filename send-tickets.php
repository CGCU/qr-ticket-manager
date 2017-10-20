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

?>
<html>

<h2>CGCU Welcome Dinner Ticket</h2>
<h3>2017-10-20</h3>

<p> Dear Andrew, </p>

<p> This is your ticket to CGCU Welcome Dinner. </p>

<p> Please have this ready when you're entering the venue. </p>

<p> If this ticket is on your phone, please turn your brightness up and zoom into the QR Code below: </p>

<p> <?php echo $qr_html_img ?> </p>

<h3>Information for Tonight</h3>

<p>
    <ul>
    <li>Location: <a href="https://goo.gl/maps/k8MAJNSz7F52">Millennium Gloucester Hotel</a></li>
    <li>Time: Please arrive between 18:30 and 19:00. Don't be late otherwise you might out on your arrival drink!</li>
    <li>Dress Code: Black Tie</li>
    <li>A cash/card bar with drinks at student prices, (although we would recommend bringing cash)</li>
    <li>A free cloakroom is available all night (ladies you might want to bring flats as you won't be allowed bare foot on the dancefloor)</li>
    </ul>
</p>
<br>
<p> Looking forward to seeing you there! </p>

<p> CGCU Committee </p>

</html>
