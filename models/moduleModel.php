<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Module
{
    function getModulesByUser($role_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT module.id, module.name, module.image, module.url, module.status FROM module JOIN module_role ON module_role.module_id = module.id  WHERE role_id ='$role_id' ORDER BY module_role.module_id";
        $result = $con->query($sql);
        return $result;
    }
    function getModulesAll()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT * FROM module";
        $result = $con->query($sql);
        return $result;
    }
}
