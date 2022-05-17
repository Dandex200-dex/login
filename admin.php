<?php 

session_start();

include 'config.php';

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
  <link href="./assets/css/paper-dashboard.css" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">

<!-----Start Container-fluid --->
<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <div class="row">

    <div class="col-auto">

    <div class="table-responsive">
        <table class="table table-striped">
          <thead>
             <tr class="text-center">
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Invested</th>
            <th>Balance</th>
            <th>Account Level</th>
            <th>Profit</th>
            <th>Alert Level</th>
            <th>Alert Date</th>
            <th>Plan</th>
         </tr>
          </thead>
          <tbody>
         <?php
      
           
            $query = "SELECT * FROM users";
             

                 $result = $conn->query($query);
            if ($result->num_rows > 0) {
                   while ($row = $result->fetch_array()) {
             ?>      

             <tr class="text-center">
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['username']?></td>
            <td><?php echo $row['email']?></td>
            <td><?php echo $row['role']?></td>
                 <td><?php echo $row['invested']?></td>
                 <td><?php echo $row['balance']?></td>
                 <td><?php echo $row['accountLevel']?></td>
                 <td><?php echo $row['profit']?></td>
                 <td><?php echo $row['alert']?></td>
                 <td><?php echo $row['date']?></td>
                 <td><?php echo $row['plan']?></td>
                 <?php   if($row['role']!="super admin"){ ?>
          <td><a href="update.php?username=<?PHP echo $row['username']?>&email=<?php  echo $row['email']?>&role=<?php  echo $row['role']?>&invested=<?php  echo $row['invested']?>&balance=<?php  echo $row['balance']?>&accountLevel=<?php  echo $row['accountLevel']?>&profit=<?php  echo $row['profit']?>&alert=<?php  echo $row['alert']?>&date=<?php  echo $row['date']?>&plan=<?php  echo $row['plan']?>&id=<?php echo $row['id']?> "><button class="btn btn-outline-primary"> Edit </button></a>

       <?php } ?>

       

       
                </form>
              <?php   if( $row['role'] !=="super_admin"){ ?>

                <form action="delete.php" method="post" class="mt-1">
                    <input type="hidden"  name="id"value="<?php echo $row['id'] ?>">
                     <button type="submit" name="submit" class="btn btn-danger p-1">Delete </button> 
                   </form>
                 </td>
             </tr>
                   
<?php }
?>
              <?php   }

         }else{
             echo "<h2>No record found!</h2>";
         } ?>                           
         </tbody>
          </table>

          <br>

          
                    <a href="logout.php" data-toggle="modal" data-target="#logoutModal" class="btn btn-warning text-white">Logout</a>
                   

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
      </div>

    </div>

  </div>

  <!-------End --->
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
  <script src="./assets/demo/demo.js"></script>
  <script src="./app.js"></script>
    
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    feather.replace();
</script>         




