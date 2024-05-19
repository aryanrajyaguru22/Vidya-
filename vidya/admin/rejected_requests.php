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
    <title>Rejected Requests</title>
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
                        <a href="ad_home.php">Home </a>
                    </li>  
                    <li class="active-link">
                        <a href="rejected_requests.php"></i>Rejected Requests</a>
                    </li>
                    <li>
                        <a href="sub.php">Edit Subjects</a>
                    </li>
                    <li>
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
                       

<?php
    if(array_key_exists("home",$_POST))
    {
        header("location:index.php");
    }

     $con=mysqli_connect("localhost","root","","vidya");
     $query="SELECT * FROM requests WHERE unread = 1 AND rejecte = 1;";// start from heare you have retun idea in your book and stik to it just create 
     $fire=mysqli_query($con,$query);
     if(!$fire)
     {
         echo mysqli_error($con);
     }
     
     while($row=mysqli_fetch_assoc($fire))
     {
         $tmail=$row["temail"];
         $smail=$row["semail"];
         $query1="SELECT name FROM  teacher WHERE  email='$tmail';";//selects name from teacher table
         $query2="SELECT name,teachers FROM  student WHERE  email='$smail';";//selects name from student table
 
         $fire1=mysqli_query($con,$query1);
         if(!$fire1)
         {
             echo mysqli_error($con);
         }
 
         $fire2=mysqli_query($con,$query2);
         if(!$fire2)
         {
             echo mysqli_error($con);
         }
         $st=mysqli_fetch_assoc($fire2);
         $te=mysqli_fetch_assoc($fire1);
         echo "<br><br>";
         echo "from: ".$st["name"]."<br>"."For:".$te["name"]."<br>"."subject: ".$row["subject"]."<br>Price: ".$row["price"];
         
         ?>
         <html>
             <body>
                 <form action="" method="post">
                     <br>
                     <!-- <input type="submit" name="approve_btn" value="approve"> -->
                 </form>
             </body>
         </html>
 
 <?php
     echo "<hr>";
     
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