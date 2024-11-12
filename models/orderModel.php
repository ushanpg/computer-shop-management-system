<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Order
{
    function getOrders()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT orders.id, orders.order_id, orders.user_id, orders.pay_with, orders.added_at, orders.status, login.email, (SELECT COUNT(*) FROM orders_product WHERE orders_product.order_id = orders.order_id), (SELECT SUM(product.price * orders_product.quantity) FROM orders_product JOIN product ON product.id = orders_product.product_id WHERE orders_product.order_id = orders.order_id) FROM orders JOIN login ON login.user_id = orders.user_id LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
    function addOrder($order_id, $user_id, $pay_with)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO orders (order_id, user_id, pay_with) VALUES ('$order_id', '$user_id', '$pay_with')";
        $result = $con->query($sql);
        return $result;
    }
    function updateOrder($order_id, $status)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE orders SET status = '$status' WHERE order_id = '$order_id'";
        $result = $con->query($sql);
        return $result;
    }
    function deleteOrder($order_id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE orders_product, orders FROM orders_product JOIN orders ON orders_product.order_id = orders.order_id WHERE orders_product.order_id = '$order_id'";
        $result = $con->query($sql);
        return $result;
    }
    function getOrdersByUser($user_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT orders.id, orders.order_id, orders.user_id, orders.pay_with, orders.added_at, orders.status, (SELECT COUNT(*) FROM orders_product WHERE orders_product.order_id = orders.order_id), (SELECT SUM(product.price * orders_product.quantity) FROM orders_product JOIN product ON product.id = orders_product.product_id WHERE orders_product.order_id = orders.order_id) FROM orders WHERE orders.user_id = $user_id LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
}
