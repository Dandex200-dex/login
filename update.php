<?php
  // Include database connection file
  include_once('config.php');
  if (isset($_POST['submit'])) {
    
    $username = $conn->real_escape_string($_POST['username']);
    $email= $conn->real_escape_string($_POST['email']);
  $id=$_GET['id'];
    $role= $conn->real_escape_string($_POST['role']);
    $invested= $conn->real_escape_string($_POST['invested']);
    $balance= $conn->real_escape_string($_POST['balance']);
    $accountLevel= $conn->real_escape_string($_POST['accountLevel']);
    $profit= $conn->real_escape_string($_POST['profit']);
    $alert= $conn->real_escape_string($_POST['alert']);
    $date= $conn->real_escape_string($_POST['date']);
    $plan= $conn->real_escape_string($_POST['plan']);

    $sql=" UPDATE  users SET username  ='$username' , email='$email',  role='$role',  invested='$invested',  balance='$balance',  accountLevel='$accountLevel',  profit='$profit',  alert='$alert', date='$date',  plan='$plan' where id='$id'";
    $result = $conn->query($sql);
    if ($result==true) {
      header("Location:admin.php");
   
    }else{
      $errorMsg  = "You are not Registred..Please Try again";
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

  <style>
  .update {
    display: none;
}
  </style>
</head>

<body class="">

<div class="card text-center" style="padding:20px;">
  <h3>Update user</h3>
</div><br>
<div class="container">
  <div class="row">
    
        <form action="" method="POST" class="login-email form-row">
          <div class="form-group col-xl-3 col-md-6">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?php echo $_GET['username'] ?>" required>
          </div>
       
          <div class="form-group col-xl-3 col-md-6">  
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" placeholder="Enter Email" value="<?php echo $_GET['email'] ?>"required="">
          </div>

          <div class="form-group col-xl-3 col-md-6">  
            <label for="role">Role:</label>
            <input type="text" class="form-control" name="role" placeholder="Enter Role" value="<?php echo $_GET['role'] ?>"required="">
          </div>

          <div class="form-group col-xl-3 col-md-6">  
            <label for="role">Invested:</label>
            <input type="text" class="form-control" name="invested" placeholder="Enter Invested" value="<?php echo $_GET['invested'] ?>"required="">
          </div>

          <div class="form-group col-xl-3 col-md-6">  
            <label for="role">Balance:</label>
            <input type="text" class="form-control" name="balance" placeholder="Enter Balance" value="<?php echo $_GET['balance'] ?>"required="">
          </div>

          <div class="form-group col-xl-3 col-md-6">  
            <label for="role">Account Level:</label>
            <input type="text" class="form-control" name="accountLevel" placeholder="Enter Account Level" value="<?php echo $_GET['accountLevel'] ?>"required="">
          </div>

          <div class="form-group col-xl-3 col-md-6">  
            <label for="role">Profit:</label>
            <input type="text" class="form-control" name="profit" placeholder="Profit" value="<?php echo $_GET['profit'] ?>"required="">
          </div>

          <div class="form-group col-xl-3 col-md-6">  
            <label for="role">Alert:</label>
            <input type="text" class="form-control" name="alert" placeholder="Alert" value="<?php echo $_GET['alert'] ?>"required="">
          </div>

          <div class="form-group col-xl-3 col-md-6">  
            <label for="role">Date:</label>
            <input type="text" class="form-control" name="date" placeholder="Date" value="<?php echo $_GET['date'] ?>"required="">
          </div>

          <div class="form-group col-12">  
            <label for="Plan">Withdraw:</label>
            <input type="text" class="form-control" name="plan" placeholder="Plan" value="<?php echo $_GET['plan'] ?>"required="">
          </div>

        
          <input type="submit" name="submit" class="btn btn-success" value="update"> 
          <div class="btn btn-success">
                    <a href="admin.php" class="text-white">Back</a>
                    </div>
        </form>
  </div>
</div>
</body>

      <!--   Core JS Files   -->
      <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->