<?php 
require 'connection/connect.php';
$id = $_GET['id'];
$connn=new conn();
$con= $connn->get_con();
if(filter_var($id,FILTER_VALIDATE_INT)){
$sql = "delete from blogs where id = $id"; 
$op = mysqli_query($con,$sql); 
if($op){
  $message = 'Raw Removed';

}else{
    $message = 'Error Try Again';
}

}else{
    $message = 'invalid ID';
}

 
 $_SESSION['Message'] = $message; 

header("location: index.php");

$con= $connn->clos_con();
