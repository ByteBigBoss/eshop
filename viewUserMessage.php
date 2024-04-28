<?php
require "connection.php";
session_start();
$reciever_mail = $_SESSION["au"]["email"];

$sender_mail = $_GET["f"];//customer care admin email
//echo($sender_mail);
$msg_rs = Database::search("SELECT * FROM `chat` WHERE `from`='" . $sender_mail . "' OR `to`='" . $sender_mail . "' ");
Database::iud("UPDATE chat SET `status`='1' WHERE `from`='".$sender_mail."';");

$msg_num = $msg_rs->num_rows;

for ($x = 0; $x < $msg_num; $x++) {
    $msg_data = $msg_rs->fetch_assoc();

    if ($msg_data["from"] == $sender_mail && $msg_data["to"] == $reciever_mail) {

//echo("Recieved");
?>
        <!-- received -->

        <div class="col-12 mt-2">
            <div class="row">
                <div class="col-8 rounded bg-success">
                    <div class="row">
                        <div class="col-12 pt-2">
                            <span class="text-white fw-bold fs-4"><?php echo ($msg_data["content"]); ?></span>
                        </div>
                        <div class="col-12 text-end pb-2">
                            <span class="text-white fs-6"><?php echo ($msg_data["date_time"]); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- received -->

    <?php

    } else if ($msg_data["to"] == $sender_mail && $msg_data["from"] == $reciever_mail) {


        //echo("send");
    ?>
        <div class="col-12 mt-2">
            <div class="row">
                <div class="offset-4 col-8 rounded bg-primary">
                    <div class="row">
                        <div class="col-12 pt-2">
                            <span class="text-white fw-bold fs-4"><?php echo ($msg_data["content"]); ?></span>
                        </div>
                        <div class="col-12 text-end pb-2">
                            <span class="text-white fs-6"><?php echo ($msg_data["date_time"]); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- sent -->
    <?php
    }
    ?>







<?php
}
?>

<?php
/*
 $msg_rs2 = Database::search("SELECT DISTINCT `content`,`date_time`,`status`,`to`,`from` 
 FROM `chat` WHERE `from`='" .$admin_email. "' AND `to`='" . $_SESSION["u"]["email"] . "'  ORDER BY `date_time` ASC");
$msg_num2 = $msg_rs2->num_rows;
for ($b = 0; $b < $msg_num2; $b++) {
    $recieved_data = $msg_rs2->fetch_assoc();
    if (!empty($recieved_data["from"])) {
        if ($recieved_data["from"] == $admin_email) {
?>


            <div class="col-12 mt-2">
                <div class="row">
                    <div class="offset-4 col-8 rounded bg-primary">
                        <div class="row">
                            <div class="col-12 pt-2">
                                <span class="text-white fw-bold fs-4"><?php echo ($recieved_data["content"]); ?></span>
                            </div>
                            <div class="col-12 text-end pb-2">
                                <span class="text-white fs-6"><?php echo ($recieved_data["date_time"]); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sent -->

<?php
        }
    }
}
/*
                                    
                                    */
?>