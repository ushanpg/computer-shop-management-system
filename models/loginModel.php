<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Login
{
    function checkEmail($email)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT COUNT(*) FROM login WHERE email = '$email'";
        $result = $con->query($sql);
        return $result;
    }
    function addLogin($email, $password, $user_id)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO login(email, password, user_id) VALUES ('$email','$password','$user_id')";
        $result = $con->query($sql);
        return $result;
    }
    function loginUser($email, $password)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT user.id, login.email, login.password, user.first_name, user.last_name, user.gender, user.dob, user.nic, user.phone, user.image, user.role_id, user.status FROM login JOIN user ON login.user_id = user.id WHERE login.email = '$email' AND login.password = '$password'";
        $result = $con->query($sql);
        return $result;
    }
    function
    updatePassword($user_id, $password)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE login SET password = '$password' WHERE user_id = '$user_id'";
        $result = $con->query($sql);
        return ($result);
    }
}
