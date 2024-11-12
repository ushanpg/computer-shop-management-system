<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Brand
{
    function getBrands()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM brand";
        $result = $con->query($sql);
        return $result;
    }
    function addBrand($name)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO brand (name) VALUES ('$name')";
        $result = $con->query($sql);
        return $result;
    }
    function updateBrand($id, $name)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE brand SET name = '$name' WHERE id = $id";
        $result = $con->query($sql);
        return $result;
    }
    function deleteBrand($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM brand WHERE id = $id";
        $result = $con->query($sql);
        return $result;
    }
}
