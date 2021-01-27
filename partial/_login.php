 <?php
 if($_SERVER['REQUEST_METHOD']=='POST')
 {
     include '_dbconnect.php';
   //  $uname=$_POST['uname'];
     $pass=$_POST['pass'];
     $email=$_POST['email'];
     $sql="SELECT * FROM `user` WHERE `email`='$email'";
           $result= mysqli_query($conn,$sql);  
           $rows=mysqli_num_rows($result);
     if($rows==1)
     {
         $row=mysqli_fetch_assoc($result);
        // echo var_dump($row);
         if(password_verify($pass,$row['password']))
         {
             session_start();
             $_SESSION['login']=true;
             $_SESSION['email']=$email;
             $_SESSION['uname']=$row['username'];
            //  $_SESSION['id']=$row['user_id'];
            // echo $_SESSION['uname'];
             header("location: /FORUM/index.php");
         }
         else{
             echo "enter again details";
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

    <title>Log in</title>
    <style>
        .container{
            width:50%;
        }
    </style>
</head>

<body>
    <div class="container">
        <strong class="my=4" style="font-size:34px">Log in</strong>
        <form action="<?php  $_SERVER['REQUEST_URI'] ?>" method="post" class="my-4">
            <div class="mb-3">
                <label for="Email1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="Email1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <br>
            <hr>
            <a href="_request.php">Forgot Password</a>
            <hr>
            <a href="_signup.php">Don't have a account?</a>
            <hr>
        </form>

    </div>
<?php
//  echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/FORUM/partial/_request.php?token=12345";
?>
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