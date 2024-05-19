<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="index.css">
    </head>
<body>
    <form action="" method="POST">
        <p>
            <input type="submit" name="tlogin" id="" value="Teacher login">
            <input type="submit" name="slogin" id="" value="Student login">
        </p>
    </form>
</body>
</html>

<?php
    if(isset($_POST["tlogin"]))
    {
        header("location:teacher");
    }
    if(isset($_POST["slogin"]))
    {
        header("location:student");
    }
?>