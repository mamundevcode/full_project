<?php
    require_once('function/function.php');
    needLogged();
    $id=$_GET['dc'];
    $del="DELETE FROM contact WHERE con_id='$id'";
    if(mysqli_query($con,$del)){
        header('location: all-message.php');
    }else{
        echo "Opps! Operation Failed";
    }

?>
