<?php



session_start();
require "connection.php";
if (isset($_SESSION["au"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel | eShop</title>
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body style="background-color: #74EBD5;background-image: linear-gradient(90deg,#74EBD5 0%,#9FACE6 100%);">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="col-12 align-items-start bg-dark">
                            <div class="row g-1 text-center">
                                <div class="col-12 mt-5">
                                    <h4 class="text-white"><?php echo ($_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]); ?></h4>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">
                                    <nav class="nav flex-column">
                                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                                        <a class="nav-link" href="manageUsers.php">Manage Users</a>
                                        <a class="nav-link" href="manageProduct.php">Manage Products</a>
                                    </nav>
                                </div>
                                <div class="col-12">
                                    <hr class="border border-1 border-white" />
                                    <h4 class="text-white fw-bold">Selling History</h4>
                                    <hr class="border border-1 border-white" />
                                </div>
                                <div class="col-12 mt-3 d-grid">
                                    <label class="form-label fs-6 fw-bold text-white">From Date</label>
                                    <input type="date" class="form-control" />
                                    <label class="form-label fs-6 fw-bold text-white mt-2">To Date</label>
                                    <input type="date" class="form-control" />
                                    <a href="sellingHistory.php" class="btn btn-primary mt-2">Search</a>
                                    <hr class="border border-1 border-white" />
                                    <label class="form-label fs-6 fw-bold text-white mt-2">Daily Sellings</label>
                                    <hr class="border border-1 border-white" />
                                    <hr class="border border-1 border-white" />

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-12 col-lg-10">
                    <div class="row">
                        <div class="text-white fw-bold mb-3">
                            <h2 class="fw-bold">Dashboard</h2>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12">
                            <div class="row g-1">
                                <?php

                                $today = date("Y-m-d");
                                $thismonth = date("m");
                                $thisyear = date("Y");

                                $a = "0";
                                $b = "0";
                                $c = "0";
                                $e = "0";
                                $f = "0";

                                $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                $invoice_num = $invoice_rs->num_rows;

                                for ($x = 0; $x < $invoice_num; $x++) {
                                    $invoice_data = $invoice_rs->fetch_assoc();

                                    $f += $invoice_data["qty"]; //total qty

                                    $d = $invoice_data["date"];
                                    $splitDate = explode(" ", $d); //seperate date as date ,time
                                    $pdate = $splitDate[0];

                                    if ($pdate == $today) {
                                        $a = $a + $invoice_data["total"];
                                        $c += $invoice_data["qty"];
                                    }

                                    $splitMonth = explode("-", $pdate); //separate date as year, month & date
                                    $pyear = $splitMonth[0]; //year
                                    $pmonth = $splitMonth[1]; //month

                                    if ($pyear == $thisyear) {
                                        if ($pmonth == $thismonth) {
                                            $b += $invoice_data["total"];
                                            $e += $invoice_data["qty"];
                                        }
                                    }
                                }

                                ?>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-primary text-white text-center" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Daily Earnings</span>
                                            <br />
                                            <span class="fs-5">Rs. <?php echo ($a); ?> .00</span>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-white text-black text-center" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />

                                            <span class="fs-5">Rs. <?php echo ($b); ?> .00</span>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-black text-white text-center" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo ($c); ?> Items</span>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo ($e); ?> Items</span>

                                        </div>
                                    </div>

                                </div>
                                  
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-success text-white text-center" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo ($f); ?> Items</span>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-danger text-white text-center" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-5"><?php echo ($user_num); ?> Members</span>

                                        </div>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>
                        <div class="col-12 bg-dark">
                            <div class="row">
                                <div class="row">
                                    <div class="col-12 col-lg-2 text-center my-3">
                                        <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>

                                    </div>
                                    <div class="col-12 col-lg-10 text-center my-3">
                                        <?php
                                        //Total Active Time php
                                        $start_date = new DateTime("2022-09-27 00:00:00");

                                        $tdate = new DateTime();
                                        $tz = new DateTimeZone("Asia/Colombo");
                                        $tdate->setTimezone($tz);

                                        $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                        $difference = $end_date->diff($start_date);

                                        ?>
                                        <label class="form-label fs-4 fw-bold text-warning">
                                            <?php
                                            echo ($difference->format('%Y') . " Years " .
                                                $difference->format('%m') . " Months " .
                                                $difference->format('%d') . " Days " .
                                                $difference->format('%H') . " Hours " .
                                                $difference->format('%i') . " Minutes " .
                                                $difference->format('%s') . " Seconds ");
                                            //Total Active Time php
                                            ?> </label>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
                            <div class="row g-1 ">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Mostly Sold Item</label>

                                </div>
                                <?php
                                $freq_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` 
                                   FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurrence`
                                   DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {
                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();
                                    //error qty
                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` 
                                    WHERE `product_id`='" . $freq_data["product_id"] . "' AND  `date` LIKE '%" . $today . "%'");

                                    $qty_data = $qty_rs->fetch_assoc();
                            
                                    ?>
                                    <div class="col-12 text-center">
                                        <img src="<?php echo ($image_data["code"]); ?>" class="img-fluid rounded-top" style="height:250px; margin-left:0px;" />
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="fs-5 fw-bold"><?php echo ($product_data["title"]); ?></span><br />
                                        <span class="fs-5 fw-bold"><?php echo ($qty_data["qty_total"]); ?> Items Sold</span><br />
                                        <span class="fs-5 fw-bold">Rs. <?php echo ($qty_data["qty_total"] * $product_data["price"]); ?> .00</span>

                                    </div>
                                <?php

                                } else {
                                ?>
                                    <div class="col-12 text-center">
                                        <img src="resource/empty.svg" class="img-fluid rounded-top" style="height:250px; margin-left:0px;" />
                                    </div>
                                    <div class="col-12 text-center">
                                        <span class="fs-5 fw-bold">------</span><br />
                                        <span class="fs-5 fw-bold">--- Items Sold</span><br />
                                        <span class="fs-5 fw-bold">Rs. ----- .00</span>

                                    </div>
                                <?php
                                }

                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>



                            </div>


                        </div>
                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
                            <div class="row g-1 ">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold">Mostly Famous Seller</label>

                                </div>
                                <?php
                                if ($freq_num > 0) {
                                
                                    $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='".$product_data["user_email"]."'");
                                    $profile_data = $profile_rs->fetch_assoc();

                                    $user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='".$product_data["user_email"]."'");
                                    $user_data1 = $user_rs1->fetch_assoc();
                                ?>
     
                                <div class="col-12 text-center">
                                    <img src="<?php echo($profile_data["path"]); ?>" class="img-fluid rounded-top" style="height:250px; margin-left:0px;" />
                                </div>
                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold"><?php echo($user_data1["fname"]." ".$user_data1["lname"]); ?></span><br />
                                    <span class="fs-5 fw-bold"><?php echo($user_data1["email"]); ?></span><br />
                                    <span class="fs-5 fw-bold"><?php echo($user_data1["mobile"]); ?></span>

                                </div>
                                <?php
                                } else {
                                    ?>
                                    
                                <div class="col-12 text-center">
                                    <img src="resource/male_boy_person_people_avatar_icon_159358.png" class="img-fluid rounded-top" style="height:250px; margin-left:0px;" />
                                </div>
                                <div class="col-12 text-center">
                                    <span class="fs-5 fw-bold">Sanjaya Pathirana</span><br />
                                    <span class="fs-5 fw-bold">sanjaya@gmail.com</span><br />
                                    <span class="fs-5 fw-bold">0765454333</span>

                                </div>
                                    <?php
                                }
                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>



                            </div>


                        </div>



                    </div>
                </div>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("You are not a valid user");
}
?>