<?php
include "config.php";

session_start();

$errors = array();



$hi = "";
    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE vkey = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $update_otp = "UPDATE users SET verified = 'verified'";
            $update_res = mysqli_query($conn, $update_otp);
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: test-change.php');
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
                <form action="reset.php" method="POST">

                <div style="margin: 10px 0;">Check your inbox: We sent a 6 digit code to your email for verification.</div>

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
                        <input type="number" placeholder="Enter verification code" name="otp" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" name="check-reset-otp" value="Verify">
                    </div>

                    <div class="return">
                    <a href="javascript:void(0)" onclick="Previous()">Back</a>
                    </div>
                </form>
</div>
</div>
</div>

                    <script>
                        function Previous() {
            window.history.back()
        }
                    </script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>