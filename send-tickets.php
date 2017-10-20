<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 16/10/2017
 * Time: 02:10
 */

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'lib/PHPMailer/src/Exception.php';
require 'lib/PHPMailer/src/PHPMailer.php';
require 'lib/PHPMailer/src/SMTP.php';



//include 'lib/phpqrcode/qrlib.php';
include 'lib/phpqrcode.php';

/* Use one temp file for all qr generation */
$temp_file = tempnam(sys_get_temp_dir(), 'qr_');
//$temp_file = '/tmp/qr_F5k6FE';

/* Loop through the database */

/* Query for all attendees matching the event */
$query = "SELECT id, first_name, email FROM qr_attendee WHERE event_id = " . (string)$event_id . " ORDER BY id";

/* prepare sql statement */
$stmt = $mysqli->prepare($query);

/* execute prepared statement */
$stmt->execute();

/* get result obj */
$result = $stmt->get_result();

/* Loop through the rows */
/* Row counter */
$count = 0;
while ($row = $result->fetch_assoc()) {
    $attendee_id = $row['id'];
    $attendee_first_name = $row['first_name'];
    $attendee_email = $row['email'];

    echo '<br><span style="color: blue">Starting to send to attendee ' . $attendee_id . '</span><br>';

    $qr_text = base64_encode($attendee_id . $event_name);

    /* Generate QR Code */
    QRcode::png($qr_text, $temp_file); // creates file

    /* Encode image into base 64 */
    /* Specify image path */
    $img_path = $temp_file;

    /* Read image from path then convert to base64 encoding */
    $imgData = base64_encode(file_get_contents($img_path));

    /* add meta creating the image src:  data:{mime};base64,{data}; */
    $src = 'data: '.mime_content_type($img_path).';base64,'.$imgData;

    /* Full img enclosed in html tags */
    $qr_html_img = '<img src="'.$src.'">';

    $html = "<html>

<h2>CGCU Welcome Dinner Ticket</h2>
<h3>Friday 20th October 2017</h3>

<p> Dear $attendee_first_name, </p>

<p> This is your ticket to CGCU Welcome Dinner. </p>

<p> Please have this ready when you're entering the venue. </p>

<p> If this ticket is on your phone, please turn your brightness up and zoom into the QR Code below: </p>

<p> $qr_html_img <br> Ticket Number: $attendee_id</p>

<h3>Information for Tonight</h3>

<p>
    <ul>
    <li>Location: <a href=\"https://goo.gl/maps/k8MAJNSz7F52\">Millennium Gloucester Hotel</a></li>
    <li>Time: Please arrive between 18:30 and 19:00. Don't be late otherwise you might out on your arrival drink!</li>
    <li>Dress Code: Black Tie</li>
    <li>A cash/card bar with drinks is available with student prices (although we would recommend bringing cash)</li>
    <li>A free cloakroom is available all night (ladies you might want to bring flats as you won't be allowed bare foot on the dancefloor)</li>
    </ul>
</p>
<br>
<p> Looking forward to seeing you there! </p>

<p> CGCU Committee </p>

</html>";

    /* SEND EMAIL */

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'guilds@ic.ac.uk';                 // SMTP username
        $mail->Password = '***REMOVED***';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('guilds@imperial.ac.uk', 'City and Guilds College Union');
        $mail->addAddress($attendee_email);

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Your Ticket to the CGCU Welcome Dinner';
        $mail->Body    = $html;

        $mail->send();
        echo '<br><span style="color: blue">Message has been sent to attendee ' . $attendee_id . '</span><br>';

    } catch (Exception $e) {
        echo '<br><span style="color: red">Message could not be sent.</span><br>';
        echo '<span style="color: red">Mailer Error: ' . $mail->ErrorInfo . '</span><br>';
    }
    $count++;
    sleep(1);
}

$stmt->close();
unset($stmt);

echo "<br><span style=\"color: green\">Finished. $count emails have been sent!</span>";

?>

