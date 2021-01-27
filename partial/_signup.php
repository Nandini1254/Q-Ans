<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    include '_dbconnect.php';
    $uname=$_POST['uname'];
    $pass=$_POST['pass'];
    $email=$_POST['email'];
    $cpass=$_POST['cpass'];
    $valid=false;
   // $exist=false;
    $entry=false;
    if($cpass==$pass)
        $valid=true;
    // check exixt passwor
           $sql="SELECT * FROM `user` WHERE `email`='$email'";
           $result= mysqli_query($conn,$sql);  
           $rows=mysqli_num_rows($result);
           //echo var_dump($rows);
        if($rows>0)
        {
              header("location:_signup.php");
              echo "enter the details again";
        }
        else
        {
            if($valid)
            {
                $hash=password_hash($pass, PASSWORD_DEFAULT);
                $sql="INSERT INTO `user` (`username`, `email`, `password`) VALUES ('$uname', '$email', '$hash')";
                $result=mysqli_query($conn,$sql);
                if($result)
                    $entry=true;
            }
            else
            {
                header("location:_signup.php");
                echo "password does not match";
            }
        } 
        if($entry)
        {
            header("location: /FORUM/index.php?signup=true");
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

    <title>Log in</title>
    <style>
    * {
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
    }

    form {
        margin: 20px;
      
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
            <center>Sign up</center>
        </h2>
        <form action="<?php  $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class=" form-floating mb-3">
                <label for="uname" class="form-label"><b>Username</b></label>
                <br>
                <br>
                <input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp">
            </div>
            <div class=" form-floating mb-3">
                <label for="Email1" class="form-label"><b>Email address</b></label>
                <br>
                <br>
                <input type="email" class="form-control" id="Email1" name="email" aria-describedby="emailHelp">
            </div>
            <div class=" form-floating mb-3">
                <label for="Password" class="form-label"><b>Password</b></label>
                <br><br>
                <input type="password" class="form-control" name="pass" id="Password">
            </div>
            <div class=" form-floating mb-3">
                <label for="CPassword" class="form-label"><b>Confirm Password</b></label><br><br>
                <input type="password" class="form-control" name="cpass" id="CPassword">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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