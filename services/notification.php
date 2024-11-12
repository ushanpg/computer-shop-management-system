<?php
include "../models/cartModel.php";

if (isset($_SESSION["userData"])){
    
//Retrieve user id
$user_id = $_SESSION['userData']['id'];

$cartObject = new Cart;
$countCart =  $cartObject->countCart($user_id)->fetch_assoc();
$_SESSION['countCart'] = $countCart['COUNT(*)'];
}
            