<?php
if(!isset($_GET['token']))
{
    exit("can't find page");
}
    include '_dbconnect.php';
    $token=$_GET['token'];
    $sql="SELECT * FROM `reset_password` WHERE `token`='$token'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $num=mysqli_num_rows($result);
    if($num==0)
    {
        exit("Something goes wrong");
    }
    // echo var_dump($row);
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if(isset($_POST['cpass']) && isset($_POST['reset']))
        {
            $email=$row['email'];
            $cpass=$_POST['cpass'];
            $pass=$_POST['pass'];
            if($pass==$cpass)
            {
                $hash=password_hash($cpass,PASSWORD_DEFAULT);
                $sql="UPDATE `user` SET `password` = '$hash' WHERE `email`='$email'";
                $result=mysqli_query($conn,$sql);
                if($result)
                {
                    $sql="DELETE FROM `reset_password` WHERE `reset_password`.`token` = '$token'";
                    $result=mysqli_query($conn,$sql);
                }
                //echo var_dump($result);
            }
            else{
                echo "<center><h1>Please enter same password</h1></center>";
            }
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Reset Password</title>
    <style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    form {
        margin: 20px; 
    }
    .container{
        width:50%;
    }
    .btngroup {
        display: flex;
        /* justify-content: center; */
    }
    </style>
</head>

<body>
    <!-- <?php include 'partial/_signup_manage.php';?> -->
    <div class="container">
        <h2>
            <center>Change Password</center>
        </h2>
        <form action="<?php  $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class=" form-floating mb-3">
                <label for="Password" class="form-label"><b>Password</b></label>
                <br><br>
                <input type="password" class="form-control" name="pass" id="Password">
            </div>
            <div class=" form-floating mb-3">
                <label for="CPassword" class="form-label"><b>Confirm Password</b></label><br><br>
                <input type="password" class="form-control" name="cpass" id="CPassword">
            </div>
            <button type="submit" name="reset" class="btn btn-primary">Change</button>
        </form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>