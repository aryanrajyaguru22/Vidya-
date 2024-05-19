<?php
if (!isset($_COOKIE["adlogin"])) {
    echo "<script>alert('its looks like you don't have sign in please kindly sign in')</script>";
    header("location:index.php");
}
include "send_mail.php";
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Changer</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="bs-simple-admin/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="bs-simple-admin/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="bs-simple-admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <link href="css/ad_home.css" rel="stylesheet" />
</head>
<style>
    .pp
    {
        font-size: 26px;
    }
</style>
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
                    <a class="navbar-brand" href="#">
                        <img src="assets/img/logo.png" />

                    </a>
                    
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
                 
                    <li class="active-link">
                        <a href="index.php" >Home </a>
                    </li>  
                    <li>
                        <a href="rejected_requests.php"></i>Rejected Requests</a>
                    </li>
                    <li>
                        <a href="sub.php">Edit Subjects</a>
                    </li>
                    <!-- <li>
                        <a href="add_admin.php">Add Admin</a>
                    </li> -->
                    <!-- <li>
                        <a href="edit_admins.php"></i>Edit Admin</a>
                    </li> -->
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
                
                    <!-- <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div> -->



<!-- <html> -->

<?php
// if (array_key_exists("logout", $_POST)) {
//     include "logout.php";
// }

// if (array_key_exists("payments", $_POST)) {
//     header("location:payment_veri.php");
// }

// if (array_key_exists("try", $_POST)) {
//     echo $_POST["name"];
//     echo $_POST['email'];
// }

// if (array_key_exists("verification", $_POST)) {
//     header("location:verification.php");
// }

// if (array_key_exists("add_ad", $_POST)) {
//     header("location:add_admin.php");
// }

// if (array_key_exists("edit_ad", $_POST)) {
//     header("location:edit_admins.php");
// }

// if (array_key_exists("rej_req", $_POST)) {
//     header("location:rejected_requests.php");
// }

// if (array_key_exists("edit_sub", $_POST)) {
//     header("location:sub.php");
// }

if (array_key_exists("approve_btn", $_POST)) {
    // update($_POST["id"]);
    $id = $_POST["id"];

    $send_email=$_POST["email"];
    $message="Please make a pay ment for ".$_POST["name"]." of Rs.".$_POST["price"];
    $subject="Payment reminder";
    $alert="request accepted and Payment reminder sent.";
    $flag=send_email($send_email,$subject,$message,$alert);
    if($flag==1)
    {
        $con = mysqli_connect("localhost", "root", "", "vidya");
        $update = "UPDATE requests SET unread = 0 WHERE id ='$id';";
        $fire = mysqli_query($con, $update);
        if (!$update) {
            echo mysqli_error($con);
        }
    }
}

if (array_key_exists("reject_btn", $_POST)) {
    reject($_POST["id"]);
    echo "<script>alert('request rejected.');</script>";
}



function reject($id)
{
    $con = mysqli_connect("localhost", "root", "", "vidya");
    $query = "UPDATE requests SET rejecte = 1 WHERE id='$id';";
    $fire = mysqli_query($con, $query);
    if (!$fire) {
        echo mysqli_error($con);
    }
}


$con = mysqli_connect("localhost", "root", "", "vidya");
$query = "SELECT * FROM requests WHERE unread = 1 AND rejecte = 0;"; // start from heare you have retun idea in your book and stik to it just create 
$fire = mysqli_query($con, $query);
if (!$fire) {
    echo mysqli_error($con);
}

while ($row = mysqli_fetch_assoc($fire)) {
    // echo $row["id"];
    $tmail = $row["temail"];
    $smail = $row["semail"];
    $sub = $row["subject"];
    $query1 = "SELECT name FROM  teacher WHERE  email='$tmail';"; //selects name from teacher table
    $query2 = "SELECT name,teachers,email FROM  student WHERE  email='$smail';"; //selects name from student table

    $fire1 = mysqli_query($con, $query1);
    if (!$fire1) {
        echo mysqli_error($con);
    }

    $fire2 = mysqli_query($con, $query2);
    if (!$fire2) {
        echo mysqli_error($con);
    }
    $st = mysqli_fetch_assoc($fire2);
    $te = mysqli_fetch_assoc($fire1);
    echo "<hr>";
    if ($row["request_count"] > 1) {
        echo "<p>from: " . $st["name"] . "<br>" . "For:" . $te["name"] . "<br>" . "subject :" . $sub . "<br>Price: " . $row["price"] . "<br>preafer timing for student: <br> between:" . $row["stime"] . " and " . $row["etime"] . "<br>No of requests: " . $row["request_count"];
    } else {
        echo "from: " . $st["name"] . "<br>" . "For:" . $te["name"] . "<br>" . "subject :" . $sub . "<br>Price: " . $row["price"] . "<br><br>preafer timing for student: <br> between:" . $row["stime"] . " and " . $row["etime"]."</p>";
    }
    
    $email=$row["semail"];
    $id = $row["id"];
    $name = $te["name"];
    $price=$row["price"];
?>
    <html>

    <!-- <body> -->
        <form action="" method="post">
            <br>
            <!-- <div class="btn"> -->
                <input type="submit" name="approve_btn" value="Approve" onclick="">
                <input type="submit" name="reject_btn" value="Reject" onclick="">
                <!-- <input type="submit" name="try" value="try" onclick=""> -->
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="email" value="<?php echo $email?>">
                <input type="hidden" name="name" value="<?php echo $name?>">
                <input type="hidden" name="price" value="<?php echo $price?>">
            <!-- </div> -->
        </form>
    <!-- </body> -->

    </html>

<?php
    echo "<hr>";
}

?>
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