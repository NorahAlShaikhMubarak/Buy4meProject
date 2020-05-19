<?php

$title = "Contact";
include 'header.php';
require_once 'mail/class.phpmailer.php';

if(isset($_POST['send']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    //Create an Object to the PHPMailer Class
    $mail = new PHPMailer();

    //Set the From Address - What user entered
    $mail->From = $email;    
    $mail->FromName = $name;    
    $mail->AddReplyTo($email);

    //Set the To Address
    $address = "test@drmisbha.net";
    $mail->AddAddress($address, "Contact From Site");

    //Set the Subject and the Message Body
    $mail->Subject = $name . " contacted through Buy4mMe Website";
    $mail->Body = $message;
    
    //SMTP Settings
    $mail->IsSMTP(); // enable SMTP 
    $mail->SMTPAuth = true; // authentication enabled 
    $mail->Username = "test@drmisbha.net"; 
    $mail->Password = "ccsit_Kfu2013";
    $mail->Host = 'smtp.drmisbha.net'; 
    $mail->Port = 587; 

    if(!$mail->Send()) {
        header("Location: contact.php?status=notsubmitted");
        exit;

    } else {
        header("Location: contact.php?status=submitted");
        exit;
    }   
} 
?>

<div id="content">

<div class="page section">
    <h1>Contact Me</h1>
    
    <?php if(isset($_GET['status'])&&$_GET['status']=='submitted') { ?>
    <p>Thank you for Contacting Us. We will be in touch shortly.</p>
    <?php } else { if(isset($_GET['status'])&&$_GET['status']=='notsubmitted') { ?>
    <p>Sorry, the mail could not be send. </p>
    <?php } else { ?>
                <form id="contact" name="contact" method="POST" action="contact.php">

                    <table>
                        <tr>
                            <th>
                                <label for="name">Name</label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name">
                                
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="email">Email</label>
                            </th>
                            <td>
                                <input type="text" name="email" id="email">
                                
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="message">Message</label>
                            </th>
                            <td>
                                <textarea name="message" id="message"></textarea>
                            </td>
                        </tr>                    
                    </table>
                    <input type="submit" value="Send" name="send" id="send"/>

                </form>

                <?php } } ?>
    
</div>
<?php include 'footer.php'; ?>
