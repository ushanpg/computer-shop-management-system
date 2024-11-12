<?php
if (isset($_REQUEST["req"])) {
    include "../models/deliveryModel.php";
    include "../models/paymentModel.php";
    include "../services/session.php";
    $req = $_REQUEST["req"];

    if (!isset($_SESSION['userData'])) {
?>
        <script>
            window.location = "authController.php?req=login";
        </script>
        <?php
        throw new Exception("Error Processing Request", 1);
    }

    switch ($req) {
        case 'delivery':
            $deliveryObject = new Delivery;

            $result = $deliveryObject->getDelivery();
            $deliveries = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($deliveries, $row);
            }
            $data = base64_encode(serialize($deliveries));
        ?>
            <script>
                window.location = "../views/delivery.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case "updateDelivery":
            if (isset($_POST)) {
                //Retrieve data
                $id = $_POST["id"];
                $first_name = $_POST['first_name'];
                $last_name =  $_POST['last_name'];
                $address =  $_POST['address'];
                $city = $_POST['city'];
                $status = $_POST["status"];

                //Operate CRUD
                $deliveryObject = new Delivery;
                $result = $deliveryObject->updateDelivery($id, $first_name, $last_name, $address, $city, $status);
            ?>
                <script>
                    window.location = "deliveryController.php?req=delivery";
                </script>
            <?php
                break;
            }

        case 'deliveryTracker':
            ?>
            <script>
                window.location = "../views/trackDelivery.php";
            </script>
        <?php
            break;

        case "trackDelivery":
            if (isset($_POST["order_id"])) {
                $order_id = $_POST["order_id"];
            } else {
                $order_id = $_REQUEST["order_id"];
            }

            $deliveryObject = new Delivery;
            $result = $deliveryObject->trackDelivery($order_id)->fetch_assoc();
            $data = base64_encode(serialize($result));
        ?>
            <script>
                window.location = "../views/trackDelivery.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'deliveryUpdater':
        ?>
            <script>
                window.location = "../views/updateDelivery.php";
            </script>
            <?php
            break;

        case 'updateStatus':
            if (isset($_POST)) {
                //Retrieve data
                $order_id = $_POST["order_id"];
                $status = $_POST["status"];

                $deliveryObject = new Delivery;
                $result = $deliveryObject->updateStatus($order_id, $status);
                if ($status == "Delivered") {
                    $status = "Collected";
                    $paymentObject = new Payment;
                    $result = $paymentObject->updateStatus($order_id, $status);
                }
            ?>
                <script>
                    alert("The delivery status has updated successfully!");
                    history.back();
                </script>
            <?php
                break;
            }

        case 'deleteDelivery':
            $id = $_REQUEST["id"];

            //Operate CRUD           
            $deliveryObject = new Delivery;
            $deliveryObject->deleteDelivery($id);
            ?>
            <script>
                window.location = "deliveryController.php?req=delivery";
            </script>
<?php
            break;
    }
}
