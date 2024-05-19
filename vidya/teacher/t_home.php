<!DOCTYPE html>
<html>

<head>
    <title>Teacher Homepage </title>
    <link rel="stylesheet" href="css/t_home.css">

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
</style>

<body>

    <div>
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="teacher_profile.php">Profile</a></li>
          <li ><a href="teacher_edit_profile.php">Edit profile</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>
        </ul>
    </div>

    <!--Profile Image-->
    <div id="" name="" class="cont">
        <div class="t_box">
            <!-- <div class="t_box2"> -->
                <a href="teacher_profile.php">
                    <img src="pro_pic/<?php profile(); ?>" alt="download" height="50" width="50">
                </a>
                <p><?php print_name(); ?></p>
                <hr>
                <!-- </div> -->
                
                <!-- Header -->
                <!-- <div id="" name="">  -->
                 <h1>Students:</h1>
            <!-- </div> -->
        </div>
    </div>
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

function unroll($id)
{
    $con = mysqli_connect("localhost", "root", "", "vidya");
    $update = "UPDATE requests SET teacher_reject=1,refund=1 where id='$id';";
    $fire_update = mysqli_query($con, $update);
    if ($fire_update) {
        echo "<script>alert('unroll secssesfull')</script>";
    } else {
        echo mysqli_error($con);
    }
}

function print_name() //for printing name on line 14
{
    $con = mysqli_connect("localhost", "root", "", "vidya");
    $email = $_COOKIE["tlogin"];
    $query = "SELECT name FROM teacher WHERE email='$email';";
    $fire = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($fire);
    echo $row["name"];
}

$con = mysqli_connect("localhost", "root", "", "vidya");

$email = $_COOKIE["tlogin"];

// $query="SELECT * FROM teacher WHERE email='$email';";
$query = "SELECT * FROM requests WHERE temail='$email' AND pay=1 AND student_reject = 0 AND teacher_reject = 0 AND orders=0;";

$fire = mysqli_query($con, $query);
if (!$fire) {
    echo mysqli_error($con);
}

while ($row = mysqli_fetch_assoc($fire)) {
    $students = $row["semail"];
    $select_student = "SELECT * FROM student WHERE email='$students';";
    $fire_select_student = mysqli_query($con, $select_student);
    if (!$fire_select_student) {
        echo mysqli_error($con);
    }

    $data = mysqli_fetch_assoc($fire_select_student);

    if ($data != null) {
        // echo $row["id"];
        // echo "----------------------------<br>";
        echo "<div class='t_box'>name of student is: " . $data["name"] . "<br>email: " . $data["email"] . "<br>contact number: " . $data["st_con"] . "<br>parants contact number: " . $data["p_st_con"] . "<br>subject:" . $row["subject"] . "<br>Preafer timming of student:<br>between " . $row["stime"] . " and " . $row["etime"];
?>

        <form action="" method="post">
            <br><input type="submit" name="unroll" value="unroll" class="btn">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        </form>

<?php
    }
    echo "</div>";
}
if (array_key_exists("unroll", $_POST)) {
    // echo $_POST["id"];
    unroll($_POST["id"]);
}

?>
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