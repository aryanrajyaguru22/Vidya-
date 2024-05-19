<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/feedback.css">
    <title>Feedback</title>
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
  border-right: 1px solid #bbb;
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
    /* padding-left: -10px; */
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
          <li><a href="index.php">Home</a></li>
          <li><a href="st_home.php">Find teacher</a></li>
          <li  class="active"><a href="your_teachers.php">Your teacher</a></li>
          <li><a href="rejected_requests.php">Rejected request</a></li>
          <li><a href="student_edit_profile.php">Edit profile</a></li>
          <li><a href="pay.php">Pay</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>
        </ul>
    </div>
    <div class="cont">
        <div class="f_box">
            <form action="" method="post">
                <!-- <input type="submit" value="back" name="back"><br><br> -->
                <table align="center">
                    <tr>
                        <td>
                            <label for="">Knowledge:</label>
                        </td>
                        <td>
                            <input type="number" name="knowledge" min="1" max="5"><br><br>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label for="">teaching:</label>
                        </td>
                        <td>
                            <input type="number" name="teaching" min="1" max="5"><br><br>
                        </td>
                    </tr>
            
                    <tr>
                        <td>
                            <label for="">Knowledge delivery</label>
                        </td>
                        <td>
                            <input type="number" name="know_deli" min="1" max="5"><br><br>
                        </td>
                    </tr>
        
                    <tr>
                        <td>
                            <label for="">speech:</label>
                        </td>
                        <td>
                            <input type="number" name="speech" min="1" max="5"><br><br>
                        </td>
                    </tr>
                </table><br>
                <input type="submit" value="submit" name="submit">
            </form>
        </div>
    </div>
</body>
</html>

<?php
    session_start();

    if(isset($_POST["back"]))
    {
        header("location:your_teachers.php");
    }

    if(isset($_POST["submit"]))
    {
        $kn=$_POST["knowledge"];
        $knde=$_POST["know_deli"];
        $teachinge=$_POST["teaching"];
        $speech=$_POST["speech"];
        $id=$_SESSION["id"];
        $avg_per_request=($kn+$knde+$teachinge+$speech)/4;

        $con=mysqli_connect("localhost","root","","vidya");
        $update="UPDATE requests SET rating='$avg_per_request' where id='$id';";
        $fire_update=mysqli_query($con,$update);
        if($fire_update)
        {
            echo "<script>alert('".$avg_per_request." stars are submited out of 5.')</script>";
        }
        else {
            echo mysqli_error($con);
        }
        // header("location:your_teachers.php");
    }


?>