<?php 

session_start();

include "config.php";

$errors = array();

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
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login.php');
}

$email = $_SESSION['email'];
if(isset($_POST['submitProfile'])){
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $country = mysqli_real_escape_string($conn, $_POST['country']);
  $zipcode = mysqli_real_escape_string($conn, $_POST['zipcode']);

  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $sql);
  if($result){
    $_SESSION['info'] = "";
      $email = $_SESSION['email']; //getting this email using session
      $update_pass = "UPDATE users SET username='$username', address = '$address', city = '$city', country = '$country', zipcode ='$zipcode' WHERE email = '$email'";
      $run_query = mysqli_query($conn, $update_pass);

      header('Location: profile.php');
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Paper Dashboard 2 by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <script src="sweetalert.min.js"></script>
</head>




<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="./assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="https://www.creative-tim.com" class="simple-text logo-normal">
          Creative Tim
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="dashboard.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li>
            <a href="wallet.php">
              <i class="nc-icon nc-credit-card"></i>
              <p>Wallet</p>
            </a>
          </li>
          <li>
            <a href="withdrawal.php">
              <i class="nc-icon nc-paper"></i>
              <p>Withdrawal</p>
            </a>
          </li>
          <li>
            <a href="notifications.php">
              <i class="nc-icon nc-bell-55"></i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="active">
            <a href="profile.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Profile</p>
            </a>
          </li>
          <li>
            <a href="change-password.php">
              <i class="nc-icon nc-key-25"></i>
              <p>Change Password</p>
            </a>
          </li>
          <li>
            <a href="upgrade.php">
              <i class="nc-icon nc-spaceship"></i>
              
              <p>Upgrade</p>
            </a>
          </li>
          <li>
            <a href="logout.php" data-toggle="modal" data-target="#logoutModal">
              <i class="nc-icon nc-button-power"></i>
              
              <p>Logout</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>


     <!----Last--->
     <div class="sidebarx" id="mySidenav" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="./assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="javascript:void(0)" class="simple-text logo-normal">
          Danvo
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">
            <div class="barx1"  onclick="closeNav()"></div>
            <div class="barx2" onclick="closeNav()"></div>
        </a>
        </a>
        
      </div>
      <div class="sidebar-wrapperx">
        <ul class="navx" type="none">
          <li>
            <a href="dashboard.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li>
            <a href="wallet.php">
              <i class="nc-icon nc-credit-card"></i>
              <p>Wallet</p>
            </a>
          </li>
          <li>
            <a href="withdrawal.php">
              <i class="nc-icon nc-paper"></i>
              <p>Withdrawal</p>
            </a>
          </li>
          <li>
            <a href="notifications.php">
              <i class="nc-icon nc-bell-55"></i>
              <p>Notifications</p>
            </a>
          </li>
          <li class="active">
            <a href="profile.php">
              <i class="nc-icon nc-single-02"></i>
              <p>Profile</p>
            </a>
          </li>
          <li>
            <a href="change-password.php">
              <i class="nc-icon nc-key-25"></i>
              <p>Change Password</p>
            </a>
          </li>
          <li>
            <a href="upgrade.php">
              <i class="nc-icon nc-spaceship"></i>
              
              <p>Upgrade</p>
            </a>
          </li>
          <li>
            <a href="logout.php" data-toggle="modal" data-target="#logoutModal">
              <i class="nc-icon nc-button-power"></i>
              
              <p>Logout</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle" onclick="openNav()">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Hello <?php echo $fetch_info['username'] ?></a>
          </div>

        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <div style="background-color: #292828; width: 100%; height: 150px;border-radius: 12px 12px 0 0;"></div>
              </div>
              <div class="card-body">
                <div class="author">
                    <img class="avatar" style="border: 2px solid #292828;" src="./img/user.png" alt="...">
                    <h5 class="title" style="text-transform: capitalize;"><?php echo $fetch_info['fullname'] ?></h5>
                  
                </div>
                
              </div>
            </div>
            
          </div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Edit Profile</h5>
              </div>
              <div class="card-body">

                <!---Form Starts Here-->
                <form action="profile.php" method="POST">


                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Package</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="Starter">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" value="<?php echo $fetch_info['username'] ?>" name="username">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" value="<?php echo $fetch_info['email'] ?>" class="form-control" placeholder="Email" name="email" disabled> 
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" placeholder="Company" value="<?php echo $fetch_info['fullname'] ?>" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" value="Faker">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Home Address" value="<?php echo $fetch_info['address'] ?>" name="address">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 ">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="City" value="<?php echo $fetch_info['city'] ?>" name="city">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" placeholder="Country" value="<?php echo $fetch_info['country'] ?>" name="country">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Postal Code</label>
                        <input type="number" class="form-control" value="<?php echo $fetch_info['zipcode'] ?>" placeholder="ZIP Code" name="zipcode">
                      </div>
                    </div>
                  </div>
                  
                  </div>

                  
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="submitProfile" class="btn btn-primary" onclick="btn()">Update Profile</button>
                    </div>
                  </div>

                </form>
                <!---Ends here--->
              </div>
            </div>
          </div>
        </div>
      </div>


              <!-- Logout Modal-->
  <div class="modal fade"  id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form action="logout.php" method="POST"> 
          
            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

          </form>


        </div>
      </div>
    </div>
  </div>
      
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>

  <script>
  
  function btn(){
    swal({
title: "Profile Updated!",
icon: "success",
button: 'Okay',
});
  }

  function openNav() {
  document.getElementById("mySidenav").style.display = "block";
  document.getElementById("mySidenav").style.transition = "0.5s";
}

function closeNav() {
  document.getElementById("mySidenav").style.display = "none";
}

</script>

</body>

</html>