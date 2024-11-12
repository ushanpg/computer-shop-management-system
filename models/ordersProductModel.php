<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Orders_Product
{
    function getItems($order_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT orders_product.id, orders_product.order_id, orders_product.product_id, orders_product.quantity, orders_product.unit_price, product.name, product.image, (SELECT SUM(stock.remaining) FROM stock WHERE stock.product_id = product.id) FROM orders_product JOIN product ON orders_product.product_id = product.id WHERE orders_product.order_id = '$order_id'";
        $result = $con->query($sql);
        return $result;
    }
    function addItem($order_id, $product_id, $quantity, $stock_id)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO orders_product (order_id, product_id, quantity, unit_price, stock_id) VALUES ('$order_id', '$product_id', '$quantity', (SELECT price FROM product WHERE id = '$product_id'),'$stock_id')";
        $result = $con->query($sql);
        return $result;
    }
    function updateItem($id, $quantity)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE orders_product SET quantity = '$quantity' WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function deleteItem($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM orders_product WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
}
