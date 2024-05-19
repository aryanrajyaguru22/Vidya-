<?php
if (!isset($_COOKIE["login"])) {
    echo "<script>alert('It's looks like you don't have sign in please kindly sign in')</script>";
    header("location:index.php");
}

$email = $_COOKIE["login"];
$con = mysqli_connect("localhost", "root", "", "vidya");
$query = "SELECT * FROM student WHERE email='$email';";
$fire = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($fire);

// echo $row["profile"];

function profile()
{   
    $con = mysqli_connect("localhost", "root", "", "vidya");
    $email = $_COOKIE["login"];
    $query = "SELECT profile,gender FROM student WHERE email='$email';";
    $fire = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($fire);

    if($row["profile"]==null)
    {
        echo $row["gender"].".png";
        // echo "asd";
    }
    else
    {
        echo $row["profile"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/student_profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<style>

</style>
<body>
    <div>
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="st_home.php">Find teacher</a></li>
          <li><a href="your_teachers.php">Your teacher</a></li>
          <li><a href="rejected_requests.php">Rejected request</a></li>
          <li><a href="student_edit_profile.php">Edit profile</a></li>
          <li><a href="pay.php">Pay</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>
        </ul>
    </div>
</body>
</html>

<?php
 //fetches raw in associtive array
 
 echo "<p class='container'>Name: " . $row["name"] . "<br><br>";
 echo "Standard : ", $row["std"] . "<br><br>";
 echo "Your Contect Number: " . $row["st_con"] . "<br><br>";
 echo "Your Perents Contact Number: " . $row["p_st_con"] . "<br><br>";
 echo "Your Location: " . $row["location"] . "<br><br>";
 echo "Your Email is " . $row["email"]. "<br>";
 ?>
 <body>
     <img src="pro_pic/<?php profile(); ?>" class="imgprof"></p>
 </body>
    <form action="" method="post">
        <br>
        
        <div class="btn">
            <!-- <input type="submit" name="home" value="find teacher ">
            <br>
            <input type="submit" name="teachers" value="Your teachers">
            <br>
            <input type="submit" name="reject" value="Rejected request">
            <br>
            <input type="submit" name="edit" value="Edit profile">
            
            <br>
            <input type="submit" name="pay" value="Pay">
            <br>
            <input type="submit" name="logout" value="log out">  -->
        </div>
    </form>

    <footer>
        
        <label for="" class="cc">Copyright &#169 2023 Vidya. All rights reserved</label> 
        <label for="" class="make">Devloped in India❤️</label>
        <!-- <a href="">
            <img src="icons/vidya.png" alt="" height="50" width="50" align="right" class="img">
        </a> -->
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSKkkFSHDKZFJrpNKpjVgDhKKLLSXjMqnsnPwTWDGZmHVLdPMGtXlBfjMTBNTCWnRVqmkBzm">
            <img align="right" src="icons/gmail.png" alt="" height="40" width="40" class="img">
        </a>
        <a href="">
            <img align="right" src="icons/linkedin.png" alt="" height="40" width="40" class="img">
        </a><br>
        <img src="icons/vidya.png" alt="" height="50" width="50>

    </footer>
</body>

</html>
<?php 
// include "your_teachers.php";
 ?>