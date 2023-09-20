<?php 

ob_start();
session_start();
define('BASE_URL', 'http://localhost/library-management/');
?>
<?php

$dbhost= "localhost";
$dbname = "library_management_system";
$dbuser = "root";
$dbpass = "";

try{
    $pdo = new pdo("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "Connection error:" . $e->getMessage();
}

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <title>Library Management System</title>
    <style type="text/css">
        #side_bar{
            background-color: whitesmoke;
            padding: 50px;
            width: 300px;
            height: 450px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Library Management System</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Admin Login</a>
                </li>

                <?php if(!isset($_SESSION["user"])):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>login.php">User Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>registration.php">Registration</a>
                </li>
                <?php endif;?>

                <?php if(isset($_SESSION["user"])):?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>library.php">Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL;?>logout.php">Logout</a>
                </li>
                <?php endif;?>

            </ul>
        </div>
    </nav><br>
    <span><marquee>This is library management system project.</marquee></span><br><br>
    

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
        
        // Check admin information in the database
        $q = $pdo->prepare("SELECT * FROM admins WHERE email=? ");
        $q->execute([$email]);
        $user =  $q->rowCount();
        
        if (!$user) {
            $errors["email"] = "Invalid email.";
        } else {
            $result = $q->fetchALL(PDO::FETCH_ASSOC);
            foreach($result as $row){
                if($row["email"] == $_POST["email"]){
                    if($row["password"] == $_POST["password"]){
                        $_SESSION['admins'] = $row;
                        header("location: admin-dashboard.php");
                    }
                }
            }
        }

        
    }

    
        
}

?>





<div class="container col-md 12" >
<div class="col-md-12">
    <center><h3>Admin login</h3></center>
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Email ID:</label>
            <input type="email" name="email" class="form-control" id="">
            <?php
             if (!empty($errors["email"])) {
                    echo '<div class="error">' . $errors["email"] . '</div>';
                }
                ?>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" id="">
            <?php
                if (!empty($errors["password"])) {
                    echo '<div class="error">' . $errors["password"] . '</div>';
                }
                ?>
        </div><br>
        <button type="submit" class="btn btn-primary" name="submit">Login</button><p></p>
        <a class="" href="<?php echo BASE_URL;?>forget-password.php ?>">Forget your password?</a>
    </form>

</div>
</div>










       </div>
    <footer>
      <div class="row ">
        <div class="col-lg-12 text-center text-lg-center mb-0 mb-lg-10">
          <p class="large mb-10 mt-10 ">&copy;Copyright Nahin Ahmed. All right reserved.</p>
        </div>
    </footer>
    
</body>
</html>