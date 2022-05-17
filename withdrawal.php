<?php 

include 'config.php';

session_start();

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

$hi = "";

$zero = '.00';
$transID = 'V10';

if(isset($_POST['submitbtn'])){
  
      // escape sql chars
      $amount = mysqli_real_escape_string($conn, $_POST['amount']);
      $method = mysqli_real_escape_string($conn, $_POST['withdrawal_method']);

    if ($fetch_info['balance'] == 0.00 or $fetch_info['balance'] < $amount) {
    $hey = "Insufficent Fund - Please deposit into your account!";
    } else {
      $_SESSION['info'] = "";
      
      $calculate = $fetch_info['balance'] - $amount;
      $email = $_SESSION['email']; //getting this email using session
      $update_pass = "UPDATE users SET amount = '$$amount.00', method = '$method', pending = 'Pending', TransID = '$transID', balance ='$calculate.00' WHERE email = '$email'";
      $run_query = mysqli_query($conn, $update_pass);
      header('Location: withdrawal.php');
      
      $message = "Your transaction is being proceed!";
    }

    if ($fetch_info['balance'] == 0.00) {
      $fetch_info['balance'] = '0.00';
    }


} // end POST check

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
          <li class="active ">
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

          <li>
            <a href="wallet.php">
              <i class="nc-icon nc-credit-card"></i>
              <p>Wallet</p>
            </a>
          </li>
          <li  class="active">
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
            <a class="navbar-brand" href="javascript:;">Hello <?php echo $fetch_info['username'] ?></a>
          </div>
          

        </div>
      </nav>
      <!-- End Navbar -->

      <div class="content">
        <!-- Page Heading -->
    
      <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="card shadow col-xl-6 col-md-7 mb-4">
                                    <div class="card-body">
                                        <h4 class="header-title">
                                          <i class="nc-icon nc-credit-card"></i> Withdrawal Request</h4>
                                            <form method="POST" action="withdrawal.php">
                                            <div class="form-group">

        

                                                                                <!---Errror -->
                                    <?php
                                                    ?>

                                                    

                      <script>

                    swal({
            title: "<?php echo $hey ?>",
            icon: "error",
            button: "Okay",
            });


        </script>

        <?php        
        ?>
                      
    
                                                <label for="withdrawal_method">Withdrawal Method</label>
                                                <select name="withdrawal_method" class="form-control input-lg" style="height: 40px;" id="withdrawalMethod" required>
                                                    <option value="">Select Method</option>
                                                    <option value="Bitcoin">Bitcoin</option>
                                                    <option value="Litecoin">Litecoin</option>
                                                    <option value="Ethereum">Ethereum</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                </select>
                                            </div>
                                            <!-- /.form group -->
    
                                            <div id="beneficiaryField1" class="form-group">
                                                <label for="btc_address">BTC Address</label>
                                                <input class="form-control" type="text" name="btc_address" placeholder="Enter BTC Wallet Address" id="btc_address"  autocomplete="off" required>
                                            </div>
                                             <div id="beneficiaryField2" class="form-group" style="display: none">
                                                <label for="litecoin_address">Litecoin Address</label>
                                                <input class="form-control" type="text" name="litecoin_address" placeholder="Enter Your Litecoin Address" id="litecoin_address"  autocomplete="off">
                                            </div>
                                            
    
                                           <div id="beneficiaryField3" class="form-group" style="display: none">
                                                <label for="ethereum_address">Ethereum Address</label>
                                                <input class="form-control" type="text" name="ethereum_address" placeholder="Enter Your Ethereum Address" id="ethereum_address"  autocomplete="off">
                                            </div>
    
                                            <div id="beneficiaryField4" class="form-group" style="display: none;">
                                                <label for="bank_name">Bank Name</label>
                                                <input class="form-control" type="text" name="bank_name" placeholder="Enter Bank Name" id="bank_name">
                                            </div>
                                            
                                            <div id="beneficiaryField5" class="form-group" style="display: none;">
                                                <label for="acct_no">Account Number</label>
                                                <input class="form-control" type="text" name="acct_no" placeholder="Enter Account Number" id="acct_no">
                                            </div>
    
                                            <div id="beneficiaryField6" class="form-group" style="display: none;">
                                                <label for="acct_name">Account Name</label>
                                                <input class="form-control" type="text" name="acct_name" placeholder="Enter Account Name" id="acct_name">
                                            </div>
    
                                            <div id="beneficiaryField7" class="form-group" style="display: none;">
                                                <label for="acct_swift">Swift Code</label>
                                                <input class="form-control" type="text" name="acct_swift" placeholder="Enter Swift Code" id="acct_swift">
                                            </div>
    
    
                                           
    
                                            <div class="form-group">
                                              <label for="amount">Enter Withdrawal Amount</label>
                                              <input class="form-control" type="text" name="amount" placeholder="0.00" id="amount" required  autocomplete="off">
                                            </div>

    
                                            <div class="form-group">
                                                <button name="submitbtn" type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Proceed</button>
                                            </div>
                                        </form>
                                    
                                        
                                            
                                              <div class="card">
                                                <div class="card-header">
                                                  <h4 class="card-title"> 
                                                <i class="nc-icon nc-chart-bar-32"></i>
                                                    Transaction</h4>
                                                </div>
                                                <div class="card-body">
                                                  <div class="table-responsive" style="overflow-y: hidden;">
                                                    <table class="table" >
                                                      <thead class=" text-primary">
                                                        <th>
                                                          ID
                                                        </th>
                                                        <th>
                                                          Method
                                                        </th>
                                                        <th>
                                                          Status
                                                        </th>
                                                        <th class="text-right">
                                                          Amount
                                                        </th>
                                                      </thead>
                                                      <tbody>
                                                        <tr>
                                                          <td>
                                                          <?php echo $fetch_info['TransID'] ?>
                                                          </td>
                                                          <td>
                                                          <?php echo $fetch_info['method'] ?>
                                                          </td>
                                                          <td style="color: orange;">
                                                          <?php echo $fetch_info['pending'] ?>
                                                          </td>
                                                          <td class="text-right">
                                                          <?php echo $fetch_info['amount'] ?>
                                                          </td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </div>
                                  
    
                                    </div>
                                  </div>
                                  </div>
                                  </div>
                                  
    
                                <div class="card shadow col-xl-6 col-md-5 mb-4">
                                <div class="card-body">
                                    <h4 class="header-title">Withdrawal FAQ</h4>
                                    <h6><strong>Withdrawing Funds - How Does It Work? </strong></h6>
                                    <p>At cryptofirstminers.com , we have designed our withdrawal process to be as easy as our funding process. To begin the withdrawal process first select your preferred withdrawal method and then type in the amount you want to withdraw and click "Proceed".</p> <br><br>
    
                                    <h6><strong>What Methods Are There For Withdrawal Of Funds? </strong></h6>
                                    <p>cryptofirstminers.com  provides four(4) withdrawal methods (Bitcoin, Litecoin, Ethereum and Direct Bank Transfer).</p> <br><br>
    
                                    <h6><strong>Must Withdrawal Requests Only Be Made At Certain Times? </strong></h6>
                                    <p>Requests for withdrawals can be made at any time via the cryptofirstminers.com  site. The requests will be processed immediately, and during the relevant financial institutions business hours.</p><br><br>
    
                                    <h6><strong>Is There A Withdrawal Limit? </strong></h6>
                                    <p>Withdrawals are capped at the amount of funds that are currently in the account.</p> <br><br>
    
                                    <h6><strong>How Long Does It Take To Get My Money? </strong></h6>
                                    <p>Withdrawal requests are addressed and handled as quickly as possible.</p>
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

  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script>
    function SelectText(element) {
      var doc = document,
        text = element,
        range, selection;
      if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
      } else if (window.getSelection) {
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
      }
    }

    function openNav() {
  document.getElementById("mySidenav").style.display = "block";
  document.getElementById("mySidenav").style.transition = "0.5s";
}

function closeNav() {
  document.getElementById("mySidenav").style.display = "none";
}

  </script>
  <script src="./assets/js/cheat.js"></script>
</body>

</html>