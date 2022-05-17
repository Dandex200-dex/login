<?php 

include 'config.php';

$email = "";
$username = "";
$errors = array();

require 'vendor/autoload.php';
			require 'credential.php';

$hi = "";
$errors = array();

if(isset($_POST['fotgotten-btn'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $token = rand(999999, 111111);

    $check_email = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run) > 0){
        $row = mysqli_fetch_array($check_email_run);
        $get_username = $row['username'];
        $get_email = $row['email'];

        $update_token ="UPDATE users SET vkey='$token', verified='notverified' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($conn, $update_token);

        if($update_token){
            $receiver = $email;
            $subject = "Email Test via PHP using Localhost";
            $body = "Hi, This is a email to reset password";
            $sender = "From:adejumodanielfemi@gmail.com";
            if(mail($receiver, $subject, $body, $sender)){
                echo "Email sent successfully to $receiver";
            }else{
                echo "Sorry, failed while sending mail!";
            }
                            header('location: reset.php');
                            exit();
                        }else {
            $info = "Somthing went wrong #1 - $email";
            $_SESSION['info'] = $info;
            header("location: forgotten.php");
            exit(0);
        }

    } else {
         $errors['email'] = "Email Not Found! - $email";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <title>Code Verification</title>
     <!-- ===== Iconscout CSS ===== -->
     <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

     <script src="sweetalert.min.js"></script>

<!-- ===== CSS ===== -->
<link rel="stylesheet" href="login.css">

</head>
<body >

<div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Forgotten Password</span>
                <form action="forgotten.php" method="POST">

                <div style="margin: 10px 0;">Enter the email address you used when you joined and we’ll send you a code to reset your password.</div>

                <p><span style="color: red; padding-right: 2px;">*</span>For security reasons, we do NOT store your password. So rest assured that we will never send your password via email.</p>

                <div class="success">
                            <?php echo $hi; ?>
                        </div>              
                        
                        
                    <!---Errror -->
<?php
                    if(count($errors) > 0){
                        ?>
                        <div class="error">
                            <?php
                            foreach($errors as $showerror){
                                ?>

<script>
                    swal({
            title: "<?php echo $showerror; ?>",
            icon: "error",
            button: "Okay",
            });


        </script>

        <?php                        
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    
                <div class="input-field" style="margin-top:10px">
                        <input type="email" placeholder="Enter email" name="email" value="<?php echo $email ?>"  required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" name="fotgotten-btn" value="Submit">
                    </div>

                    <div class="return" style="padding-bottom: 10px !important;">
                    <a href="login.php">Back to Login</a>
                    </div>

                </form>
</div>
</div>
</div>

    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>