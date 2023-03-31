<?php

include("db.php");


if(isset($_POST["login"])){
    $user = fetch($_POST['email']);
    if ($user == 0) {
        $_SESSION['message'] = "User not Found!";
        header("Location: auth.php");
    }
    else{
        while ($row = $user->fetch_assoc()) {
            $hash = $row['password'];
            if (password_verify($_POST['password'], $hash)) {
                $_SESSION['email'] = $_POST['email'];
                if ($row['type'] == 'admin') {
                    header("Location: admin.php");
                }
                else{
                    header("Location: index.html");
                }
            }
        }
    }
}

if(isset($_POST["register"])){
    $type = 'user';
    // $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $result = register($_POST['name'], $_POST['email'], $password);
    if ($result == 1) {
        $_SESSION['message'] = 'Registration Successful!';
        header('location: auth.php');
    }
    else{
        $_SESSION['message'] = 'Registration Failed!';
        header('location: auth.php');
    }
}


?>
