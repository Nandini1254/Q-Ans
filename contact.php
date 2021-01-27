<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'partial\PHPMailer/src/Exception.php';
require 'partial\PHPMailer/src/PHPMailer.php';
require 'partial\PHPMailer/src/SMTP.php';

include 'partial\_dbconnect.php';
// making unique

// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$true=false;

if(isset($_POST['email']))
{
    //$token=uniqid(true);
    $email=$_POST['email'];
    $query=$_POST['query'];
    $sql="SELECT * FROM `user` WHERE `email`='$email'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_num_rows($result);
    if($row==1)
    {
        // $sql="INSERT INTO `reset_password` (`token`, `email`) VALUES ('$token', '$email')";
        // $result=mysqli_query($conn,$sql);
        try {
            //Server settings
          //  $mail->SMTPDebug = 2;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'dhanira04@gmail.com';                     // SMTP username
            $mail->Password   = 'Niluv@125';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
            //Recipients
            // $email
            $mail->setFrom('dhanira04@gmail.com', 'Mymail');
            $mail->addAddress("$email", 'Nandini');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            // $mail->addReplyTo('dhanira04@gmail.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            // Content
            // "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/FORUM/partial/_request.php?token=12345";
            // $url="http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/_resetpassword.php?token=".$token;
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Contact query';
            $mail->Body    = 'How can we help in this topic please brief your question.';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            $true=true;
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    else
    {
        echo "<center><h3>Please enter valid email address</h3></center>";
    }
    
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>comments</title>
    <style>
     .container{
        width:50%;
        min-height: 500px;
    }
    </style>
</head>
<body>
    <?php 
    include 'partial/_header.php';
    $_SESSION['contact']=true;
    include 'partial/_dbconnect.php';
    ?>
    <div class="container">
        <?php
            if($true)
            {
                echo '<div><center>We will contact you as soon as possible</center></div>';
                $_SESSION['contact']=false;
                header("location: index.php");
            }      
        ?>
        <strong class="my=4" style="font-size:34px">contact US</strong>
        <form action="<?php  $_SERVER['REQUEST_URI'] ?>" method="post" class="my-4">
            <div class="mb-3">
                <label for="Email1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="Email1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                 <label for="query" class="form-label">Ask the Query</label>
                 <textarea name="query" class="form-control" id="" cols="30" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Mail</button>
            <br>
        </form>
    </div>
    <?php include 'partial/_footer.php';?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>