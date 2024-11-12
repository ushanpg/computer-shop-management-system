<?php
if (isset($_REQUEST["req"])) {
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
        case 'payment':
            $paymentObject = new Payment();

            $result = $paymentObject->getPayments();
            $payments = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($payments, $row);
            }
            $data = base64_encode(serialize($payments));
        ?>
            <script>
                window.location = "../views/payments.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'notify':
            $merchant_id         = $_POST['merchant_id'];
            $order_id            = $_POST['order_id'];
            $payhere_amount      = $_POST['payhere_amount'];
            $payhere_currency    = $_POST['payhere_currency'];
            $status_code         = $_POST['status_code'];
            $md5sig              = $_POST['md5sig'];
            $method              = $_POST['method'];
            $status_message      = $_POST['status_message'];
            $card_holder_name    = $_POST['card_holder_name'];
            $card_no             = $_POST['card_no'];
            $card_expiry         = $_POST['card_expiry'];

            $merchant_secret = 'OTMyOTQ4NTAxODE4MDcxODYxMzk2NTk1OTE1MTU1NTQ1MzE3MA=='; // Replace with your Merchant Secret

            $local_md5sig = strtoupper(
                md5(
                    $merchant_id .
                        $order_id .
                        $payhere_amount .
                        $payhere_currency .
                        $status_code .
                        strtoupper(md5($merchant_secret))
                )
            );

            if (($local_md5sig === $md5sig) and ($status_code == 2)) {
                //TODO: Update your database as payment success

                $paymentObject = new Payment();
                $status = "Success";
                $result = $paymentObject->addPayment($order_id, $amount, $method, $card_no, $status);
            }
            break;

        case "updatePayment":
            $id = $_POST["id"];
            $status = $_POST["status"];

            //Operate CRUD           
            $paymentObject = new Payment;
            $result = $paymentObject->updatePayment($id, $status);
        ?>
            <script>
                window.location = "paymentController.php?req=payment";
            </script>
        <?php
            break;

        case 'deletePayment':
            $id = $_REQUEST["id"];

            //Operate CRUD           
            $paymentObject = new Payment;
            $paymentObject->deletePayment($id);
        ?>
            <script>
                window.location = "paymentController.php?req=payment";
            </script>
<?php
            break;
    }
}
