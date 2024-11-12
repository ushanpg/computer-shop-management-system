<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class User
{
    function signup($first_name, $last_name, $gender, $dob, $nic, $phone, $image)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO user(first_name, last_name, gender, dob, nic, phone, image) VALUES ('$first_name','$last_name','$gender','$dob','$nic','$phone','$image')";
        $con->query($sql);
        $user_id = $con->insert_id;  // Retrieve auto incremented id of insertion
        return $user_id;
    }
    function addUser($first_name, $last_name, $image, $role_id)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO user(first_name, last_name, image, role_id) VALUES ('$first_name','$last_name','$image','$role_id')";
        $con->query($sql);
        $user_id = $con->insert_id;  // Retrieve auto incremented id of insertion
        return $user_id;
    }
    function getUsers()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT user.id, user.first_name, user.last_name, login.email, role.name, user.status, user.image FROM user JOIN login ON user.id = login.user_id JOIN role ON user.role_id = role.id LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
    function updateStatus($id, $status)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE user SET status = '$status' WHERE user.id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function editUser($id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT login.email, user.id, user.first_name, user.last_name, user.gender, user.dob, user.nic, user.phone, user.image, user.role_id FROM user JOIN login ON login.user_id = user.id WHERE user.id = '$id'";
        $result = $con->query($sql);
        return $result;
    }
    function updateUser($id, $first_name, $last_name, $gender, $dob, $nic, $phone, $image)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE user SET first_name = '$first_name', last_name = '$last_name' ,gender = '$gender', dob = '$dob', nic = '$nic', phone = '$phone', image = '$image' WHERE id = '$id'";
        $result = $con->query($sql);
        return ($result);
    }
}
