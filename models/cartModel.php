<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Cart
{
    function getCart($user_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT cart.id, cart.user_id, cart.product_id, cart.quantity, cart.updated_at, cart.status, product.name, product.image, product.price, (SELECT SUM(stock.remaining) FROM stock WHERE stock.product_id = product.id) FROM cart JOIN product ON product.id = cart.product_id WHERE cart.user_id = '$user_id'";
        $result = $con->query($sql);
        return $result;
    }
    function addToCart($user_id, $product_id, $quantity)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', '$quantity')";
        $result = $con->query($sql);
        return $result;
    }
    function updateItem($id, $quantity)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE cart SET quantity = '$quantity' WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function deleteItem($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM cart WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function deleteCart($user_id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM cart WHERE user_id = '$user_id'";
        $result = $con->query($sql);
        return $result;
    }
    function countCart($user_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT COUNT(*) FROM cart WHERE user_id = '$user_id'";
        $result = $con->query($sql);
        return $result;
    }
}
