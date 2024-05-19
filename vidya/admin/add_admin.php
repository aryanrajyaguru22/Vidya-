<?php
    // session_start();
    if (!isset($_COOKIE["adlogin"])) {
        echo "<script>alert('its looks like you don't have sign in please kindly sign in')</script>";
        header("location:index.php");
    }
    include "send_mail.php";
    function send_otp($email)
    {
        $otp=rand(100000,999999);
        // $_SESSION["otp"]=$otp;
        // $email=$_SESSION["email"];
        $subject="OTP";
        $message="your vidya verification otp is ".$otp;
        $alert="verification has been send ";
        send_email($email,$subject,$message,$alert);
        return $otp;
    }
function rbac()
{
    $email=$_COOKIE["adlogin"];
    $con = mysqli_connect("localhost", "root", "", "vidya");
    $select_ad="SELECT * from admin WHERE email = '$email'";
    $fire_select_ad = mysqli_query($con, $select_ad);
    if (!$fire_select_ad) {
        echo mysqli_error($con);
    }

    $row_role=mysqli_fetch_assoc($fire_select_ad);
    $role=$row_role["roal"];

    // global $con;
    $select = "SELECT * from role WHERE name='$role';";
    $fire_select = mysqli_query($con, $select);
    if (!$fire_select) {
        echo mysqli_error($con);
    }
    $row=mysqli_fetch_assoc($fire_select);
    $fname=basename($_SERVER['PHP_SELF'], '.php');

    // $dbfname=$row[$fname];
    // echo $dbfname;
    
    if($row[$fname]==0)
    {
        echo "<script>alert('You dont have access this page');</script>";
        echo "<script>window.history.back();</script>";
    }
}
rbac();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="bs-simple-admin/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="bs-simple-admin/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="bs-simple-admin/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>       
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="#">
                        <img src="assets/img/logo.png" />
                    </a> -->
                    
                </div>
              
                <span class="logout-spn" >
                  <a href="logout.php" style="color:#fff;">LOGOUT</a>  

                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                 
                    <li>
                        <a href="index.php" >Home </a>
                    </li>  
                    <li>
                        <a href="rejected_requests.php"></i>rejected requests</a>
                    </li>
                    <li>
                        <a href="sub.php">Edit subjects</a>
                    </li>
                    <li class="active-link">
                        <a href="add_admin.php">Add Admin</a>
                    </li>
                    <li>
                        <a href="edit_admins.php"></i>Edit Admin</a>
                    </li>
                    <li>
                        <a href="verification.php">Teacher Verification</a>
                    </li>
                    <li>
                        <a href="payment_veri.php">Payments Verification</a>
                    </li>
                    
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                     <h2>ADMIN DASHBOARD</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">


    <!-- all back end -->
    <form action="" method="post">
        <!-- <input type="submit" value="home" name="home"><br><br> -->

        <label for="">admin email:</label>
        <input type="email" name="email"><br><br> 

        <label for="">select roal of admin:</label>
        <select name="roal" id="">Select roal
            <option value="">--Select--</option>
            <option value="editor">editor</option>
            <option value="changer">changer</option>
        </select><br><br>

        <input type="submit" name="add" value="add">
    </form>

<?php
    if(array_key_exists("add",$_POST))
    {
        // $email=$_COOKIE["adlogin"];
        $email=$_POST["email"];
        $otp=send_otp($email);
        $roal=$_POST["roal"];
        $con=mysqli_connect("localhost","root","","vidya");
        $query="INSERT INTO admin (email,roal,password) VALUES ('$email','$roal','$otp');";// start from heare you have retun idea in your book and stik to it just create 
        $fire=mysqli_query($con,$query);
        if(!$fire)
        {
            echo mysqli_error($con);
        }
        else
        {
            echo "<script>alert('admin added successfully')</script>";
        }
    }
    if(array_key_exists("home",$_POST))
    {
        header("location:index.php");
    }
?>

</div>
                </div>

                  <!-- /. ROW  --> 
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>
                </div>
            </div>
        </div>
          

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</body>
</html>