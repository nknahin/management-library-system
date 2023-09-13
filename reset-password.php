<?php include_once("header.php"); ?>

<?php
    $statement = $pdo->prepare("SELECT * FROM users WHERE email=? AND token=?");
    $statement->execute([$_REQUEST['email'],$_REQUEST['token']]);
    $total = $statement->rowCount();
    if (!$total) {
        header('location:'.BASE_URL);
        exit;
    }

?>

<?php
// if(isset($_POST["form1"])){
//     try{
        
//         if ($_POST["password"] == '' || $_POST["retype_password"] == '') {
//             throw new Exception("Password can not be empty.");
//         } elseif ($_POST["password"] != $_POST["retype_password"]) {
//             throw new Exception("Password does not match.");

//         }
//         $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
//         $statement = $pdo->prepare("UPDATE users SET token=?, password=? WHERE email=? AND token=?");
//         $statement->execute(['', $password,$_REQUEST['email'], $_REQUEST['token']]);

//         header('location:'.BASE_URL.'login.php?');
//         echo $_REQUEST['email'];
//         echo $_REQUEST['token'];


//     }catch(Exception $e){
//         $error_message = $e->getMessage();
//     }
// }


$errors = [];

if(isset($_POST['submit'])){
    if(empty($_POST["password"] || empty($_POST["retype_password"]))){
        $errors["password"] = "Password can not be empty.";
    }elseif(($_POST["password"] != $_POST["retype_password"])){
        $errors["password"] = "Password doesn't match.";
    }
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $statement = $pdo->prepare("UPDATE users SET token=?, password=? WHERE email=? AND token=?");
    $statement->execute(['', $password,$_REQUEST['email'], $_REQUEST['token']]);

    header('location:'.BASE_URL.'login.php?');
    echo $_REQUEST['email'];
    echo $_REQUEST['token'];
}
?>




<div class="container col-md 12" >
<div class="col-md-12">
    <center><h3>Reset Password </h3></center>
    <form action="" method="post">
        <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" autocomplete="off">
                <?php
                if (!empty($errors["password"])) {
                    echo '<div class="error">' . $errors["password"] . '</div>';
                }
                ?>
            </div>
            <p></p>
            <div class="form-group">
                <label for="retype_password">Re-type Password:</label>
                <input type="password" name="retype_password" class="form-control" autocomplete="off"> <br>
            </div> <br>
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
    </form>

</div>
</div>


<?php include_once("footer.php") ?>