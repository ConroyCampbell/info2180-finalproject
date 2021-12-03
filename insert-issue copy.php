<?php
session_start();

require_once 'dbconfig.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);


$title = htmlspecialchars(filter_input(INPUT_GET,'title',FILTER_SANITIZE_STRING));

$desc = htmlspecialchars(filter_input(INPUT_GET,'desc',FILTER_SANITIZE_STRING));

$type = htmlspecialchars(filter_input(INPUT_GET,'type',FILTER_SANITIZE_STRING));

$priority = htmlspecialchars(filter_input(INPUT_GET,'priority',FILTER_SANITIZE_STRING));

$status = "Open";

$assigned = htmlspecialchars(filter_input(INPUT_GET,'assigned',FILTER_SANITIZE_STRING));

$names = explode(" ", $assigned);
$fname = $names[0];
$lname = $names[1];

$stmt = $conn->prepare("SELECT id FROM users WHERE firstname='$fname' AND lastname='$lname'");
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);
$assigned_id = $results['id'];

$created_by = $_SESSION["ID"];

$created_date = $updated_date = date("Y-m-d h:i:s");

$stmt = $conn->prepare("INSERT INTO issues (title,description,type,priority,status,assigned_to,created_by,created,updated) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->execute([$title,$desc,$type,$priority,$status,$assigned_id,$created_by,$created_date,$updated_date]);

echo "done";
?>