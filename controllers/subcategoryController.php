<?php
if (isset($_REQUEST["req"])) {
    include "../models/subcategoryModel.php";
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
        case 'subcategory':
            $cat_id = $_REQUEST["cat_id"];
            $subcatObject = new Subcategory();

            $result = $subcatObject->getSubcategory($cat_id);
            $subcategory = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($subcategory, $row);
            }

            $data = base64_encode(serialize($subcategory));
        ?>
            <script>
                window.location = "../views/subcategory.php?data=<?php echo ($data) ?>&cat_id=<?php echo ($cat_id) ?>";
            </script>
            <?php
            break;

        case 'addSubcategory':
            if (isset($_POST)) {
                $subcatObject = new Subcategory();

                //Retrieve data
                $name = strtolower($_POST['name']);
                $cat_id = $_POST['cat_id'];

                if (preg_match("/[a-z\s]{1,50}/", $name) == FALSE) {
                    throw new Exception("Error Processing Request");
                }

                $result = $subcatObject->addSubcategory($name, $cat_id);
            ?>
                <script>
                    window.location = "subcategoryController.php?req=subcategory&cat_id=<?php echo ($cat_id) ?>";
                </script>
            <?php
                break;
            }

        case 'updateSubcategory':
            if (isset($_POST)) {
                $subcatObject = new Subcategory();

                //Retrieve data
                $id = $_POST['id'];
                $name = strtolower($_POST['name']);
                $cat_id = $_POST['cat_id'];

                if (preg_match("/[a-z\s]{1,50}/", $name) == FALSE) {
                    throw new Exception("Error Processing Request");
                }

                $result = $subcatObject->updateSubcategory($id, $name, $cat_id);
            ?>
                <script>
                    window.location = "subcategoryController.php?req=subcategory&cat_id=<?php echo ($cat_id) ?>";
                </script>
            <?php
                break;
            }

        case 'deleteSubcategory':
            $id = $_REQUEST["id"];
            $subcatObject = new Subcategory();

            $result = $subcatObject->deleteSubcategory($id);
            ?>
            <script>
                window.location = "categoryController.php?req=category";
            </script>
<?php
            break;
    }
}
