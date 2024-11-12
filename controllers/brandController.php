<?php
if (isset($_REQUEST["req"])) {
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
        case 'brand':
            $brandObject = new Brand();
            $result = $brandObject->getBrands();
            $brands = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($brands, $row);
            }
            $data = base64_encode(serialize($brands));
        ?>
            <script>
                window.location = "../views/brands.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case 'addBrand':
            if (isset($_POST)) {
                $brandObject = new Brand();

                //Retrieve data
                $name = strtolower($_POST['name']);
                if (preg_match("/[a-z\s]{1,50}/", $name) == FALSE) {
                    throw new Exception("Error Processing Request");
                }

                $result = $brandObject->addBrand($name);
            ?>
                <script>
                    window.location = "brandController.php?req=brand";
                </script>
            <?php
                break;
            }

        case 'updateBrand':
            if (isset($_POST)) {
                $brandObject = new Brand();

                //Retrieve data
                $name = strtolower($_POST['name']);
                $id = $_POST['id'];

                if (preg_match("/[a-z\s]{1,50}/", $name) == FALSE) {
                    throw new Exception("Error Processing Request");
                }

                $result = $brandObject->updateBrand($id, $name);
            ?>
                <script>
                    window.location = "brandController.php?req=brand";
                </script>
            <?php
                break;
            }

        case 'deleteBrand':
            $id = $_REQUEST["id"];
            $brandObject = new Brand();

            $result = $brandObject->deleteBrand($id);
            ?>
            <script>
                window.location = "brandController.php?req=brand";
            </script>
<?php
            break;
    }
}
