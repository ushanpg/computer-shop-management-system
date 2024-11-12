<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Role
{
    function getRoleByUser($user_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT role.id, role.name, role.status FROM role JOIN user ON user.role_id = role.id WHERE user.id = '$user_id' ";
        $result = $con->query($sql);
        return $result;
    }
    function getRoles()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM role";
        $result = $con->query($sql);
        return $result;
    }
}
