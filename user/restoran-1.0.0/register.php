<?php
include "../../admin/connection.php";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flexy Free Bootstrap Admin Template by WrapPixel</title>
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
                <p class="text-center">User Food Ordering System</p>
                <form method="post" action="" name="form1">
                    <div class="form-gorup col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-danger col-md-12" id="errmsg" style="display: none;" >
                            <strong>Invalid!</strong><span style="color: red;">This username already register</span>
                        </div>
                    </div>
                      <div class="form-gorup col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-success col-md-12" id="success" style="display: none;" >
                            <strong>Success!</strong><span style="color: green;">User Inserted</span>
                        </div>
                    </div>
                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputtext1" placeholder="User Name" aria-describedby="textHelp">
                  </div>
                
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" id="exampleInputPassword1">
                  </div>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"  placeholder="Email Id"  aria-describedby="emailHelp">
                  </div>

                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Contact No</label>
                    <input type="text" name="contact_no" class="form-control" id="exampleInputEmail1"  placeholder="Mobile No" aria-describedby="emailHelp">
                  </div>
                  <button href="" name="register" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>

                  <div class="d-flex align-items-center justify-content-center">
                  
                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                    <a class="text-primary fw-bold ms-2" href="login.php">Login</a>
                   
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>


<?php

if(isset($_POST["register"]))
{

    $count=0;
    $res=mysqli_query($link,"select * from user_register where name='$_POST[name]'");
    $count=mysqli_num_rows($res);
    if($count >0){
       ?>
       <script type="text/javascript">
       document.getElementById("errmsg").style.display="block"; 

       </script>
       
        <?php
    }
    else {
   mysqli_query($link,"insert into user_register(id,name,password,email,contact_no) values(NULL,'$_POST[name]','$_POST[password]','$_POST[email]','$_POST[contact_no]')");
   ?>
     <script type="text/javascript">
       document.getElementById("success").style.display="block";  
      setTimeout(function(){
        window.location="login.php";
      },2000);
       </script>
       
        <?php

        }
}



?>