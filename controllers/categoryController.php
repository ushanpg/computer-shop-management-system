<?php
if (isset($_REQUEST["req"])) {
    include "../models/categoryModel.php";
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
        case 'category':
            $catObject = new Category();
            $result = $catObject->getCategory();
            $category = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($category, $row);
            }
            $data = base64_encode(serialize($category));

            $_SESSION['category'] = $category;
        ?>
            <script>
                window.location = "../views/category.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case 'addCategory':
            if (isset($_POST)) {
                $catObject = new Category();

                //Retrieve data
                $name = strtolower($_POST['name']);
                if (preg_match("/[a-z\s]{1,50}/", $name) == FALSE) {
                    throw new Exception("Error Processing Request");
                }

                $result = $catObject->addCategory($name);
            ?>
                <script>
                    window.location = "categoryController.php?req=category";
                </script>
            <?php
                break;
            }

        case 'updateCategory':
            if (isset($_POST)) {
                $catObject = new Category();

                //Retrieve data
                $name = strtolower($_POST['name']);
                $id = $_POST['id'];

                if (preg_match("/[a-z\s]{1,50}/", $name) == FALSE) {
                    throw new Exception("Error Processing Request");
                }

                $result = $catObject->updateCategory($id, $name);
            ?>
                <script>
                    window.location = "categoryController.php?req=category";
                </script>
            <?php
                break;
            }

        case 'deleteCategory':
            $id = $_REQUEST["id"];
            $catObject = new Category();

            $result = $catObject->deleteCategory($id);
            ?>
            <script>
                window.location = "categoryController.php?req=category";
            </script>
<?php
            break;
    }
}
