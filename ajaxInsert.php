<?php

$first_name =$_POST["first_name"];
$last_name =$_POST["last_name"];
$conn =mysqli_connect("localhost","root","","ajax_practise") or die("Connection Failed");
$sql= "INSERT INTO `ajax_practise` ( `fname`, `lname`) VALUES ('$first_name','$last_name')";
// $result = mysqli_query($conn,$sql) or die("failed to show");
if(mysqli_query($conn,$sql)){
    echo 1;
}else{
    echo 0;
}
?>