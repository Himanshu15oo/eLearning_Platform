<?php

session_start();

function createConn(){
    $servername = "localhost";
   $username = "admin";
   $password = "adminpassword";
   $dbname = "first_trick";
   $conn = new mysqli($servername, $username, $password, $dbname);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   // echo "Connection Successful";
   return $conn;
}

function fetch($email){
    $conn = createConn();
    $sql = "SELECT * FROM users WHERE email = '{$email}'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result;
    }
    else {
        return 0;
    }
}

function register($name, $email, $password){
    $conn = createConn();
    $sql = $conn->prepare("INSERT INTO users(name, email, password) VALUES (?, ?, ?);");
    $sql->bind_param("sss", $name, $email, $password);
    if($sql->execute() == TRUE){
        return 1;
    }
    else{
        return 0;
    }
}

?>