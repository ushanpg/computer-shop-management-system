<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Report
{
    function salesReport($start, $end)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT orders.id, orders.order_id, orders.user_id, orders.pay_with, orders.added_at, orders.status, login.email, (SELECT COUNT(*) FROM orders_product WHERE orders_product.order_id = orders.order_id), (SELECT SUM(orders_product.unit_price * orders_product.quantity) FROM orders_product JOIN product ON product.id = orders_product.product_id WHERE orders_product.order_id = orders.order_id) FROM orders JOIN login ON login.user_id = orders.user_id WHERE orders.added_at BETWEEN '$start' AND '$end'";
        $result = $con->query($sql);
        return $result;
    }
    function mostSellingReport($start, $end)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT product.id, product.name, (SELECT name FROM subcategory WHERE subcategory.id = product.subcat_id), (SELECT name FROM brand WHERE brand.id = product.brand_id), (SELECT COUNT(*) FROM orders_product JOIN orders ON orders.order_id = orders_product.order_id WHERE orders_product.product_id = product.id AND orders.added_at BETWEEN '$start' AND '$end'), (SELECT SUM(orders_product.quantity) FROM orders_product JOIN orders ON orders.order_id = orders_product.order_id WHERE orders_product.product_id = product.id AND orders.added_at BETWEEN '$start' AND '$end') AS quantity, (SELECT SUM(orders_product.unit_price * orders_product.quantity) FROM orders_product JOIN orders ON orders.order_id = orders_product.order_id WHERE orders_product.product_id = product.id AND orders.added_at BETWEEN '$start' AND '$end') FROM product ORDER BY quantity DESC LIMIT 50";
        $result = $con->query($sql);
        return $result;
    }
    function stockReport($start, $end)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT stock.id, stock.product_id, product.name, stock.quantity, stock.grade, stock.added_at, stock.unit_cost, stock.remaining FROM stock JOIN product ON stock.product_id = product.id WHERE stock.added_at BETWEEN '$start' AND '$end'";
        $result = $con->query($sql);
        return $result;
    }
    function customerReport($start, $end)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT user.id, (SELECT email FROM login WHERE login.user_id = user.id), user.first_name, user.last_name, (SELECT COUNT(*) FROM orders WHERE orders.user_id = user.id AND orders.added_at BETWEEN '$start' AND '$end') AS count, (SELECT SUM(orders_product.quantity) FROM orders JOIN orders_product ON orders_product.order_id = orders.order_id WHERE orders.user_id = user.id AND orders.added_at BETWEEN '$start' AND '$end'), (SELECT SUM(orders_product.unit_price * orders_product.quantity) FROM orders JOIN orders_product ON orders_product.order_id = orders.order_id WHERE orders.user_id = user.id AND orders.added_at BETWEEN '$start' AND '$end') FROM user ORDER BY count DESC";
        $result = $con->query($sql);
        return $result;
    }
    function profitLossReport($start, $end)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT product.id, product.name, (SELECT SUM(orders_product.quantity) FROM orders_product JOIN orders ON orders.order_id = orders_product.order_id WHERE orders_product.product_id = product.id AND orders.added_at BETWEEN '$start' AND '$end'), (SELECT SUM(orders_product.unit_price * orders_product.quantity) FROM orders_product JOIN orders ON orders.order_id = orders_product.order_id WHERE orders_product.product_id = product.id AND orders.added_at BETWEEN '$start' AND '$end') AS revenue, (SELECT SUM((SELECT unit_cost FROM stock WHERE stock.id = orders_product.stock_id) * orders_product.quantity) FROM orders_product JOIN orders ON orders.order_id = orders_product.order_id WHERE orders_product.product_id = product.id AND orders.added_at BETWEEN '$start' AND '$end') FROM product ORDER BY revenue DESC";
        $result = $con->query($sql);
        return $result;
    }
    function barChartData($start, $end)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT DISTINCT status as category, (SELECT COUNT(*) FROM delivery WHERE status = category) AS value FROM delivery WHERE added_at BETWEEN '$start' AND '$end' ORDER BY value DESC";
        $result = $con->query($sql);
        return $result;
    }
    function pieChartData($start, $end)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT DISTINCT status as category, (SELECT COUNT(*) FROM orders WHERE status = category) AS value FROM orders WHERE added_at BETWEEN '$start' AND '$end'";
        $result = $con->query($sql);
        return $result;
    }
}
