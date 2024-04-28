<?php
require "connection.php";

if (isset($_GET["f"]) && isset($_GET["t"])) {
    $from = $_GET["f"];
    $to = $_GET["t"];

    $invoice_rs = Database::search("SELECT * FROM `invoice`");
    $invoice_num = $invoice_rs->num_rows;

    for ($x = 0; $x < $invoice_num; $x++) {
        $invoice_data = $invoice_rs->fetch_assoc();

        $sold_date = $invoice_data["date"];
        $date = explode(" ", $sold_date);

        $d = $date[0];
        $t = $date[1];
        
        $user_rs = Database::search("SELECT * FROM `user` WHERE email='".$invoice_data["user_email"]."' ");
        $user_data = $user_rs->fetch_assoc();
        

        if (!empty($from) && empty($to)) {
            if ($from <= $d) {
?>
                <div class="row">
                    
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-2"><?php echo ($invoice_data["id"]); ?></label>
                        </div>
                        <div class="col-3 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-black mt-2">
                                <?php
                                
                                $product_rs = Database::search("SELECT * FROM `product` WHERE id='" . $invoice_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();
                                echo ($product_data["title"]);
                                ?>
                            </label>
                        </div>
                        <div class="col-3 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-2">
                                <?php
                                echo ($user_data["fname"] . " " . $user_data["lname"]);
                                ?>
                            </label>
                        </div>
                        <div class="col-2 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-black mt-2"><?php echo ($invoice_data["total"]); ?></label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-black mt-2"><?php echo ($invoice_data["qty"]); ?></label>
                        </div>
                        <div class="col-2 bg-white d-grid">

                            <?php
                            if ($invoice_data["status"] == 0) {
                            ?>
                                <button class="btn btn-success fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Confirm Order</button>

                            <?php
                            } else if ($invoice_data["status"] == 1) {
                            ?>
                                <button class="btn btn-warning fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Packing</button>

                            <?php
                            } else if ($invoice_data["status"] == 2) {
                            ?>
                                <button class="btn btn-info fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Dispacth</button>

                            <?php
                            } else if ($invoice_data["status"] == 3) {
                            ?>
                                <button class="btn btn-primary fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Shipping</button>

                            <?php
                            } else if ($invoice_data["status"] == 4) {
                            ?>
                                <button class="btn btn-danger fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>" disabled>Delivered</button>

                            <?php
                            }
                            ?>
                        </div>
               
                </div>
<?php
            }
        } else if (empty($from) && !empty($to)) {
            if ($to >= $d) {
                ?>
                <div class="row">
                    
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-2"><?php echo ($invoice_data["id"]); ?></label>
                        </div>
                        <div class="col-3 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-black mt-2">
                                <?php
                                $product_rs = Database::search("SELECT * FROM `product` WHERE id='" . $invoice_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();
                                echo ($product_data["title"]);
                                ?>
                            </label>
                        </div>
                        <div class="col-3 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-2">
                                <?php
                                echo ($user_data["fname"] . " " . $user_data["lname"]);
                                ?>
                            </label>
                        </div>
                        <div class="col-2 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-black mt-2"><?php echo ($invoice_data["total"]); ?></label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-black mt-2"><?php echo ($invoice_data["qty"]); ?></label>
                        </div>
                        <div class="col-2 bg-white d-grid">

                            <?php
                            if ($invoice_data["status"] == 0) {
                            ?>
                                <button class="btn btn-success fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Confirm Order</button>

                            <?php
                            } else if ($invoice_data["status"] == 1) {
                            ?>
                                <button class="btn btn-warning fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Packing</button>

                            <?php
                            } else if ($invoice_data["status"] == 2) {
                            ?>
                                <button class="btn btn-info fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Dispacth</button>

                            <?php
                            } else if ($invoice_data["status"] == 3) {
                            ?>
                                <button class="btn btn-primary fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Shipping</button>

                            <?php
                            } else if ($invoice_data["status"] == 4) {
                            ?>
                                <button class="btn btn-danger fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>" disabled>Delivered</button>

                            <?php
                            }
                            ?>
                        </div>
               
                </div>
<?php
            }
        } else if (!empty($from) && !empty($to)) {
            if ($from <= $d && $to  >= $d) {
                ?>
                <div class="row">
                    
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-2"><?php echo ($invoice_data["id"]); ?></label>
                        </div>
                        <div class="col-3 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-black mt-2">
                                <?php
                                $product_rs = Database::search("SELECT * FROM `product` WHERE id='" . $invoice_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();
                                echo ($product_data["title"]);
                                ?>
                            </label>
                        </div>
                        <div class="col-3 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-white mt-2">
                                <?php
                                echo ($user_data["fname"] . " " . $user_data["lname"]);
                                ?>
                            </label>
                        </div>
                        <div class="col-2 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-black mt-2"><?php echo ($invoice_data["total"]); ?></label>
                        </div>
                        <div class="col-1 bg-secondary text-end">
                            <label class="form-label fs-5 fw-bold text-black mt-2"><?php echo ($invoice_data["qty"]); ?></label>
                        </div>
                        <div class="col-2 bg-white d-grid">

                            <?php
                            if ($invoice_data["status"] == 0) {
                            ?>
                                <button class="btn btn-success fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Confirm Order</button>

                            <?php
                            } else if ($invoice_data["status"] == 1) {
                            ?>
                                <button class="btn btn-warning fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Packing</button>

                            <?php
                            } else if ($invoice_data["status"] == 2) {
                            ?>
                                <button class="btn btn-info fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Dispacth</button>

                            <?php
                            } else if ($invoice_data["status"] == 3) {
                            ?>
                                <button class="btn btn-primary fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>">Shipping</button>

                            <?php
                            } else if ($invoice_data["status"] == 4) {
                            ?>
                                <button class="btn btn-danger fw-bold mt-1 mb-1" onclick='changeStatus("<?php echo ($invoice_data["id"]); ?>");' id="btn<?php echo ($selected_data["id"]); ?>" disabled>Delivered</button>

                            <?php
                            }
                            ?>
                        </div>
               
                </div>
<?php
            }
        }
    }
}
