<?php
if (isset($_REQUEST["req"])) {
    include "../models/inventoryModel.php";
    include "../models/productModel.php";
    include "../models/brandModel.php";
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
        case 'inventory':
            //Get brands & products data to the session
            $brandObject = new Brand();
            $result = $brandObject->getBrands();
            $brands = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($brands, $row);
            }
            $_SESSION['brands'] = $brands;

            $productObject = new Product();
            $result = $productObject->getProducts();
            $products = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($products, $row);
            }
            $_SESSION['products'] = $products;

            //Retrieve data
            $inventoryObject = new Inventory();
            $result = $inventoryObject->getStocks();
            $stocks = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($stocks, $row);
            }
            $data = base64_encode(serialize($stocks));
        ?>
            <script>
                window.location = "../views/inventory.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case 'addGRN':
            //Retrieve data
            if (isset($_POST)) {
                $product_id = $_POST['product_id'];
                $quantity = $_POST['quantity'];
                $grade = $_POST['grade'];
                $unit_cost = $_POST['unit_cost'];

                //Validate inputs
                if (preg_match("/[0-9]{1,11}/", $quantity) == FALSE) {
                    throw new Exception("Error Processing Request");
                }

                if (preg_match("/[A-Za-z0-9\s.,]{0,50}/", $_POST['note']) == FALSE) {
                    $note = NULL;
                } else {
                    $note = $_POST['note'];
                }

                //Operate CRUD           
                $inventoryObject = new Inventory();
                $inventoryObject->addStock($quantity, $product_id, $grade, $note, $unit_cost);

            ?>
                <script>
                    window.location = "inventoryController.php?req=inventory";
                    alert("The new stock is added successfully.");
                </script>
            <?php
                break;
            }

        case 'deleteStock':
            $id = $_REQUEST["id"];

            //Operate CRUD           
            $inventoryObject = new Inventory;
            $inventoryObject->deleteStock($id);
            ?>
            <script>
                window.location = "inventoryController.php?req=inventory";
            </script>
<?php
            break;
    }
}
