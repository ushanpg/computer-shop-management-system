<?php
if (isset($_REQUEST["req"])) {
    include "../models/productModel.php";
    include "../models/categoryModel.php";
    include "../models/subcategoryModel.php";
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
        case 'product':
            // Retrieve categories
            $catObject = new Category();
            $result = $catObject->getCategory();
            $categories = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($categories, $row);
            }
            $_SESSION['categories'] = $categories;

            // Retrieve subcategories            
            $subcatObject = new Subcategory();
            $result = $subcatObject->getSubcategoryAll();
            $subcategories = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($subcategories, $row);
            }
            $_SESSION['subcategories'] = $subcategories;

            // Retrieve brands
            $brandObject = new Brand();
            $result = $brandObject->getBrands();
            $brands = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($brands, $row);
            }
            $_SESSION['brands'] = $brands;

            // Retrieve products
            $productObject = new Product();
            $result = $productObject->getProducts();
            $products = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($products, $row);
            }
            $data = base64_encode(serialize($products));
        ?>
            <script>
                window.location = "../views/products.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'addProduct':
        ?>
            <script>
                window.location = "../views/addProduct.php";
            </script>
            <?php
            break;

        case 'confirmAdd':
            //Retrieve data
            if (isset($_POST)) {
                $name = strtolower($_POST['name']);
                $brand_id = $_POST['brand'];

                $category = explode(".", $_POST["category"]);
                $cat_id = $category[0];
                $subcat_id = $category[1];

                $price = $_POST['price'];
                $warranty = $_POST['warranty'];

                //Validate inputs
                $productObject = new Product();
                if (preg_match("/[a-z0-9\s]{1,50}/", $name) == FALSE) {
                    throw new Exception("Error Processing Request");
                }
                if (preg_match("/[0-9]{1,50}/", $price) == FALSE) {
                    throw new Exception("Error Processing Request");
                }
                if (preg_match("/[0-9]{1,11}/", $warranty) == FALSE) {
                    throw new Exception("Error Processing Request");
                }
                //Product description
                if (isset($_POST['description'])) {
                    $description = $_POST['description'];
                    if (preg_match("/[A-Za-z0-9\s.,]{0,512}/", $description) == FALSE) {
                        throw new Exception("Error Processing Request");
                    }
                } else {
                    $description = null;
                }

                //Upload image          
                if ($_FILES["img"]["name"] != "") {
                    if ($_FILES['img']['size'] > 5242880) {
            ?>
                        <script>
                            history.back();
                            alert("The image file is too big!");
                        </script>
                    <?php
                        throw new Exception();
                    }
                    if ($_FILES['img']['size'] < 100) {
                    ?>
                        <script>
                            history.back();
                            alert("The image file is corrupt!");
                        </script>
                    <?php
                        throw new Exception();
                    }
                    $ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
                    if (($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif") != true) {
                    ?>
                        <script>
                            history.back();
                            alert("Sorry, only JPG, JPEG, PNG & GIF image files are allowed.");
                        </script>
                <?php
                        throw new Exception();
                    }

                    $image = "" . time() . "." . $ext;
                    $destination = "../images/product/$image";
                    move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
                } else {
                    $image = "default.png";
                }

                //Operate CRUD           
                $productObject->addProduct($name, $brand_id, $subcat_id, $description, $price, $warranty, $image);
                ?>
                <script>
                    window.location = "productController.php?req=product";
                    alert("The new product added successfully.");
                </script>
            <?php
            }
            break;

        case "deleteProduct":
            $id = $_REQUEST["id"];
            $productObject = new Product();
            $result = $productObject->deleteProduct($id);
            ?>
            <script>
                window.location = "productController.php?req=product";
            </script>
        <?php
            break;

        case 'editProduct':
            $id = $_REQUEST["id"];
            $productObject = new Product();
            $result = $productObject->getProductById($id)->fetch_assoc();
            $data = base64_encode(serialize($result));

        ?>
            <script>
                window.location = "../views/editProduct.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'viewProduct':
            $id = $_REQUEST["id"];
            $productObject = new Product();
            $result = $productObject->getProductById($id)->fetch_assoc();
            $data = base64_encode(serialize($result));

        ?>
            <script>
                window.location = "../views/viewProduct.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case "updateProduct":
            //Retrieve data
            if (isset($_POST)) {

                $id = $_POST["id"];
                $name = strtolower($_POST['name']);
                $brand_id = $_POST['brand'];

                $category = explode(".", $_POST["category"]);
                $cat_id = $category[0];
                $subcat_id = $category[1];

                $price = $_POST['price'];
                $warranty = $_POST['warranty'];
                $image = $_POST['currImage'];

                //Validate inputs
                $productObject = new Product();
                if (preg_match("/[a-z0-9\s]{1,50}/", $name) == FALSE) {
                    throw new Exception("Error Processing Request");
                }
                if (preg_match("/[0-9]{1,50}/", $price) == FALSE) {
                    throw new Exception("Error Processing Request");
                }
                if (preg_match("/[0-9]{1,11}/", $warranty) == FALSE) {
                    throw new Exception("Error Processing Request");
                }
                //Product description
                if (isset($_POST['description'])) {
                    $description = $_POST['description'];
                    if (preg_match("/[A-Za-z0-9\s.,]{0,512}/", $description) == FALSE) {
                        throw new Exception("Error Processing Request");
                    }
                } else {
                    $description = null;
                }

                //Upload image          
                if ($_FILES["img"]["name"] != "") {
                    if ($_FILES['img']['size'] > 5242880) {
            ?>
                        <script>
                            history.back();
                            alert("The image file is too big!");
                        </script>
                    <?php
                        throw new Exception();
                    }
                    if ($_FILES['img']['size'] < 100) {
                    ?>
                        <script>
                            history.back();
                            alert("The image file is corrupt!");
                        </script>
                    <?php
                        throw new Exception();
                    }
                    $ext = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
                    if (($ext == "jpg" || $ext == "png" || $ext == "jpeg" || $ext == "gif") != true) {
                    ?>
                        <script>
                            alert("Sorry, only JPG, JPEG, PNG & GIF image files are allowed.");
                            history.back();
                        </script>
                <?php
                        throw new Exception();
                    }

                    $image = "" . time() . "." . $ext;
                    $destination = "../images/product/$image";
                    move_uploaded_file($_FILES["img"]["tmp_name"], $destination);
                }

                // Operate CRUD           
                $productObject->updateProduct($id, $name, $brand_id, $subcat_id, $description, $price, $warranty, $image);
                ?>
                <script>
                    window.location = "productController.php?req=product";
                </script>
            <?php
                break;
            }

        case 'filterSort':
            //Retrieve & validate data
            $category = explode(".", $_POST["category"]);
            if (isset($category[1])) {
                $cat_id = $category[0];
                $subcat_id = $category[1];
            } else {
                $cat_id = $category[0];
                $subcat_id = 0;
            }
            $brand_id = 0;
            $sort = $_POST["sort"];

            if (preg_match("/[A-Za-z0-9\s]{1,50}/", $_POST["search"]) == FALSE) {
                $search = 0;
            } else {
                $search = $_POST["search"];
            }

            // Operate CRUD
            $productObject = new Product();
            $result = $productObject->filterSort($cat_id, $subcat_id, $brand_id, $sort, $search);

            $products = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($products, $row);
            }
            $data = base64_encode(serialize($products));
            ?>
            <script>
                window.location = "../views/products.php?data=<?php echo ($data) ?>";
            </script>
<?php
            break;
    }
}
