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

          <li class="active">
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

          <li class="active">
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
            <a class="navbar-brand" href="javascript:;">Hello  <?php echo $fetch_info['username'] ?></a>
          </div>
          
          
        </div>
      </nav>
      <!-- End Navbar -->

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header ">
                <h5 class="card-title">Fund Account</h5>
                <p  class="card-category">Make your first deposit with any of the following methods immediately your deposit will be confirmed.</p>
              </div>
              <div class="card-body ">
                <div id="map" >
                  <!--Start-->
                  <div class="content">
                    <div class="row">
                      <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                          <div class="card-body ">
                            <div class="row" style="display: flex; flex-direction:column; justify-content:center; align-items: center;">
                              <div class="col" style="text-align: center;">
                                <img src="./img/bitcoin.svg" alt="">
                              </div>

                              <div class="fund-text">
                              <h3>Bitcoin</h3>
                            </div>
                            
                            <button type="button" class="button-86" data-toggle="modal" data-target="#btcModal">
                              Deposit
                            </button>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <!--End-->
                      <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                          <div class="card-body ">
                            <div class="row" style="display: flex; flex-direction:column; justify-content:center; align-items: center;">
                              <div class="col" style="text-align: center;">
                                <img src="./img/eth.svg" alt="">
                              </div>

                              <div class="fund-text">
                              <h3>Ethereum</h3>
                            </div>

                            <button type="button" class="button-86" data-toggle="modal" data-target="#ethModal">
                              Deposit
                            </button>
                            </div>
                          </div>

                          
                        </div>
                      </div>


                      <!--End-->
                      <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                          <div class="card-body ">
                            <div class="row" style="display: flex; flex-direction:column; justify-content:center; align-items: center;">
                              <div class="col" style="text-align: center;">
                                <img src="./img/litecoin.svg" width="147px" height="143px" alt="">
                              </div>

                              <div class="fund-text">
                              <h3>Litecoin</h3>
                            </div>

                            <button type="button" class="button-86" data-toggle="modal" data-target="#liteModal">
                              Deposit
                            </button>
                            </div>
                          </div>


                          <!-- Modal -->
<div class="modal fade" id="liteModal" tabindex="-1" role="dialog" aria-labelledby="liteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="liteModalLabel">Deposit with Litecoin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="mb-4">*Note: This litecoin wallet is allocated to your account, any payment made to this ethereum wallet below will appear on your trading account within 24 hours.</p>
        <hr class="sidebar-divider d-none d-md-block">

        <span >Wallet Address</span>
        <div class="mt-3 text-center">
          <img src="./img/qrcode.svg" class=".mx-auto md-5" alt="">
          <br>
        <input class="p-2 mt-4 rounded" type="text" value="zv1qhugkwnwqjn3ut03a4syrmhaex8gg4x06xz3fxv" id="walletCode2">
        <span>
        <button onclick="myFunction2()" onclick="outFunc2()" class="tooltiptext btn btn-success pt-2 pb-2 mt-1" id="myTooltip2">copy</button>
        </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

                          
                        </div>
                      </div>


                      <!--End-->
                  
                        </div>
                      </div>
                    </div>
                    <!--End-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

        



<!-- Modal -->
<div class="modal fade" id="ethModal" tabindex="-1" role="dialog" aria-labelledby="ethModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ethModalLabel">Deposit with Ethereum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="mb-4">*Note: This ethereum wallet is allocated to your account, any payment made to this ethereum wallet below will appear on your trading account within 24 hours.</p>
        <hr class="sidebar-divider d-none d-md-block">

        <span >Wallet Address</span>
        <div class="mt-3 text-center">
          <img src="./img/qrcode.svg" class=".mx-auto md-5" alt="">
          <br>
        <input class="p-2 mt-4 rounded" type="text" value="zv1qhugkwnwqjn3ut03a4syrmhaex8gg4x06xz3fxv" id="walletCode">
        <span>
        <button onclick="myFunction()" onclick="outFunc()" class="tooltiptext btn btn-success pt-2 pb-2 mt-1" id="myTooltip">copy</button>
        </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>






      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
              </ul>
            </nav>
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


  
<!--Modal-->
<div class="modal fade" id="btcModal" tabindex="-1" role="dialog" aria-labelledby="btcModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="btcModalLabel">Deposit with Bitcoin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="mb-4">*Note: This bitcoin wallet is allocated to your account, any payment made to this bitcoin wallet below will appear on your trading account within 24 hours.</p>
        <hr class="sidebar-divider d-none d-md-block">

        <span >Wallet Address</span>
        <div class="mt-3 text-center">
          <img src="./img/qrcode.svg" class=".mx-auto md-5" alt="">
          <br>
        <input class="p-2 mt-4 rounded" type="text" value="zv1qhugkwnwqjn3ut03a4syrmhaex8gg4x06xz3fxv" id="walletCode1">
        <span>
        <button onclick="myFunction1()" onclick="outFunc1()" class="tooltiptext btn btn-success pt-2 pb-2 mt-1" id="myTooltip1">copy</button>
        </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
  <script src="./assets/js/copy.js"></script>
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