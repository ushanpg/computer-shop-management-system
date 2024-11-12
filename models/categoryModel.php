<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Category
{
    function getCategory()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM category";
        $result = $con->query($sql);
        return $result;
    }
    function addCategory($name)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO category (name) VALUES ('$name')";
        $result = $con->query($sql);
        return $result;
    }
    function updateCategory($id, $name)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE category SET name = '$name' WHERE id = $id";
        $result = $con->query($sql);
        return $result;
    }
    function deleteCategory($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM category WHERE id = $id";
        $result = $con->query($sql);
        return $result;
    }
}
