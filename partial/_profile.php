<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Edit profile</title>
    <style>
        .container{
            width:50%;
            border:1px solid black;
            margin:50px;
        }
        form{
            padding:3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
                 session_start();
                 $id=$_SESSION['email'];
                 $name=$_SESSION['uname'];
               
                 ?>
        <form  action="<?php  $_SERVER['REQUEST_URI'] ?>" method="post">
            <fieldset>
                <div class="mb-3">
                    <label  class="form-label">
                        <legend>Username</legend>
                    </label>
                    <input type="text" class="form-control" name="uname2" placeholder="<?php echo $name; ?>">
                </div>
                <div class="mb-3">
                    <button type="submit" name="passChange" class="btn btn-primary">Change PassWord</button>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </fieldset>
        </form>
    </div>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
    include '_dbconnect.php';
  //  $uname=$_POST['uname'];
    if(isset($_POST['submit']))
    {
        $new=$_POST['uname2'];
       $sql="UPDATE `user` SET `username` = '$new' WHERE `user`.`email` = '$id'" ;
       $result=mysqli_query($conn,$sql);
       $_SESSION['uname']=$new;
       //echo var_dump($result);
    }
    if(isset($_POST['passChange']))
    {
        header("location: _request.php");
    }
}


?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>