<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Subcategory
{
    function getSubcategory($cat_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM subcategory WHERE cat_id = $cat_id";
        $result = $con->query($sql);
        return $result;
    }
    function getSubcategoryAll()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM subcategory";
        $result = $con->query($sql);
        return $result;
    }
    function addSubcategory($name, $cat_id)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO subcategory (name, cat_id) VALUES ('$name', '$cat_id')";
        $result = $con->query($sql);
        return $result;
    }
    function updateSubcategory($id, $name, $cat_id)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE subcategory SET name = '$name', cat_id = '$cat_id' WHERE id = $id";
        $result = $con->query($sql);
        return $result;
    }
    function deleteSubcategory($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM subcategory WHERE id = $id";
        $result = $con->query($sql);
        return $result;
    }
}
