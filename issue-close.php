<?php
require_once 'dbconfig.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$index = htmlspecialchars(filter_input(INPUT_GET,'index',FILTER_SANITIZE_STRING)); 

$updated_date = date("Y-m-d h:i:s");

$stmt = $conn->prepare("UPDATE issues SET status=?, updated=? WHERE id='$index'");
$stmt->execute(["Closed",$updated_date]);  