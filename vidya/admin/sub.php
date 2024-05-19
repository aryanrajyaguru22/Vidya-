<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Subjects</title>
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
                    <li class="active-link">
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
    $flag=0;
    $data = file_get_contents("./sub.txt");
    $data_arr=explode(",",$data);
    if($data_arr[0]==null)
    {
        $flag=1;
    }
    // echo $data;
    // print_r($data_arr);

    function uplode($sub,$per)
    {
        global $data,$flag;
        if($flag==0)
        {
            $new_data=rtrim($data);
            $newsub=$new_data.",".$sub.",".$per;
            file_put_contents("./sub.txt", $newsub);
        }
        else
        {
            $newsub=$data.$sub.",".$per;
            file_put_contents("./sub.txt", $newsub);
        }
    }

    function delete($key)
    {
        global $data_arr;
        $data_arr2=$data_arr;
        $subtodel = array_search($key,$data_arr2);
        $pertodel = $subtodel+1;
        // echo $subtodel;
        unset($data_arr2[$subtodel]);
        unset($data_arr2[$pertodel]);
        // print_r($data_arr2);
        $newsubjects=implode(",",$data_arr2);
        // echo $newsubjects;
        file_put_contents("./sub.txt", $newsubjects);

    }

if(array_key_exists("home",$_POST))
{
    header("location:index.php");
}

if(array_key_exists("add",$_POST))
{
    uplode($_POST["sub"],$_POST["per"]);
    echo "<script>alert('subject has been added.')</script>";

}

if(array_key_exists("delete_sub",$_POST))
{
    delete($_POST["key"]);
    echo "<script>alert('subject deleted done.')</script>";
}

end($data_arr);
$key=key($data_arr);
$i=0;?>

<table>
    <th>subject</th>
    <th>percantage</th>
    
    <?php
while($i<$key)
{?>
    <tr>
        <td align="center">
            <?php echo $data_arr[$i] ?>
        </td>
        <td align="center">
            <?php echo $data_arr[$i+1] ?>
        </td>
        <td>
        <form action="" method="post">
            <input type="submit" value="delete" name="delete_sub" style="margin-left: 15px;">
            <input type="hidden" name="key" value="<?php echo $data_arr[$i] ?>">
        </form>
    </td>
    </tr>
    <?php
$i+=2;
}
?>
<form action="" method="post">
    <tr>
        <td>
            <input type="text" name="sub" id="">
        </td>
        <td>
            <input type="number" name="per" id="">
        </td>
        <td>
            <input type="submit" value="add" name="add" style="margin-left: 15px;">
        </td>
    </tr>

</form>
</table>

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

