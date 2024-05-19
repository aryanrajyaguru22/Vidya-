<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rejected_requests.css">
    <title>Rejected Reuests</title>
</head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 2px;
  margin-left: -0.5%;
  margin-right: -0.45%;
  margin-top: -0.5%;
  overflow: hidden;
  background-color: #333;
  position: sticky;
  top: 0;
  font-family: Arial, Helvetica, sans-serif;
}

li {
  float: left;
  /* border-right: 1px solid #bbb; */
  text-transform: uppercase;
  font-size: 0.88rem;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
li:last-child {
  border-right: none;
}


/* Change the link color to #111 (black) on hover */
li a:hover {
  background-color: #111;
}

.active {
  background-color: #04AA6D;
}
.logout
{
    background-color: red;
    float:right;
}
footer {
    text-align: center;
    padding-top: 10px;
    background-color: #333333;
    color: white;
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 40px;
    /* padding-left: -10px; */
    margin-left: -8px;
    text-align: center;  
    padding-bottom: 10px;
    /* Height of the footer */
}
.img
{
    /* align: right */
    margin-right: 50px;
    margin-bottom: 10px;
}
.make{
    float: left;
    padding-left: 10px;
    padding-top: 8px;
}
.cc
{
    padding-right: 5%;
}
</style>
<body>
<div>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="st_home.php">Find teacher</a></li>
          <li><a href="your_teachers.php">Your teacher</a></li>
          <li class="active"><a href="rejected_requests.php">Rejected request</a></li>
          <li><a href="student_edit_profile.php">Edit profile</a></li>
          <li><a href="pay.php">Pay</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>

        </ul>
    </div>
</body>
</html>

<?php
if(!isset($_COOKIE["login"]))
{
    echo "<script>alert('its looks like you don't have sign in please kindly sign in')</script>";
    header("location:index.php");
} 
    if(array_key_exists("profile",$_POST))
    {
        header("location:student_profile.php");
    }

    if(array_key_exists("re_request",$_POST))
    {
        $id= $_POST["id"];
        $con=mysqli_connect("localhost","root","","vidya");
        $query="SELECT * FROM requests WHERE unread = 1 AND rejecte = 1 AND id = '$id';";// start from heare you have retun idea in your book and stik to it just create 
        $fire=mysqli_query($con,$query);
        if(!$fire)
        {
            echo mysqli_error($con);
        }

        $row=mysqli_fetch_assoc($fire);

        $rc=$row["request_count"]+1;

        $update="UPDATE requests SET rejecte = 0, request_count = '$rc' WHERE id = '$id';";
        $fire_update=mysqli_query($con,$update);
        if(!$fire_update)
        {
            echo mysqli_error($con);
        }
    }
    $email=$_COOKIE["login"];
     $con=mysqli_connect("localhost","root","","vidya");
     $query="SELECT * FROM requests WHERE unread = 1 AND rejecte = 1 AND semail = '$email';";// start from heare you have retun idea in your book and stik to it just create 
     $fire=mysqli_query($con,$query);
     if(!$fire)
     {
         echo mysqli_error($con);
     }
     
     echo "<div class='cont'>";
     while($row=mysqli_fetch_assoc($fire))
     {
         echo "<div class='f_box'>"; 
         $tmail=$row["temail"];
         $smail=$row["semail"];
         $id=$row["id"];
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
         echo "<hr>";
         echo "from: ".$st["name"]."<br>For:".$te["name"]."<br>Subject: ".$row["subject"]."<br>Price: ".$row["price"];
         
         ?>
         <html>
             <body>
                 <form action="" method="post">
                     <br>
                     <input type="submit" name="re_request" value="request again">
                     <input type="hidden" name="id" value="<?php echo $id?>">
                 </form>
             </body>
         </html>
 
 <?php
     }
     echo "<hr> </div></div>";   

?>
<footer>
        
    <label for="" class="cc">Copyright &#169 2023 Vidya. All rights reserved</label> 
    <label for="" class="make">Devloped in India❤️</label>
    <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSKkkFSHDKZFJrpNKpjVgDhKKLLSXjMqnsnPwTWDGZmHVLdPMGtXlBfjMTBNTCWnRVqmkBzm">
        <img align="right" src="icons/gmail.png" alt="" height="40" width="40" class="img">
    </a>
    <a href="">
        <img align="right" src="icons/linkedin.png" alt="" height="40" width="40" class="img">
    </a>
</footer>