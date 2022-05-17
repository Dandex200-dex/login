<?php
// error_reporting(E_ALL);
// ini_set('display errors', '1'); 

include 'config.php';
include 'script.php';

$email = "";
$username = "";
$errors = array();
$done = array();

$hi = "";
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE vkey = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['vkey'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE users SET vkey = $code, verified = '$status' WHERE vkey = $fetch_code";
            $update_res = mysqli_query($conn, $update_otp);
            if($update_res){
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $email = $_SESSION['email'];
                $done['otp-success'] = "Verification Complete. Now Proceed to login.";
                $hi = "Verification Complete. Now Proceed to login.";
                header('location: verified.php');
                exit(0);
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <span class="title">Code Verification</span>
                <form action="verification.php" method="POST">

                <div style="margin: 10px 0;"><span style="color: red;">You have not been verified!</span> Check your inbox: We sent a 6 digit code to your email for verification.</div>

                <?php echo $hi; ?>
                   

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
            text: "Try Again!!",
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
                        <input type="number" placeholder="Enter verification code" name="otp"required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" name="check" value="Verify" id="code">
                    </div>

                    <div class="return">
                    <a href="login.php">Back</a>
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


