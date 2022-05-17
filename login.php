<?php
// error_reporting(E_ALL);
// ini_set('display errors', '1');

include 'config.php';

session_start();


if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}

$lemail = "";
$username = "";
$errors = array();


if(isset($_POST['submit'])){
	$lemail = mysqli_real_escape_string($conn, $_POST['lemail']);
	$password = $_POST['password1'];

	$check_email = "SELECT * FROM users WHERE email = '$lemail'";
	$res = mysqli_query($conn, $check_email);
	if(mysqli_num_rows($res) > 0){
		$fetch = mysqli_fetch_assoc($res);
		$fetch_pass = $fetch['password'];
		if($password == $fetch_pass){
			$_SESSION['email'] = $lemail;
			$status = $fetch['verified'];
			$role = $fetch['role'];
			if($status == 'verified'){
			  $_SESSION['email'] = $lemail;
			  $_SESSION['password'] = $password;
			  header('location: dashboard.php');
			  $_SESSION['username'] = $username;
				header('location: dashboard.php');
		header("Location: dashboard.php");
		if($role =="super_admin")
            header("Location: admin.php");
            else if ($role =='client'){
                header("Location:dashboard.php");
            }
            die();
			}else{
				$info = "It's look like you haven't still verify your email - $email";
				$_SESSION['info'] = $info;
				header('location: verification.php');
			}
		}else{
			$errors['email'] = "Incorrect Email or Password!";
		}
	}else{
		$errors['email'] = "It's look like you're not yet a member! Click on signup.";
	}
}

?>

<?php

// error_reporting(E_ALL);
// ini_set('display errors', '1');

 $email = "";
$username = "";
$fullname = "";
$signuperrors = array();

require 'vendor/autoload.php';
			require 'credential.php';


//if user signup button
if(isset($_POST['submit1'])){    
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
    
    if($password !== $cpassword){
        $signuperrors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $email_check);
    if(mysqli_num_rows($res) > 0){
        $signuperrors['email'] = "Email that you have entered is already exist!";
    } 
    if(count($signuperrors) === 0){
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO users (username, email, password, vkey, verified, fullname)
                        values('$username', '$email', '$password', '$code', '$status', '$fullname')";
        $data_check = mysqli_query($conn, $insert_data);
        if($data_check){
$receiver = $email;
$subject = "Email Test via PHP using Localhost";
$body = "Hi, there...This is a test email send from Localhost.";
$sender = "From:adejumodanielfemi@gmail.com";
if(mail($receiver, $subject, $body, $sender)){
    echo "Email sent successfully to $receiver";
}else{
    echo "Sorry, failed while sending mail!";
}
                header('location: register-otp.php');
                exit();
            }else{
                $signuperrors['otp-error'] = "Failed while sending code!";
            }
        }else{
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $email_check);
    if(mysqli_num_rows($res) > 0){
        $signuperrors['email'] = "Email that you have entered already exist!";
    } 
    if(count($signuperrors) === 0){
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO users (username, email, password, vkey, verified, fullname)
                        values('$username', '$email', '$password', '$code', '$status', '$fullname')";
        $data_check = mysqli_query($conn, $insert_data);
        if($data_check){
$receiver = $email;
$subject = "Email Test via PHP using Localhost";
$body = "Hi, there...This is a test email send from Localhost.";
$sender = "From:adejumodanielfemi@gmail.com";
if(mail($receiver, $subject, $body, $sender)){
    echo "Email sent successfully to $receiver";
}else{
    echo "Sorry, failed while sending mail!";
}
                header('location: register-otp.php');
                exit();
            }else{
                $signuperrors['otp-error'] = "Failed while sending code!";
            }
        }
    }
}



?>



<!DOCTYPE html>
<!-- === Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="sweetalert.min.js"></script>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="login.css">

    
         
    <title>Login & Registration Form</title>
</head>
<body>
    
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>
                    <p style="text-align: center;">Welcome back, We've missed you!</p>
                <form action="login.php" method="POST">

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
                        <input type="text" placeholder="Enter your email" name="lemail" value="<?php echo $lemail ?>" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="password1" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        
                        <a href="forgotten.php" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="Login Now">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup now</a>
                    </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <span class="title">Registration</span>

                <form action="" method="POST">
                    <div class="error">
                <?php
                            foreach($signuperrors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>                        
				
                    <div class="input-field" style="margin-top: 10px">
                        <input type="text" placeholder="Enter your name" name="fullname" value="<?php echo $fullname; ?>" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your username" name="username" value="<?php echo $username; ?>" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="email" placeholder="Enter your email" name="email" value="<?php echo $email; ?>" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field pw-meter popup">
                        <input type="password" class="password" id="signuppass" name="password" placeholder="Create a password" required>
                        
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                        <div class="pw-strength">
                    <span>Weak</span>
                    <span></span>
                </div>
                <span class="popuptext" id="myPopup">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</span>
                    </div>
                    <div class="input-field">
                        <input type="password" name="cpassword" class="password" placeholder="Confirm a password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>


                    <div class="input-field button">
                        <input type="submit" class="btn" name="submit1" value="Signup  Now">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Have an account?
                        <a href="#" class="text login-link">Login</a>
                    </span>
                </div>
            </div>

        </div>
    </div>

    <script>
        const container = document.querySelector(".container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");

    //   js code to show/hide password and change icon
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })


    // js code to appear signup and login form
    signUp.addEventListener("click", ( )=>{
        container.classList.add("active");
    });
    login.addEventListener("click", ( )=>{
        container.classList.remove("active");
    });

    let signuppass = document.querySelector('#signuppass');
    var popup = document.getElementById("myPopup");

signuppass.addEventListener('focus', (e)=> {
    popup.classList.toggle("show");
})

signuppass.addEventListener('blur', (e)=> {
    popup.classList.toggle("hide");
})

function getPasswordStrength(password){
  let s = 0;
  if(password.length > 6){
    s++;
  }
  if(password.length > 8){
    s++;
  }
  if(/[A-Z]/.test(password)){
    s++;
  }
  if(/[0-9]/.test(password)){
    s++;
  }
  if(/[^A-Za-z0-9]/.test(password)){
    s++;
  }
  return s;
}


document.querySelector("#signuppass").addEventListener("focus",function(){
  document.querySelector(".pw-strength").style.display = "block";
});

document.querySelector("#signuppass").addEventListener("blur",function(){
  document.querySelector(".pw-strength").style.display = "none";
});


let submitBtn = document.querySelector(".btn");

document.querySelector(".pw-meter #signuppass").addEventListener("keyup",function(e){
  let password = e.target.value;
  let strength = getPasswordStrength(password);
  let passwordStrengthSpans = document.querySelectorAll(".pw-meter .pw-strength span");
  strength = Math.max(strength,1);
  passwordStrengthSpans[1].style.width = strength*20 + "%";
  if(strength < 2){
    passwordStrengthSpans[0].innerText = "Weak";
    passwordStrengthSpans[0].style.color = "#111";
    passwordStrengthSpans[1].style.background = "#d13636";
    submitBtn.disabled = true;
    submitBtn.style.backgroundColor = "#a29bfe";
  } else if(strength >= 2 && strength <= 4){
    passwordStrengthSpans[0].innerText = "Medium";
    passwordStrengthSpans[0].style.color = "#111";
    passwordStrengthSpans[1].style.background = "orange";
    submitBtn.disabled = true;
    submitBtn.style.backgroundColor = "#a29bfe";
  } else {
    passwordStrengthSpans[0].innerText = "Strong";
    passwordStrengthSpans[0].style.color = "#111";
    passwordStrengthSpans[1].style.background = "#20a820";
    submitBtn.disabled = false;
    submitBtn.style.backgroundColor = "#6c5ce7";
  }
});

    

    </script>

<!-- Code injected by live-server -->
<script type="text/javascript">
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>   



</script>
</body>
</html>
