<?php

/**
 * This example shows how to send a message to a whole list of recipients efficiently.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_STRICT | E_ALL);

date_default_timezone_set('Etc/UTC');

require 'vendor/autoload.php';

//Passing `true` enables PHPMailer exceptions
$mail = new PHPMailer(true);

//$body = file_get_contents('indexando.php');
$body = '<html>
<head>
    <meta charset="utf-8">
    <title>Advertising agency-Email Signature</title>
    


<body style="margin: 0;padding: 0;">



    <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td align="center">
                <table border="0" cellspacing="0" cellpadding="0" width="792">
                    <tr>
                        <td align="center" bgcolor="#201d1e">
                            <table border="0" cellspacing="0" cellpadding="0" width="792">
                                <tr>
                                    <td align="center">
                                        <table border="0" cellspacing="0" cellpadding="0" width="696" style="padding: 30px 0 18px 0;">
                                            <tr>
                                                <td align="center">
                                                    <table border="0" cellspacing="0" cellpadding="0" width="160" style="padding: 0;">
                                                        <tr>
                                                            <td align="center"  width="160" valign="top" style="background-color: #f8a358;">
                                                            <img src="https://scontent.fgig4-1.fna.fbcdn.net/v/t1.6435-9/31961139_990339001142332_9196949518308868096_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=PowCr4oV51wAX_XC5ml&tn=sEfJ1n1u6pvF1X10&_nc_ht=scontent.fgig4-1.fna&oh=00_AT92bxtuaSdZ7Vrda4mkRQt5Wo1GESZA2GYGNsM4voeKMA&oe=6206FA7A" alt="img-1" style="border:0;display: block;width: 150px;height: 150px;padding: 5px;">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="51"></td>
                                                <td align="center" valign="top" width="325">
                                                    <table border="0" cellspacing="0" cellpadding="0" width="325">
                                                        <tr>
                                                            <td align="left" valign="top" width="325">
                                                                <h1 style="margin: 0;font-size: 40px;color:#ffffff;font-weight: 600;font-family:Arial, Verdana,Helvetica, sans-serif;">Jones Moura</h1>
                                                                <p style="margin: 0 0 0 20px;font-size: 20px;color:#f8a358;font-weight: 600;text-align: center;font-family: Arial, Verdana,Helvetica, sans-serif;"> Deputado</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" valign="top" width="300" style="padding: 58px 0 8px 0;">
                                                                <a href="#" style="margin:  0;font-size: 12px;color:#ffffff;text-decoration: none;font-family: arial;"> (61)3215-5287 </a>
                                                                <p style="margin:0;font-size: 12px;color:#ffffff;width: 300px;font-family: Arial, Verdana,Helvetica, sans-serif;"> Gabinete 287-Anexo III-Câmara dos Deputados</p>
                                                                <a href="data:image/png;base64,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" style="margin:0;font-size: 12px;color:#ffffff;font-family: Arial, Verdana,Helvetica, sans-serif;text-decoration: none;display: block;">jonesmourasite.com</a>
                                                                <a href="mailto: mail@andersonadvertising.com" style="margin:  0;font-size: 12px;color:#ffffff;text-decoration: none;font-family: Arial, Verdana,Helvetica, sans-serif;"> jonesmoura@camara.leg.br</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" valign="top" width="325">
                                                                <span>
                                                                    <a href="https://www.facebook.com/jonesmourarj/"  target="_blank" style="text-decoration: none;margin-right:22px;">
                                                                        <img src=" https://cdn-icons-png.flaticon.com/512/20/20837.png" width="20px" height ="20px " alt="fb" style="display: inline-block;">
                                                                    </a>
                                                                    <a href="https://twitter.com/jonesmourarj"   target="_blank" style="text-decoration: none;margin-right:22px;">
                                                                        <img src="https://cdn-icons.flaticon.com/png/512/3128/premium/3128212.png?token=exp=1642234471~hmac=666643ae3098cfb1b38752bdc86f8f79" alt="twitter" width="20px" height ="20px " style="display: inline-block;">
                                                                    </a>
                                                                    <a href="https://mail.google.com/mail/u/3/#inbox" style="text-decoration: none;margin-right:22px;">
                                                                        <img src="https://cdn-icons-png.flaticon.com/512/1051/1051335.png" width="20px" height ="20px " target="_blank" alt="google plus" style="display: inline-block;">
                                                                    </a>
                                                                    <a href="https://www.instagram.com/jonesmourarj/" style="text-decoration: none;margin-right:22px;">
                                                                        <img src="https://cdn-icons.flaticon.com/png/512/4922/premium/4922972.png?token=exp=1642234425~hmac=08619b8e4140a6e6c926fd3e2f70788e"   target="_blank" width="20px" height ="20px " alt="instagram" style="display: inline-block;">
                                                                    </a>
                                                                    
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td align="right" valign="top" width="160">
                                                    <img src="/jonesgrito.jpg" alt="logo" style="border:0;display: block;max-width: 100%;">
                                                  
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';


$mail->addAttachment(dirname(__FILE__).'/jonesgrito.jpg', 'jonesgrito');    //Optional name
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; //SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 25;
$mail->Username = 'your gmail';
$mail->Password = 'your pass';
$mail->setFrom('your gmail', 'List manager');
$mail->addReplyTo('your gmail', 'List manager');

$mail->Subject = 'PHPMailer Simple database mailing list test';

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

//Connect to the database and select the recipients from your mailing list that have not yet been sent to
//You'll need to alter this to match your database
$d=date('Y-m-d');

$mysql = mysqli_connect('localhost', 'root', '');
mysqli_select_db($mysql, 'mydb');
$result = mysqli_query($mysql, "SELECT full_name, email,dob From employee ");

$resulta = mysqli_query($mysql, "SELECT full_name, email,dob From employee  where DATE_FORMAT(dob,'%m-%d') =DATE_FORMAT('$d' ,'%m-%d ' ");




foreach ($result as $row) {
    try {
        $mail->addAddress($row['email'], $row['full_name'], $row['dob']);
    } catch (Exception $e) {
        echo 'Invalid address skipped: ' . htmlspecialchars($row['email']) . '<br>';
        continue;
    }
    

    try {


        $mail->send();
        echo 'Message sent to :' . htmlspecialchars($row['full_name']) . ' (' .
            htmlspecialchars($row['email']) . ')<br>';
        //Mark it as sent in the DB
        mysqli_query(
            $mysql,
            "UPDATE mailinglist SET sent = TRUE WHERE email = '" .
            mysqli_real_escape_string($mysql, $row['email']) . "'"
        );
    

}
    catch (Exception $e) {
        echo 'Mailer Error (' . htmlspecialchars($row['email']) . ') ' . $mail->ErrorInfo . '<br>';
        //Reset the connection to abort sending this message
        //The loop will continue trying to send to the rest of the list
        $mail->getSMTPInstance()->reset();
    }
    //Clear all addresses and attachments for the next iteration
    $mail->clearAddresses();
    $mail->clearAttachments();
}
