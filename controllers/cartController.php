<?php
if (isset($_REQUEST["req"])) {
    include "../models/cartModel.php";
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
        case 'showCart':
            //Retrieve user id
            $user_id = $_SESSION['userData']['id'];
            $cartObject = new Cart();
            $result = $cartObject->getCart($user_id);

            $items = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($items, $row);
            }
            $data = base64_encode(serialize($items));
        ?>
            <script>
                window.location = "../views/showCart.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case 'addToCart':
            if (isset($_POST)) {
                //Retrieve user id
                $user_id = $_SESSION['userData']['id'];
                //Retrieve & validate data
                $product_id = $_POST['id'];

                if (preg_match("/[0-9]{1,30}/", $_POST['quantity']) == FALSE) {
                    throw new Exception("Error Processing Request");
                } else {
                    $quantity = $_POST['quantity'];
                }

                //Operate CRUD           
                $cartObject = new Cart();
                $cartObject->addToCart($user_id, $product_id, $quantity);
            ?>
                <script>
                    history.back();
                </script>
            <?php
                break;
            }

        case 'updateItem':
            if (isset($_POST)) {
                //Retrieve & validate data
                $id = $_POST['id'];

                if (preg_match("/[0-9]{1,30}/", $_POST['quantity']) == FALSE) {
                    throw new Exception("Error Processing Request");
                } else {
                    $quantity = $_POST['quantity'];
                }

                //Operate CRUD           
                $cartObject = new Cart();
                $cartObject->updateItem($id, $quantity);
            ?>
                <script>
                    window.location = "../controllers/cartController.php?req=showCart";
                </script>
            <?php
                break;
            }

        case 'deleteItem':
            $id = $_REQUEST['id'];

            //Operate CRUD           
            $cartObject = new Cart();
            $cartObject->deleteItem($id);
            ?>
            <script>
                window.location = "../controllers/cartController.php?req=showCart";
            </script>
        <?php
            break;

        case 'deleteCart':
            //Retrieve user id
            $user_id = $_SESSION['userData']['id'];

            //Operate CRUD           
            $cartObject = new Cart();
            $cartObject->deleteCart($user_id);
        ?>
            <script>
                window.location = "../controllers/cartController.php?req=showCart";
            </script>
<?php
            break;
    }
}
