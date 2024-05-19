<html>
    <head>
        <title>Pay</title>
        <link rel="stylesheet" href="css/pay.css">
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
    padding-top: 8px;
}
.cc
{
    padding-right: 5%;
}
</style>
    <body>

        <div class="cont">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="st_home.php">Find teacher</a></li>
          <li><a href="your_teachers.php">Your teacher</a></li>
          <li><a href="rejected_requests.php">Rejected request</a></li>
          <li><a href="student_edit_profile.php">Edit profile</a></li>
          <li class="active"><a href="pay.php">Pay</a></li>
          <li class="logout"><a href="logout.php">Log out</a></li>
        </ul>
        <form action="" method="post">
            <!-- <input type="submit" name="profile" value="your profile" id="profile"><hr> -->
        </form>
    </body>
</html>
<?php
session_start();

if(!isset($_COOKIE["login"]))
    {
        echo "<script>alert('It's looks like you don't have sign in please kindly sign in')</script>";
        header("location:index.php");
    } 

    include "send_mail.php";

    function update($id)// updates student table
    {
        $con=mysqli_connect("localhost","root","","vidya");

        $query="SELECT * FROM requests WHERE unread = 0 AND rejecte = 0 AND pay=0 AND id=$id;";
        $fire=mysqli_query($con,$query);
        if(!$fire)
        {
            echo mysqli_error($con);
        }

        $row=mysqli_fetch_assoc($fire);

        $tmail=$row["temail"];// teacher email
        $smail=$row["semail"];//student mail
        //for updating teacher in student table 
        $query2="SELECT teachers FROM  student WHERE  email='$smail';";//selects name from student table
        
        $fire2=mysqli_query($con,$query2);
        if(!$fire2)
        {
            echo mysqli_error($con);
        }
        $st=mysqli_fetch_assoc($fire2);
        
        if($st["teachers"]==null)
        {
            $teachers=explode('|',$st["teachers"]);//$ teacher is an array now
            array_pop($teachers);
            array_push($teachers,"$tmail");
            $itea=implode('|',$teachers);
        }
        else if($st["teachers"]!=null)
        {
            $teachers=explode('|',$st["teachers"]);//$ teacher is an array now
            array_push($teachers,"$tmail");
            $itea=implode('|',$teachers);
        }
        $update="UPDATE student SET teachers='$itea' WHERE email='$smail';";
        
        //for updating student in teacher table
        $fire_update=mysqli_query($con,$update);
        if(!$fire_update)
        {
            echo mysqli_error($con);
        }

        $query1="SELECT students FROM  teacher WHERE  email='$tmail';";//selects name from teacher table
        $fire1=mysqli_query($con,$query1);
        if(!$fire1)
        {
            echo mysqli_error($con);
        }
        $te=mysqli_fetch_assoc($fire1);

        if($te["students"]==null)
        {
            $students=explode('|',$te["students"]);//$ teacher is an array now
            array_pop($students);
            array_push($students,"$smail");
            $stu=implode('|',$students);
        }
        else if($te["students"]!=null)
        {
            $students=explode('|',$te["students"]);//$ teacher is an array now
            array_push($students,"$smail");
            $stu=implode('|',$students);
        }
        $update_student="UPDATE teacher SET students='$stu' WHERE email='$tmail';";

        $fire_update=mysqli_query($con,$update_student);
        if(!$fire_update)
        {
            echo mysqli_error($con);
        }
        
    }
    
    if(array_key_exists("pay",$_POST))
    {
        
        // $email=$_POST["temail"];
        // $subject="A new student for you";
        // $message="Hear is your new student ";
        // $alert="payment seccessful.";
        // $flag=send_email($email,$subject,$message,$alert);
        // if($flag==1)
        // {
        //     // echo "gdf";
            // $id=$_POST["id"];
        //     update($id);
        //     $con=mysqli_connect("localhost","root","","vidya");
        //     $update="UPDATE requests SET pay = 1 WHERE id ='$id';";
        //     $fire=mysqli_query($con,$update);
        //     if(!$update)
        //     {
        //         echo mysqli_error($con);
        //     }
        // }
        $_SESSION["id"]= $_POST["id"];           
        header("location:payment.php"); 
    } 

    if(array_key_exists("cancel",$_POST))
    {
        $id=$_POST["id"];
        $con=mysqli_connect("localhost","root","","vidya");
        $update="UPDATE requests SET student_rejetct_pay = 1 WHERE id ='$id';";
        $fire=mysqli_query($con,$update);
        if(!$update)
        {
            echo mysqli_error($con);
        }
        else
        {
            echo "<script>alert('Payment cancelled.');</script>";
        }
    }
    

    if(array_key_exists("profile",$_POST))
    {
        header("location:student_profile.php");
    } 

    if(array_key_exists("try",$_POST))
    {
        // header("location:student_profile.php");
        echo $_POST["temail"];
        // echo $_POST["id"];
        // $id=$_POST["id"];
        // $connection=mysqli_connect("localhost","root","","vidya");
        // $query="SELECT * FROM requests where id='$id';";
        // $fire_teacherdata=mysqli_query($connection,$query);
        // if(!$fire_teacherdata)
        // {
        //     echo mysqli_error($connection);
        // }
        // $getdata=mysqli_fetch_assoc($fire_teacherdata);

        // // header("location:student_profile.php");
        // $email=$getdata["temail"];

        // echo $email;
    } 

    

    $email=$_COOKIE["login"];
    $con=mysqli_connect("localhost","root","","vidya");
    $query="SELECT * FROM requests WHERE semail='$email' AND unread = 0 AND rejecte = 0 AND pay = 0 AND student_rejetct_pay=0 AND pay_veri=0;";
    $fire=mysqli_query($con,$query);
    if(!$fire)
    {
        echo mysqli_error($con);
    }

    $sum=0;
    while($row=mysqli_fetch_assoc($fire))
    {
        echo "<div class='f_box'>";
        $id=$row["id"];
        $temail=$row["temail"];
        // $teacher_arr=explode('|',$row["temail"]);
        // $i=0;
        // while($i<sizeof($teacher_arr))
        // {
            $select_from_requests="SELECT rating from requests where temail='$temail';";
            $fire_select_requests=mysqli_query($con,$select_from_requests);
            $no_of_row=mysqli_num_rows($fire_select_requests);
            $flag=0;

            if($no_of_row>0)
            {
                while($row_select=mysqli_fetch_assoc($fire_select_requests))
                {
                    $no_row=mysqli_num_rows($fire_select_requests);
                    $sum+=$row_select["rating"];
                    $avg=$sum/$no_row;
                }
                $count=mysqli_num_rows($fire_select_requests);
                $flag=1;
            }
            $select_teacher="SELECT * FROM teacher WHERE email='$temail';";
            $fire_select_teacher=mysqli_query($con,$select_teacher);
            if(!$fire_select_teacher)
            {
                echo mysqli_error($con);
            }
            $data=mysqli_fetch_assoc($fire_select_teacher);
            if ($data!=null) 
            {
                // echo "<hr>";
                echo "Name of teacher is: ".$data["name"]."<br><br>Bio: ". $data["bio"] ."<br><br>Subject: ". $row["subject"] ."<br><br>fees: ".$row["price"]."<br><br>";
                if($flag==1)
                {
                    echo "<br>total rating: " . round($avg,2) ." number of rating ".$count;
                }
                else
                {
                    echo "<br>This teacher is new at this site";
                }
            ?>
            <html>
                <body>
                    <form action="" method="post">
                        <input type="submit" name="pay" value="Pay" id="pay">
                        <input type="submit" name="cancel" value="Cancel" id="cancel" style="background-color: #cc0000;">
                        <!-- <input type="submit" name="try" value="try" id="cancel"> -->
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="temail" value="<?php echo $temail ?>">
                    </form>
                </body>
            </html>
            <?php
                // echo "----------------------------";

            }
            else
            {
                // echo "there is no teachers";
                echo "<script>alert('There is no teachers')</script>";

            }
            // $i++;
        // }
    }
    echo "</div></div>";
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