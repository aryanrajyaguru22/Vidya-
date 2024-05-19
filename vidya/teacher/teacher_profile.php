<html>
    <head>
        <link rel="stylesheet" href="css/teacher_profile.css"> 
    </head>
    <style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 2px;
        margin-left: -0.5%;
        margin-right: -0.45%;
        margin-top: -0.5%;
        margin-bottom: 2%;
        overflow: hidden;
        background-color: #333;
        position: sticky;
        top: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    li {
    float: left;

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
    padding-top: 25px;
}
.cc
{
    padding-right: 5%;
}
.pp{
    margin-left: 70%;
    /* margin-top: 25%; */
    margin-bottom: -29%;
}
    </style>
    <body>
        <div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="teacher_profile.php">Profile</a></li>
                <li ><a href="teacher_edit_profile.php">Edit profile</a></li>
                <li class="logout"><a href="logout.php">Log out</a></li>
            </ul>
        </div>
        <p class='container'>
        <img src="pro_pic/<?php profile(); ?>" style="height: 30%; width: 30%;" class="pp">
    </body>
</html>

<?php

function profile()
{   
    $con = mysqli_connect("localhost", "root", "", "vidya");
    $email = $_COOKIE["tlogin"];
    $query = "SELECT profile,gender FROM teacher WHERE email='$email';";
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

if (array_key_exists("home", $_POST)) {
    header("location:t_home.php");
}

$email = $_COOKIE["tlogin"];
$con = mysqli_connect("localhost", "root", "", "vidya");
$query = "SELECT * FROM teacher WHERE email='$email';";
$fire = mysqli_query($con, $query);


$row = mysqli_fetch_assoc($fire); //fetches raw in associtive array
if (!$row) {
    echo mysqli_error($con);
}

$sub = explode('|', $row["subjects"]);
echo "Name: " . $row["name"] . "<br><br>";
// echo "subjects:";
echo "Your selected subjects are <br><br>";
$i = 0;
$j = 1;
while ($i < sizeof($sub)) //for printing all the subject has been selected by the teacher
{
    echo "subject: " . $j." " . $sub[$i]. "<br>";
    $i++;
    $j++;
}
echo "<br>Your contact number: " . $row["tc_con"] . "<br><br>";
echo "Your location: " . $row["location"] . "<br><br>";

echo "Your selected time is " . $row["s_time"];
echo " to " . $row["e_time"] . "<br><br></p>";



if (isset($_POST["logout"])) //for log out button
{
    include 'logout.php';
}
if (array_key_exists("edit_profile", $_POST)) {
    header("location:teacher_edit_profile.php");
    // include "teacher_edit_profile.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher profile</title>
</head>

<body>
    <form action="" method="post">
        <div class="btn">
            <!-- <input type="submit" name="home" value="Home">
            <input type="submit" name="edit_profile" value="edit profile">
            <input type="submit" name="logout" value="log out"> -->
        </div>
    </form>
</body>
</html>
<footer>
        
        <label for="" class="cc">&#169 Vidya||2023</label> 
        <label for="" class="make">Devloped in India❤️</label>
        <a href="https://mail.google.com/mail/u/0/#inbox?compose=GTvVlcSKkkFSHDKZFJrpNKpjVgDhKKLLSXjMqnsnPwTWDGZmHVLdPMGtXlBfjMTBNTCWnRVqmkBzm">
            <img align="right" src="icons/gmail.png" alt="" height="40" width="40" class="img">
        </a>
        <a href="">
            <img align="right" src="icons/linkedin.png" alt="" height="40" width="40" class="img">
        </a>
    </footer>