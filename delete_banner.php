<?php
    require_once('function/function.php');
    needLogged();
    $id=$_GET['db'];
    $del="DELETE FROM banners WHERE ban_id='$id'";
    if(mysqli_query($con,$del)){
        header('location: all-banner.php');
    }else{
        echo "Opps! Operation Failed";
    }
?>