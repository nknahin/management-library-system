<?php 
ob_start();
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once("config.php");
define('BASE_URL', 'http://localhost/library-management/');
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
        #side_bar {
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
            <a class="navbar-brand" href="index.php">Library Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav"> 
                <ul class="navbar-nav">
                    <?php if(isset($_SESSION["user"])):?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Profile
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">View Profile</a>
                            <a class="dropdown-item" href="#">Edit Profile</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL;?>logout.php">Logout</a>
                    </li>
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav><br>
    <span><marquee>This is library management system project.</marquee></span><br><br>

    <?php
    if(!isset($_SESSION["user"])){
        header("location:". BASE_URL. "login.php");
        exit;
    }
    ?>

    <div class="container">
        <div class="col-lg-12 ml-50">
            <center><h2>This is main library</h2><br>
            <div class="col-md-12">
                <p>Hi <?php echo $_SESSION["user"]['firstname'];  ?>, Welcome to Dashboard.</p>
            </div>
        </div>
        </center>
    </div> <br><br>

    <?php include_once("footer.php"); ?>
</body>
</html>
