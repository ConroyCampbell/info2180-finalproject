<?php 
session_start();

require_once 'dbconfig.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$fname = htmlspecialchars(filter_input(INPUT_GET,'fname',FILTER_SANITIZE_STRING));
$lname = htmlspecialchars(filter_input(INPUT_GET,'lname',FILTER_SANITIZE_STRING));
$email = htmlspecialchars(filter_input(INPUT_GET,'email',FILTER_SANITIZE_STRING));
$password = htmlspecialchars(filter_input(INPUT_GET,'password',FILTER_SANITIZE_STRING));

$hash_password =  password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (firstname,lastname,email,password,date_joined) VALUES (?,?,?,?,?)");
$stmt->execute([$fname,$lname,$email,$hash_password,date("Y-m-d h:i:s")]);

echo "done";

?>