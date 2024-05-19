<?php 
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
    <title>Edint Admin</title>
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
                    <li>
                        <a href="add_admin.php">Add Admin</a>
                    </li>
                    <li class="active-link">
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
                       

<?php

    if(array_key_exists("home",$_POST))
    {
        header("location:index.php");
    }

    $con=mysqli_connect("localhost","root","","vidya");
    $query="SELECT * FROM admin WHERE roal != 'super' ;";// start from heare you have retun idea in your book and stik to it just create 
    $fire=mysqli_query($con,$query);
    if(!$fire)
    {
        echo mysqli_error($con);
    }
    while($row=mysqli_fetch_assoc($fire))
    {
        echo "Name: ".$row["name"]."<br><br>";
        echo "email: ".$row["email"]."<br><br>";
        $email=$row["email"];
        ?>
        <form action="" method="post">
            Roal:
            <select name="roal" id="">
                <option value="editor" <?php if($row["roal"]=="editor"){echo "selected";} ?> >editor</option>
                <option value="changer"<?php if($row["roal"]=="changer"){echo "selected";} ?>>changer</option>
            </select><br><br>
            <input type="submit" value="change" name="change">
            <input type="submit" value="delete" name="delete">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            
        </form>
        <?php
        echo "---------------------<br>";
    }


    
    if(array_key_exists("delete",$_POST))
    {
        $email_de=$_POST["email"];
        // echo $email_de;
        $delete="DELETE FROM admin WHERE email = '$email';";// start from heare you have retun idea in your book and stik to it just create 
        $fire=mysqli_query($con,$delete);
        if(!$fire)
        {
            echo mysqli_error($con);
        }
        else
        {
            echo "<script>alert('admin deleted successfully')</script>";
        }
    }
    
    if(array_key_exists("change",$_POST))
    {
        $email_ch=$_POST["email"];
        $roal=$_POST["roal"];
        // echo $email_de;
        $change="UPDATE admin SET roal='$roal' WHERE email = '$email_ch' ;";// start from heare you have retun idea in your book and stik to it just create 
        $fire=mysqli_query($con,$change);
        if(!$fire)
        {
            echo mysqli_error($con);
        }
        else
        {
            echo "<script>alert('admin roal has been changed')</script>";
        }
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