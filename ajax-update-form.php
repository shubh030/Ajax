<?php
$student_id = $_POST['id'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$conn =mysqli_connect("localhost","root","","ajax_practise") or die("Connection Failed");
$sql= "UPDATE `ajax_practise` SET `fname` = '{$firstName}', `lname` = '{$lastName}' WHERE `ajax_practise`.`id` = {$student_id}";
if (mysqli_query($conn,$sql)) {

    echo 1;
}else{
    echo 0;
}
?>