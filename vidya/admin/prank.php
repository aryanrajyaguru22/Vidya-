<style>
    .table
    {
        font-size: 30px;
    }
</style>
<html>
    <body>
        <table border="2px" align="center" style="margin-top:10%" class="table">
            <form action="" method="post">
            <tr>
                <td>
                    <label for="">enter email</label>
                </td>
                <td>
                    <input type="email" name="email" id="" placeholder="enter email" class="table" required><br>
                </td>
            </tr>
            <tr>
                <td>
                <label for="">enter subject</label>
                </td>
                <td>
                    <input type="text" name="subject" id="" placeholder="enter subject" class="table"><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">enter enter message</label>
                </td>
                <td>
                    <input type="text" name="message" id="" placeholder="enter message" class="table" required><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">enter how many time do you want to send message must be smaller than 33:</label>
                </td>
                <td>
                    <input type="number" name="counter" id="" class="table" required><br>
                </td>
            </tr>
            <tr>
                <td>
                <label for="">enter js aleart you want to displayed every time</label>
                </td>
                <td>
                    <input type="text" name="alert" id="" placeholder="let it be 0 if not any" class="table"><br><br>
                </td>
            </tr>
                <td>
                    <input type="submit" value="bomb bit-up" name="submit" style="background-color:red;" class="table">
                </td>
            </form>
        </table>
    </body>
</html>
<?php 
    if(isset($_POST["submit"]))
    {
        include "send_mail.php";
        $counter=1;
        while($counter<=$_POST["counter"])
        {
            $email=$_POST["email"];
            $subject=$_POST["subject"];
            $message=$_POST["message"];
            $alere=$_POST["alert"];
            send_email($email,$subject,$message,$alere);
            $counter++;
        }
    }
?>