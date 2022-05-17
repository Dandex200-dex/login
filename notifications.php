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
            <li class="active">
              <a href="./notifications.html">
                <i class="nc-icon nc-bell-55"></i>
                <p>Notifications</p>
              </a>
            </li>
            <li>
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
          <li class="active">
            <a href="notifications.php">
              <i class="nc-icon nc-bell-55"></i>
              <p>Notifications</p>
            </a>
          </li>
          <li>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Notifications</h5>
                <p class="card-category">Notifications will appear here to let you know when a change in your account has been made.</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-plain">
                      <div class="card-header">
                        <h5 class="card-title"></h5>
                      </div>
                      <div class="card-body">
                        
                        
                        <div class="alert alert-success alert-with-icon alert-dismissible fade show shadow" data-notify="container">
                          <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                          <span data-notify="message" style="font-size: 16px;"><?php echo $fetch_info['alert'] ?></span>
                        </div>
                        
                      </div>
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

  <div style="height: 30vh;"></div>
                  
                  
       

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