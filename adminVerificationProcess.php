<?php

require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){
    $email = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."' ");
    $admin_num = $admin_rs->num_rows;

    if($admin_num>0){

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nethminas42@gmail.com';
        $mail->Password = 'wyeklxlfwhkgvbih';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('nethminas42@gmail.com', 'Admin Verification');
        $mail->addReplyTo('nethminas42@gmail.com', 'Admin Verification');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'eShop Admin Login Verification Code';
        $bodyContent = '<h1 style ="color:green">Your Verification code is '.$code.'</h1>';
        $bodyContent .= '******************';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo'Verification code sending failed';
        }else{
            echo'Success';
        }


    }else{
        echo("You are not a valid user");
    }

}else{
    echo("Email field should not be empty");
}


?>