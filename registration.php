<?php include_once("header.php");?>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>



<?php
$errors = [];
$success_message = '';

// Validate the form
if (isset($_POST['form1'])) {
    if (empty($_POST["firstname"])) {
        $errors["firstname"] = "First name can not be empty.";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["firstname"])) {
            $errors["firstname"] = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["lastname"])) {
        $errors["lastname"] = "Last name can not be empty.";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["lastname"])) {
            $errors["lastname"] = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $errors["email"] = "Email can not be empty.";
    } else {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Email is invalid.";
        }
    }

    // Check email existence
    $statement = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $statement->execute([$_POST['email']]);
    $total = $statement->rowCount();
    if ($total) {
        $errors["email"] = "Email already exists.";
    }

    if (empty($_POST["phone"])) {
        $errors["phone"] = "Phone can not be empty.";
    }
    if (empty($_POST["password"]) || empty($_POST["retype_password"])) {
        $errors["password"] = "Password can not be empty.";
    } elseif ($_POST["password"] != $_POST["retype_password"]) {
        $errors["password"] = "Passwords must match.";
    }

    if (empty($errors)) {
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $token = time();

        // Insert user's data from user's input
        $q = $pdo->prepare("INSERT INTO users (firstname, lastname, email, phone, password, token, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($q->execute([$_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["phone"], $password, $token, 0])) {

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
                $mail->Subject = "Registration verification email";
                $link = BASE_URL . 'registration-verify.php?email=' . $_POST["email"] . '&token=' . $token;
                $mail->Body = '<p>Please click on this link to verify your registration:</p>' .
                    '<p><a href="' . $link . '">Click here</a></p>';

                if ($mail->send()) {
                    $success_message = 'Registration is completed. An email has been sent to your email address. Please check your email and verify the registration.';
                } else {
                    $errors[] = "Message could not be sent. Mailer error: " . $mail->ErrorInfo;
                }
            } catch (Exception $e) {
                $errors[] = "Message could not be sent. Mailer error: " . $e->getMessage();
            }
        } else {
            $errors[] = "Database error. Registration failed.";
        }
    }
}
?>

<div class="container">
    <div class="col-lg-12 ml-50" id="main-content">
        <center><h3>User Registration Form</h3></center>
        <?php
        if (!empty($success_message)) {
            echo "<div class='success'>";
            echo $success_message;
            echo "</div>";
        }
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" class="form-control" value="<?php if (isset($_POST["firstname"])) {
                    echo $_POST["firstname"];
                } ?>" autocomplete="off">
                <?php
                if (!empty($errors["firstname"])) {
                    echo '<div class="error">' . $errors["firstname"] . '</div>';
                }
                ?>
            </div>
            <p></p>
            <div class="form-group">
                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" class="form-control" value="<?php if (isset($_POST["lastname"])) {
                    echo $_POST["lastname"];
                } ?>" autocomplete="off">
                <?php
                if (!empty($errors["lastname"])) {
                    echo '<div class="error">' . $errors["lastname"] . '</div>';
                }
                ?>
            </div>
            <p></p>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="<?php if (isset($_POST["email"])) {
                    echo $_POST["email"];
                } ?>" autocomplete="off">
                <?php
                if (!empty($errors["email"])) {
                    echo '<div class="error">' . $errors["email"] . '</div>';
                }
                ?>
            </div>
            <p></p>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" class="form-control" value="<?php if (isset($_POST["phone"])) {
                    echo $_POST["phone"];
                } ?>" autocomplete="off">
                <?php
                if (!empty($errors["phone"])) {
                    echo '<div class="error">' . $errors["phone"] . '</div>';
                }
                ?>
            </div>
            <p></p>
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

            <button type="submit" name="form1" class="btn btn-primary">Register</button>
        </form>
    </div><br>
        </div>

    <?php include_once("footer.php"); ?>
