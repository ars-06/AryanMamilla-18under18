<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Username']) && isset($_POST['password']) &&
     isset($_POST['email']) && isset($_POST['Phone'])) {
         
$username = $_POST['Username']
$password = $_POST['password']
$email = $_POST['email']
$phone = $_POST['Phone']

if(!empty($username) || !empty($password) || !empty($email) || !empty($phone)){
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "sql5447810";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    die('Could not connect to the database.');
}
else {
    $Select = "SELECT email FROM register WHERE email = ? LIMIT 1";
    $INSERT = "INSERT Into register (username, password, email, phone) values(? , ? , ?, ?)"

    $stmt = $conn->prepare($SELECT);
    $stmt->blind_param("s",$email);
    $stmt->execute();
    $stmt->blind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if ($rnum==0){
        $stmt = $conn->prepare($INSERT);
        $stmt->blind_param("sssi", $username, $password, $email, $phone);
        $stmt->execute();
        echo "New record inserted Successfully";
    }else{
        echo "Someone already registered using this email";
    }
    $stmt->close();
    $conn->close();
    }
}else
echo "All fields are required"
die();
}
?>