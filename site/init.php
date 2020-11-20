<?php
$host = '127.0.0.1';  //the name of the mysql service inside the docker file.
$user = 'root';
$password = '';
$db = 'swapsite';
$conn = new mysqli($host,$user,$password,$db);


if($conn->connect_error){
  echo 'connection failed'. $conn->connect_error;
}
?>