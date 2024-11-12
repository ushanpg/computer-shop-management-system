<?php
if (isset($_REQUEST["req"])) {
    include "../models/productModel.php";
    include "../models/categoryModel.php";
    include "../models/subcategoryModel.php";
    include "../models/brandModel.php";
    include "../services/session.php";
    $req = $_REQUEST["req"];

    switch ($req) {
        case 'catalog':
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
                window.location = "../views/catalog.php?data=<?php echo ($data) ?>";
            </script>
        <?php
            break;

        case 'browseCatalog':
            $cat_id = $subcat_id = $brand_id = $sort = $search = 0;

            //Browse through catalog
            if (isset($_REQUEST['category'])) {
                $cat_id = $_REQUEST['category'];
            }

            if (isset($_REQUEST['subcategory'])) {
                $subcat_id = $_REQUEST['subcategory'];
            }

            if (isset($_REQUEST['brand'])) {
                $brand_id = $_REQUEST['brand'];
            }

            //Operate CRUD
            $productObject = new Product();
            $result = $productObject->filterSort($cat_id, $subcat_id, $brand_id, $sort, $search);

            $products = [];
            while ($row = mysqli_fetch_row($result)) {
                array_push($products, $row);
            }
            $data = base64_encode(serialize($products));
        ?>
            <script>
                window.location = "../views/catalog.php?data=<?php echo ($data) ?>";
            </script>
            <?php
            break;

        case 'filterSort':
            if (isset($_POST)) {
                //Retrieve & validate data
                $category = explode(".", $_POST["category"]);
                if (isset($category[1])) {
                    $cat_id = $category[0];
                    $subcat_id = $category[1];
                } else {
                    $cat_id = $category[0];
                    $subcat_id = 0;
                }

                $brand_id = $_POST["brand"];
                $sort = $_POST["sort"];

                if (preg_match("/[A-Za-z0-9\s]{1,50}/", $_POST["search"]) == FALSE) {
                    $search = 0;
                } else {
                    $search = $_POST["search"];
                }

                //Operate CRUD
                $productObject = new Product();
                $result = $productObject->filterSort($cat_id, $subcat_id, $brand_id, $sort, $search);

                $products = [];
                while ($row = mysqli_fetch_row($result)) {
                    array_push($products, $row);
                }
                $data = base64_encode(serialize($products));
            ?>
                <script>
                    window.location = "../views/catalog.php?data=<?php echo ($data) ?>";
                </script>
<?php
                break;
            }
    }
}
