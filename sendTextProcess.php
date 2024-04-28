<?php
require "connection.php";
session_start();
$text = $_POST["text"];
$r_email = $_POST["email"];
$s_email = $_SESSION["u"]["email"];
//echo($s_email."<br/>");
//echo($r_email);

if(!empty($text)){
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $msg = Database::iud("INSERT INTO `chat` (`content`,`date_time`,`status`,`from`,`to`)
                VALUES ('".$text."','".$date."','0','".$s_email."','".$r_email."')");
     
     
    echo("success");
}else{
    echo("You have to type a text to send");
}
?>