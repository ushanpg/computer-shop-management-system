<?php

include_once("../services/dbConnection.php");
$dbObject = new dbConnection();
class Support
{
    function getTokens()
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT support.id, support.token_no, support.user_id, support.type, support.description, support.fee, support.added_at, support.status, login.email FROM support JOIN login ON login.user_id = support.user_id LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
    function addToken($token_no, $user_id, $type, $description)
    {
        $con = $GLOBALS['con'];
        $sql = "INSERT INTO support (token_no, user_id, type, description) VALUES ('$token_no', '$user_id', '$type', '$description')";
        $result = $con->query($sql);
        return $result;
    }
    function updateToken($id, $type, $fee, $status)
    {
        $con = $GLOBALS['con'];
        $sql = "UPDATE support SET type = '$type', fee = '$fee', status = '$status' WHERE id = $id";
        $result = $con->query($sql);
        return $result;
    }
    function getTokensByUser($user_id)
    {
        $con = $GLOBALS['con'];
        $sql = "SELECT support.id, support.token_no, support.user_id, support.type, support.description, support.fee, support.added_at, support.status FROM support WHERE support.user_id = $user_id LIMIT 500";
        $result = $con->query($sql);
        return $result;
    }
    function deleteToken($id)
    {
        $con = $GLOBALS['con'];
        $sql = "DELETE FROM support WHERE id = $id";
        $result = $con->query($sql);
        return $result;
    }
}
