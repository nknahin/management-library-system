<?php


$errors = [];

if (isset($_POST["submit"])) {
    if (empty($_POST["email"])) {
        $errors["email"] = "Email can not be empty.";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Email is invalid.";
        }
    }
    
    if (empty($_POST["password"])) {
        $errors["password"] = "Password can not be empty.";
    }
    
    if (empty($errors)) {
        // Sanitize user input
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = $_POST["password"];
        
        // Check user information in the database
        $q = $pdo->prepare("SELECT * FROM users WHERE email=? AND status=?");
        $q->execute([$email, 1]);
        $user = $q->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            $errors["login"] = "Invalid email or password.";
        } else {
            if (password_verify($password, $user["password"])) {
                $_SESSION['user'] = $row;
                header('location:'.BASE_URL.'library.php');
                echo "Login successful!";
                exit;
            } else {
                $errors["login"] = "Invalid email or password.";
            }
        }
    }
}