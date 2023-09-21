<?php include_once("header.php");?>


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
        $user =  $q->rowCount();
        
        if (!$user) {
            $errors["email"] = "Invalid email.";
        } else {
            $result = $q->fetchALL(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $password = $row['password'];
                if(!password_verify($_POST['password'], $password)){
                    $errors["password"]="Password does not match.";
                }
            }
        }

        
    }

    if(!$errors){
        $_SESSION['user'] = $row;
        header('location:'.BASE_URL.'user-dashboard.php');
    }
    
        
}

?>





<div class="container col-md 12" >
<div class="col-md-12">
    <center><h3>User login</h3></center>
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








<?php include_once("footer.php"); ?>