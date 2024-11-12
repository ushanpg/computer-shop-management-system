<?php
if (isset($_REQUEST["req"])) {
    include "../reports/invoice.php";
    include "../models/inventoryModel.php";
    include "../models/cartModel.php";
    include "../models/orderModel.php";
    include "../models/ordersProductModel.php";
    include "../models/paymentModel.php";
    include "../models/deliveryModel.php";
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
        case 'checkout':
            if (isset($_POST)) {
                //Generate an order id
                $order_id = time();

                //Retrieve inputs
                $first_name     = $_POST['first_name'];
                $last_name      = $_POST['last_name'];
                $email          = $_POST['email'];
                $address        = $_POST['address'];
                $city           = $_POST['city'];
                $phone          = $_POST['phone'];
                $items          = $_POST["items"];
                $amount         = $_POST["amount"];
                $pay_with       = $_POST['pay_with'];

                //Validate inputs
                if (preg_match("/[A-Za-z.\s]{1,50}/", $first_name) == FALSE) {
                    throw new Exception("Error Processing Request", 1);
                }
                if (preg_match("/[A-Za-z.\s]{1,50}/", $last_name) == FALSE) {
                    throw new Exception("Error Processing Request", 1);
                }
                if (preg_match("/[A-Za-z0-9,.\s]{3,50}/", $address) == FALSE) {
                    throw new Exception("Error Processing Request", 1);
                }
                if (preg_match("/[A-Za-z.\s]{1,50}/", $city) == FALSE) {
                    throw new Exception("Error Processing Request", 1);
                }

                $_SESSION['currOrder'] = array("order_id" => $order_id, "first_name" => $first_name, "last_name" => $last_name, "email" => $email, "address" => $address, "city" => $city, "phone" => $phone, "items" => $items, "amount" => $amount, "pay_with" => $pay_with);

                //Switch based on payment type
                if ($pay_with == "Online") {

                    //Generate payhere hash
                    $merchant_id = "1226535";
                    $currency = "LKR";
                    $merchant_secret = "OTMyOTQ4NTAxODE4MDcxODYxMzk2NTk1OTE1MTU1NTQ1MzE3MA==";
                    $hash = strtoupper(
                        md5(
                            $merchant_id .
                                $order_id .
                                number_format($amount, 2, '.', '') .
                                $currency .
                                strtoupper(md5($merchant_secret))
                        )
                    );

                    $data = base64_encode(
                        serialize(
                            array("order_id" => $order_id, "merchant_id" => $merchant_id, "items" => $items, "amount" => $amount, "currency" => $currency, "hash" => $hash, "first_name" => $first_name, "last_name" => $last_name, "email" => $email, "address" => $address, "city" => $city, "phone" => $phone)
                        )
                    );
        ?>
                    <script>
                        window.location = "../views/payOnline.php?data=<?php echo ($data) ?>";
                    </script>
                <?php
                    break;
                } elseif ($pay_with == "COD") {
                ?>
                    <script>
                        window.location = "checkoutController.php?req=return";
                    </script>
            <?php
                    break;
                }
            }

        case 'return':
            //Retrieve user id
            $user_id = $_SESSION['userData']['id'];

            //Get cart items
            $cartObject = new Cart();
            $result = $cartObject->getCart($user_id);

            $items = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($items, $row);
            }

            //Add new order
            $orderObject = new Order();
            $order_id = $_SESSION['currOrder']['order_id'];
            $pay_with = $_SESSION['currOrder']['pay_with'];
            $result = $orderObject->addOrder($order_id, $user_id, $pay_with);
            $ordersProductObject = new Orders_Product();
            foreach ($items as $item) {
                $product_id = $item[2];
                $quantity = $item[3];

                //Update inventory
                $inventoryObject = new Inventory();
                $result = $inventoryObject->getTargetStock($product_id, $quantity)->fetch_assoc();
                $stock_id = $result['id'];
                $result = $inventoryObject->getStockItem($stock_id, $quantity);
                //Add item to order
                $result = $ordersProductObject->addItem($order_id, $product_id, $quantity, $stock_id);
            }

            //Process delivery
            $deliveryObject = new Delivery();
            $order_id       = $_SESSION['currOrder']['order_id'];
            $first_name     = $_SESSION['currOrder']['first_name'];
            $last_name      = $_SESSION['currOrder']['last_name'];
            $address        = $_SESSION['currOrder']['address'];
            $city           = $_SESSION['currOrder']['city'];

            $result = $deliveryObject->addDelivery($order_id, $first_name, $last_name, $address, $city);

            //Update payment data
            if ($_SESSION['currOrder']['pay_with'] == "COD" or strstr($_SERVER['HTTP_HOST'], 'localhost') != NULL) {
                $paymentObject = new Payment();
                $order_id = $_SESSION['currOrder']['order_id'];
                $amount = $_SESSION['currOrder']['amount'];
                $method = $_SESSION['currOrder']['pay_with'];
                $card_no = 0;
                $status = "TBC";
                $result = $paymentObject->addPayment($order_id, $amount, $method, $card_no, $status);
            }

            //Generate user prompt
            $msg = "Hi! " . $_SESSION['currOrder']['first_name'] . ", Ur new order has accepted. Order ID is " . $_SESSION['currOrder']['order_id'] . ". Total Price is LKR " . $_SESSION['currOrder']['amount'] . "/- &" . " Payment mode is " . $_SESSION['currOrder']['pay_with'] . ". Keep the Order ID safe with you for delivery tracking purposes. Also U may download the order reciept below.";
            $title = "Success!";
            $btn1 = array("name" => "Download!", "action" => "..\controllers\checkoutController.php?req=genInvoice&id=" . $order_id);
            $data = base64_encode(serialize(array("title" => $title, "msg" => $msg, "btn1" => $btn1)));

            //Reset shopping cart         
            $cartObject = new Cart();
            $cartObject->deleteCart($user_id);

            $_SESSION['currOrder'] = NULL;

            ?>
            <script>
                window.location = "../views/prompt.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'genInvoice':
            $order_id = $_REQUEST['id'];

            $ordersProductObject = new Orders_Product();
            $result = $ordersProductObject->getItems($order_id);
            $items = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($items, $row);
            }
            $paymentObject = new Payment();
            $payment = $paymentObject->getPaymentByOrder($order_id)->fetch_assoc();
            $invoice = new Invoice();
            $result = $invoice->generate($order_id, $items, $payment);
            break;

        case 'cancel':
            $_SESSION['currOrder'] = NULL;
        ?>
            <script>
                window.location = "../index.php";
                alert("Operation failed. Please try again later.")
            </script>
<?php
            break;
    }
}
