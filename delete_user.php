<?php
    require_once('function/function.php');
    needLogged();
    $id=$_GET['d'];
    $del="DELETE FROM users WHERE user_id='$id'";
    if(mysqli_query($con,$del)){
        header('location: all-user.php');
    }else{
        echo "Opps! Operation Failed";
    }
?>