<?PHP
include "functions.php";

session_start();

$signuperrors = array();

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $run_Sql = mysqli_query($conn, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['verified'];
        $code = $fetch_info['vkey'];
        if($status == "verified"){
            if($code != 0){
                header('Location: user-otp.php');
            }
        }
    }
}

$hi = "";

if(isset($_POST['UPDATE!!'])){
	//if the button update is clicked then put the data of id and password in variables
	$id = $fetch_info['id'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
//by calling the function update
//which needs obligatory needs the id of the user and the new password
if ($password == $cpassword) {
	Update_Password($id, $password);
	header('Location:new-changed.php');
} else {
  $signuperrors['password'] = "Confirm password not matched!";
}
//after updating the password the page that should appear is the displaying data again
//for ur case you need to go back to the users profile
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

    
         
    <title>Change Password</title>
</head>
<body>
    
    <div class="container">
        <div class="forms">
            <div class="form login">
        <span class="title">Create a New Password</span>

                <form action="change-password.php" method="POST">

                                    <!---Errror -->
                    <?php
                    if(count($signuperrors) > 0){
                        ?>
                        <div class="error">
                            <?php
                            foreach($signuperrors as $showerror){
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
				
                    <div class="input-field pw-meter popup">
                        <input type="password" class="password" id="signuppass" name="password" placeholder="New Password"  required>
                        
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                        <div class="pw-strength">
                    <span>Weak</span>
                    <span></span>
                </div>
                <span class="popuptext" id="myPopup">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</span>
                    </div>
                    <div class="input-field">
                        <input type="password" name="cpassword" class="password" placeholder="Re-enter password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>


                    <div class="input-field button">
                        <input type="submit" class="btn" name="UPDATE!!" value="Submit">
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
    </body>
    </html>