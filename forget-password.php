<?php include_once("header.php"); ?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>

<?php

$errors= [];
$success_message = '';
if(isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $errors[] = "Email can not be empty.";
        }else{
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    $errors[] = "Email is invalid.";
            }
        }
        $q = $pdo->prepare("SELECT * FROM users WHERE email=? AND status=?");
        $q->execute([$_POST["email"],1]);
        $total = $q->rowCount();
        if(!$total){
            $errors[] = "Email is not found.";

        }

        $token = time();
        $statement = $pdo->prepare("UPDATE users SET token=? WHERE email=?");
        $statement->execute([$token,$_POST['email']]);
        $total = $statement->rowCount();
        if(!$total){
            $errors[] = "Email is not found.";
        }

            require 'vendor/autoload.php';
            $mail = new PHPMailer(true);
            try {
                
                $mail->isSMTP();
                $mail->Host = "smtp.mailtrap.io";
                $mail->SMTPAuth = true;
                $mail->Username = '101ca9061ab9f4';
                $mail->Password = '1293f04ba00efe';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 2525;

                $mail->setFrom('contact@example.com');
                $mail->addAddress($_POST["email"]);
                $mail->addReplyTo('contact@example.com');
                $mail->isHTML(true);
                $mail->Subject = "Reset password.";
                $link = BASE_URL . 'reset-password.php?email=' . $_POST["email"] . '&token=' . $token;
                $mail->Body = '<p>Please click on this link to reset your password":</p>' .
                    '<p><a href="' . $link . '">Click here</a></p>';

                if ($mail->send()) {
                    $success_message = "An email is send to your email to reset the password. Please check your email and follow the steps.";                
                } else {
                    $errors[] = "Message could not be sent. Mailer error: " . $mail->ErrorInfo;
                }
            } catch (Exception $e) {
                $errors[] = "Message could not be sent. Mailer error: " . $e->getMessage();
            }






}
    
?>



<div class="container col-md 12" >
<div class="col-md-12">
    <center><h3>Forget Password</h3></center>
<?php
    if (!empty($success_message)) {
        echo "<div class='success' >";
        echo $success_message;
        echo "</div>";
    }
?>
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="">
            <?php
             if (!empty($errors["email"])) {
                    echo '<div class="error">' . $errors["email"] . '</div>';
                }
                ?>
        </div><br>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button><p></p>
    </form>

</div>
</div>