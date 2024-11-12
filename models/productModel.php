<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Product
{
    function getProducts()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT product.id, product.name, product.brand_id, (SELECT cat_id FROM subcategory WHERE subcategory.id = product.subcat_id), product.subcat_id, product.price, product.warranty, product.image, (SELECT SUM(stock.remaining) FROM stock WHERE stock.product_id = product.id), (SELECT MAX(stock.added_at) FROM stock WHERE stock.product_id = product.id), product.status, product.description FROM product LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
    function addProduct($name, $brand_id, $subcat_id, $description, $price, $warranty, $image)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO product (name, brand_id, subcat_id, description, price, warranty, image) VALUES ('$name','$brand_id','$subcat_id','$description','$price','$warranty','$image')";
        $result = $con->query($sql);
        return $result;
    }
    function getProductById($id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT product.id, product.name, product.brand_id, (SELECT cat_id FROM subcategory WHERE subcategory.id = product.subcat_id), product.subcat_id, product.price, product.warranty, product.image, (SELECT SUM(stock.remaining) FROM stock WHERE stock.product_id = product.id) AS in_stock, (SELECT MAX(stock.added_at) FROM stock WHERE stock.product_id = product.id), product.status, product.description FROM product WHERE product.id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function updateProduct($id, $name, $brand_id, $subcat_id, $description, $price, $warranty, $image)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE product SET name = '$name', brand_id = '$brand_id' ,subcat_id = '$subcat_id', description = '$description', price = '$price',  warranty = '$warranty', image = '$image' WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function deleteProduct($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM product WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function filterSort($cat_id, $subcat_id, $brand_id, $sort, $search)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT product.id, product.name, product.brand_id, (SELECT cat_id FROM subcategory WHERE subcategory.id = product.subcat_id), product.subcat_id, product.price, product.warranty, product.image, (SELECT SUM(stock.remaining) FROM stock WHERE stock.product_id = product.id), (SELECT MAX(stock.added_at) FROM stock WHERE stock.product_id = product.id), product.status, product.description FROM product WHERE product.id > 0";
        if ($cat_id != 0) {
            $sql = $sql . " AND (SELECT cat_id FROM subcategory WHERE subcategory.id = product.subcat_id) = '$cat_id'";
        }
        if ($subcat_id != 0) {
            $sql = $sql . " AND product.subcat_id ='$subcat_id'";
        }
        if ($brand_id != 0) {
            $sql = $sql . " AND product.brand_id ='$brand_id'";
        }
        if ($search != 0) {
            $sql = $sql . " AND product.id LIKE '%$search%' OR product.name LIKE '%$search%' OR product.price LIKE '%$search%' OR product.warranty LIKE '%$search%'";
        }
        if ($sort != 0) {
            if ($sort == 1) {
                $sql = $sql . " ORDER BY product.id DESC";
            }elseif ($sort == 2) {
                $sql = $sql . " ORDER BY product.price ASC";
            }elseif ($sort == 3) {
                $sql = $sql . " ORDER BY product.price DESC";
            }
        }
        $sql = $sql . " LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
}
