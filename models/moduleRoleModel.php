<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class ModuleRole
{
    function getModuleRoleAll()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM module_role";
        $result = $con->query($sql);
        return $result;
    }
    function deleteModules($role_id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM module_role WHERE role_id = '$role_id'";
        $result = $con->query($sql);
        return $result;
    }
    function addModule($role_id, $module_id)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO module_role (role_id, module_id) VALUES('$role_id', '$module_id')";
        $result = $con->query($sql);
        return $result;
    }
}
