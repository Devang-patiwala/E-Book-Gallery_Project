<?php
if(!isset($_SESSION)){ session_start(); }
$con=mysqli_connect("localhost","root","","onlinebookstore");
echo mysqli_connect_error();
?>z
