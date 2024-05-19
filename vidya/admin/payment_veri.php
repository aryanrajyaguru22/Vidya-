<?php
    session_start();
    if (!isset($_COOKIE["adlogin"])) {
        echo "<script>alert('its looks like you don't have sign in please kindly sign in')</script>";
        header("location:index.php");
    }
    include "send_mail.php";
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
    <title>Payment Verification</title>
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
                    <li>
                        <a href="edit_admins.php"></i>Edit Admin</a>
                    </li>
                    <li>
                        <a href="verification.php">Teacher Verification</a>
                    </li>
                    <li class="active-link">
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

    $con = mysqli_connect("localhost", "root", "", "vidya");
    $query = "SELECT * FROM requests WHERE orders!=0;";
    $fire = mysqli_query($con, $query);
    if (!$fire) {
        echo mysqli_error($con);
    }

    while($row=mysqli_fetch_assoc($fire))
    {
        // $name=$row["name"];
        $temail=$row["temail"];
        $semail=$row["semail"];
        // $contact=$row["tc_con"];
        // $gender=$row["gender"];
        // $age=$row["age"];
        // $s_time=$row["s_time"];
        // $e_time=$row["e_time"];
        // $message=$row["message"];
        $documents=$row["orders"];


        $query_student = "SELECT * FROM student WHERE email='$semail';";
        $fire_student = mysqli_query($con, $query_student);
        if (!$fire_student) {
            echo mysqli_error($con);
        }
        $student=mysqli_fetch_assoc($fire_student);
        $sname=$student["name"];
        $seacher_email=$temail;
        $scon=$student["st_con"];


        ?>
        <html>
            <body>
                <?php
                    echo "name: ".$sname."<br>";
                    echo "email: ".$semail."<br>";
                    echo "contact: ".$scon."<br>";
                    // echo "age: ".$age."<br>";
                    // echo "message: ".$message."<br>";
                    // echo $documents;
                ?>
                <br>
                <form action="" method="post">
                    <input type="submit" value="show document" name="show">
                    <input type="submit" value="verify" name="verified">
                    <!-- <input type="submit" value="prank" name="prank"> -->
                    <input type="hidden" value="<?php echo $documents;?>" name="img">
                    <input type="hidden" value="<?php echo $temail;?>" name="temail">
                    <input type="hidden" value="<?php echo $semail;?>" name="semail">
                </form>
            </body>
        </html>
        <?php
    }
    if(array_key_exists("show",$_POST))
    {
        $_SESSION["img"]=$_POST["img"];
        header("location:pay_doc.php");
    }

    // if(array_key_exists("prank",$_POST))
    // {
    //     $i=0;
    //     while($i<50)
    //     {
    //         $email=$_POST["email"];
    //         $alert="mail sestudent";
    //         $veri="verificarion complited";
    //         $message=" now you can login at vidya.please fill free to access your account and if possible please give a review on our website";
    //         $file="documents/".$_POST["img"];
    //         $flag=send_email("aryanrajyaguru22@gmail.com",$veri,$message,$alert,$next_file);
    //     }
    //     echo "<script>alert('its looks like you don't have sign in please kindly sign in')</script>";

    // }

    if(array_key_exists("verified",$_POST))
    {
        $email=$_POST["temail"];
        $id=$_SESSION["id"];
        $file="documents/".$_POST["img"];
        $email1=$email;
        $alert1="done";
        $message1="a new student is assign to you please visit website";
        $veri1="new student";
        $flag=send_email($email1,$veri1,$message1,$alert1);
        if($flag==1)
        {
            $alert="mail sent to teacher";
            $veri="payment verificarion complited";
            $message="payment verification complited now you will be able to see teacher details on your home page";
            $semail=$_POST["semail"];
            send_email($semail,$veri,$message,$alert);
            $query = "UPDATE requests SET orders=0,pay=1 WHERE id='$id';"; 
            // $fire = mysqli_query($con, $query);
            if (!$fire) {
                echo mysqli_error($con);
            }
            echo $id;
            print_r($_SESSION);
            // unlink($file);
            // $_SESSION["done"]=1;
        }
        // header("location:verification");
        // header("location:Refresh:0");
        ?>
            <script>
                location
            </script>
        <?php
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