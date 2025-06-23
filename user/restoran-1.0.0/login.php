<?php
session_start();
include "../../admin/connection.php";
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Food Ordering System Admin</title>
  <link rel="shortcut icon" type="image/png" href="../../admin/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../../admin/assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../../admin/assets/images/logos/logo.svg" alt="">
                </a>
                <p class="text-center">Food Ordering User Login</p>
                <form name="form1" action="" method="post">
                      <div class="form-gorup col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-danger col-md-12" id="errmsg" style="display: none;" >
                            <strong>Invalid!</strong><span style="color: red;">User details Invalid, so try again later</span>
                        </div>
                    </div>
                      <div class="form-gorup col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success col-md-12" id="success" style="display: none;" >
                            <strong>Success!</strong><span style="color: green;">User Login Successfully</span>
                        </div>
                    </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" >
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password"  class="form-control" id="exampleInputPassword1" name="password">
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New User?</p>
                    <a class="text-primary fw-bold ms-2" href="register.php">Click here to Register</a>
                  </div>
                  <div class="alert alert-danger" id="invalidusername" role="alert" style="display:none">
                    This Wrong Email and assword!
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
  <?php
  if(isset($_POST["submit"]))
  {
    
    
    $res=mysqli_query($link,"select * from user_register where name='$_POST[username]' && password='$_POST[password]'");
    $count=0;
 
    while($row=mysqli_fetch_array($res)){

        $_SESSION["user_username"]=$_POST["username"];
        $count=1;

        if(isset($_SESSION["checkout"])){
              ?>
        <script type="text/javascript">
              window.location="checkout.php"
            </script>
            <?php

        }
      
 
    else
    {

         ?>
        <script type="text/javascript">
          window.location="demo.php"
            </script>
            <?php
    }
    
  }
  if($count==0)
  {
       ?>
        <script type="text/javascript">
                 document.getElementById("errmsg").style.display="block";  

            </script>
            <?php
  } else
  {
      ?>
        <script type="text/javascript">
                 document.getElementById("success").style.display="block";  

            </script>
            <?php

     }
     }
  ?>
</body>

</html>
