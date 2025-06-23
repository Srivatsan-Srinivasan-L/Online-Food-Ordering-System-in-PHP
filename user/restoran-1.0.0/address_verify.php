<?php
session_start();
include "../../admin/connection.php";

   $_SESSION["address_verify"]="yes";
?>

<?php
 $name="";
  $email="";
   $contact_no="";
   $res=mysqli_query($link,"select * from user_register where name='$_SESSION[user_username]'");
   while($row=mysqli_fetch_array($res)){
    $name=$row["name"];
      $email=$row["email"];
        $contact_no=$row["contact_no"];
   }

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Address Verify</title>
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
                <p class="text-center">User Address Verify</p>
                <form method="post" action="" name="form1">
                
                  <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name ?>">

                  </div>
     
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"   value="<?php echo $email ?>"  aria-describedby="emailHelp">
                  </div>

                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Contact No</label>
                    <input type="text" name="contact_no" class="form-control" id="exampleInputEmail1"   value="<?php echo $contact_no ?>" aria-describedby="emailHelp">
                  </div>
                  <button href="" name="verify" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Verify</button>

              
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

$actual_link='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$url=explode('/',$actual_link);
array_pop($url);
$url=implode('/',$url)."/order_success.php";

$pay=$_SESSION["sub_total"];
$orderno=rand(111111,999999);
$_SESSION["orderno"]=$orderno;

if(isset($_POST["verify"]))
{
     mysqli_query($link,"update user_register set name='$_POST[name]',email='$_POST[email]',contact_no='$_POST[contact_no]' where name='$_SESSION[user_username]'");
     if($_SESSION["payment_type"]=="cod")
     {
         ?>
        <script type="text/javascript">
                  
                 window.location=" <?php echo $url ?>?orderno=<?php echo $orderno; ?>";

            </script>
            <?php

        } else
         {

           ?>
           <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="buyCredits" id="buyCredits">

            <input type="hidden" name="cmd" value="_xclick">
             <input type="hidden" name="business" value="srivatsan$gmail.com">
              <input type="hidden" name="currenty_code" value="USD">
                            <input type="hidden" name="item_name" value="payment for food">
                                                        <input type="hidden" name="item_number" value="">
                                                                                                                                                                                                                                <input type="hidden" name="amount" value="<?php echo $pay; ?>">

                                                                                    <input type="hidden" name="return" value="<?php echo $url;?>?orderno=<?php echo $orderno;?> ">





           </form>


             <script type="text/javascript">
                  

                 document.getElementById("buyCredits").submit();

            </script>
            <?php

            }
}


?>