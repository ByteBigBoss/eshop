<?php
session_start();
require "connection.php";
//echo($_SESSION["au"]["email"]);
$msg_txt = $_POST["t"];
if (isset($_POST["r"])) {
    $receiver = $_POST["r"];
}
//echo($receiver);
$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$sender;
if (!empty($msg_txt)) {
    if (isset($_SESSION["u"])) {
        echo ("user");
        $sender = $_SESSION["u"]["email"];
    } else if (isset($_SESSION["au"])) {
        echo ("admin");
        $sender = $_SESSION["au"]["email"];
    }


    if (!empty($receiver)) {
        // echo("recieeve is not empty");
        Database::iud("INSERT INTO `chat`(`content`,`date_time`,`status`,`from`,`to`) VALUES 
            ('" . $msg_txt . "','" . $date . "','1','" . $sender . "','" . $receiver . "')");

        echo "success1";
    } else {
        //echo("reciever is empty");
        Database::iud("INSERT INTO `chat`(`content`,`date_time`,`status`,`from`,`to`) VALUES 
            ('" . $msg_txt . "','" . $date . "','1','" . $sender . "','".$receiver."')");

        echo "success2";
    }
} else {
    echo ("You have to type some text to send");
}
