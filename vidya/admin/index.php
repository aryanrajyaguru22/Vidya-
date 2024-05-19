<?php
    if(isset($_COOKIE["adlogin"]))
    {   
        $email=$_COOKIE["adlogin"];
        $con=mysqli_connect("localhost","root","","vidya");
        $query="SELECT password,roal FROM admin WHERE email='$email';";// start from heare you have retun idea in your book and stik to it just create 
        $fire=mysqli_query($con,$query);
        if(!$fire)
        {
            echo mysqli_error($con);
        }
        $roal=mysqli_fetch_assoc($fire);

        if ($roal["roal"]=="super") {
            header("location:ad_home.php");
        }
        elseif($roal["roal"]=="editor")
        {
            header("location:ad_home.php");
        }
        elseif($roal["roal"]=="changer")
        {
            header("location:sub.php");
        }
    }
    else
    {
        echo "<script>alert('looks like you hevent login how dare you do that????')</script>";
        header("location:login.php");
    }
?>


