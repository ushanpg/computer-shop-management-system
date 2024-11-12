<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Delivery
{
    function getDelivery()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT delivery.id, delivery.order_id, delivery.first_name, delivery.last_name, delivery.address, delivery.city, delivery.added_at, delivery.status, orders.pay_with FROM delivery JOIN orders ON orders.order_id = delivery.order_id LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
    function addDelivery($order_id, $first_name, $last_name, $address, $city)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO delivery (order_id, first_name, last_name, address, city) VALUES ('$order_id', '$first_name', '$last_name', '$address', '$city')";
        $result = $con->query($sql);
        return $result;
    }
    function updateDelivery($id, $first_name, $last_name, $address, $city, $status)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE delivery SET first_name = '$first_name', last_name = '$last_name', address = '$address', city = '$city', status = '$status' WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function trackDelivery($order_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT delivery.id, delivery.order_id, delivery.first_name, delivery.last_name, delivery.address, delivery.city, delivery.added_at, delivery.status, orders.pay_with FROM delivery JOIN orders ON orders.order_id = delivery.order_id WHERE delivery.order_id = '$order_id'";
        $result = $con->query($sql);
        return $result;
    }
    function updateStatus($order_id, $status)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE delivery SET status = '$status' WHERE order_id = '$order_id'";
        $result = $con->query($sql);
        return $result;
    }
    function deleteDelivery($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM delivery WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
}
