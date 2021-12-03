<?php
session_start();

require_once 'dbconfig.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$correct = false;


$email = strtolower(htmlspecialchars(filter_input(INPUT_GET,'email',FILTER_SANITIZE_EMAIL)));
$password = htmlspecialchars(filter_input(INPUT_GET,'password',FILTER_SANITIZE_STRING)); 

$stmt = $conn->prepare("SELECT * FROM users WHERE email='$email'");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $result){
    $hashedpassword=$result['password'];
    if(password_verify($password,$hashedpassword)){
        $correct = true;
        $_SESSION['ID'] = $result["id"];
        break;
    }
}
      


if($correct){
    echo "1";
}else{
    echo '0';
}