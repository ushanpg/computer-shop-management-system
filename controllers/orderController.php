<?php
if (isset($_REQUEST["req"])) {
    include "../models/orderModel.php";
    include "../models/ordersProductModel.php";
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
        case 'order':
            $orderObject = new Order;

            $result = $orderObject->getOrders();
            $orders = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($orders, $row);
            }
            $data = base64_encode(serialize($orders));
        ?>
            <script>
                window.location = "../views/orders.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'addOrder':
        ?>
            <script>
                window.location = "deliveryController.php?req=addDelivery";
            </script>
        <?php
            break;

        case "updateOrder":
            $order_id = $_REQUEST["order_id"];
            $status = $_REQUEST["status"];

            $orderObject = new Order;
            $result = $orderObject->updateOrder($order_id, $status);
        ?>
            <script>
                window.location = "orderController.php?req=order";
            </script>
        <?php
            break;

        case 'viewOrder':
            $order_id = $_REQUEST['id'];

            $ordersProductObject = new Orders_Product();
            $result = $ordersProductObject->getItems($order_id);
            $items = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($items, $row);
            }
            $data = base64_encode(serialize($items));
        ?>
            <script>
                window.location = "../views/viewOrder.php?data=<?php echo ($data) ?>&id=<?php echo ($order_id) ?>";
            </script>
            <?php
            break;

        case "updateItem":
            if (isset($_POST)) {
                $id = $_POST["id"];
                $quantity = $_POST["quantity"];
                $order_id = $_POST["order_id"];

                $ordersProductObject = new Orders_Product();
                $result = $ordersProductObject->updateItem($id, $quantity);
            ?>
                <script>
                    window.location = "orderController.php?req=viewOrder&id=<?php echo ($order_id) ?>";
                </script>
            <?php
                break;
            }

        case 'deleteItem':
            $id = $_REQUEST["id"];
            $order_id = $_REQUEST["order_id"];

            //Operate CRUD           
            $ordersProductObject = new Orders_Product();
            $ordersProductObject->deleteItem($id);
            ?>
            <script>
                window.location = "orderController.php?req=viewOrder&id=<?php echo ($order_id) ?>";
            </script>
        <?php
            break;

        case 'deleteOrder':
            $order_id = $_REQUEST["id"];

            //Operate CRUD        
            $orderObject = new Order;
            $orderObject->deleteOrder($order_id);
        ?>
            <script>
                window.location = "orderController.php?req=order";
            </script>
        <?php
            break;

        case 'myOrder':
            $user_id = $_SESSION["userData"]['id'];
            $orderObject = new Order;

            $result = $orderObject->getOrdersByUser($user_id);
            $orders = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($orders, $row);
            }
            $data = base64_encode(serialize($orders));
        ?>
            <script>
                window.location = "../views/myOrders.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

    }
}
