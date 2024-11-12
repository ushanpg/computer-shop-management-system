<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Inventory
{
    function getStocks()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT stock.id, stock.quantity, stock.added_at, stock.product_id, stock.grade, stock.note, stock.unit_cost, stock.remaining, stock.status, product.name FROM stock JOIN product ON stock.product_id = product.id LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
    function addStock($quantity, $product_id, $grade, $note, $unit_cost)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO stock (quantity, product_id, grade, note, unit_cost, remaining) VALUES ('$quantity','$product_id','$grade','$note','$unit_cost','$quantity')";
        $result = $con->query($sql);
        return $result;
    }
    function getTargetStock($product_id, $quantity)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT id FROM stock WHERE product_id = '$product_id' AND remaining > '$quantity' ORDER BY added_at ASC LIMIT 1";
        $result = $con->query($sql);
        return $result;
    }
    function getStockItem($stock_id, $quantity)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE stock SET remaining = (remaining - '$quantity') WHERE id = '$stock_id'";
        $result = $con->query($sql);
        return $result;
    }
    function getProductId($id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT product_id FROM stock WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function deleteStock($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM stock WHERE id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
}
