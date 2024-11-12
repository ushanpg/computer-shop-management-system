<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Payment
{
    function getPayments()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT payment.id, payment.order_id, payment.amount, payment.method, payment.card_no, payment.added_at, payment.status, (SELECT orders.user_id FROM orders WHERE orders.order_id = payment.order_id), (SELECT login.email FROM login JOIN orders ON orders.user_id = login.user_id WHERE orders.order_id = payment.order_id) FROM payment LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
    function getPaymentByOrder($order_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT payment.id, payment.order_id, payment.amount, payment.method, payment.card_no, payment.added_at, payment.status FROM payment WHERE payment.order_id = '$order_id'";
        $result = $con->query($sql);
        return $result;
    }
    function addPayment($order_id, $amount, $method, $card_no, $status)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO payment (order_id, amount, method, card_no, status ) VALUES ('$order_id', '$amount', '$method', '$card_no', '$status')";
        $result = $con->query($sql);
        return $result;
    }
    function updatePayment($id, $status)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE payment SET status = '$status' WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function updateStatus($order_id, $status)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE payment SET status = '$status' WHERE order_id = '$order_id'";
        $result = $con->query($sql);
        return $result;
    }
    function deletePayment($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM payment WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
}
