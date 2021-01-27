<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>comments</title>
    <style>
    .container-fluid{
            min-height: 500px;
        }
    </style>
</head>

<body>
    <?php include 'partial/_header.php'; 
    include 'partial/_dbconnect.php';
    ?>
    <div class="container-fluid my-3">
        <?php
        
        $id=$_GET['getid'];
        //echo $id;
        $sql="SELECT * FROM `threads` WHERE thread_id=$id";
        // if($sql)
        //  echo true;
        $result= mysqli_query($conn,$sql);
        $row= mysqli_fetch_assoc($result);
    ?>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1>Title: <?php echo $row['thread_name'];?></h1>
                <p><?php echo $row['thread_desc'];?></p>
                <p>Posted by:<b> <?php echo $row['thread_user']; ?></b></p>
            </div>
        </div>
        <?php
          $noresult=true;
          $sql="SELECT * FROM `comment` WHERE thread_id=$id";
          // if($sql)
          //  echo true;
          $result= mysqli_query($conn,$sql);  
           while($row= mysqli_fetch_assoc($result))
           {
               //echo var_dump($row);
               $noresult=false;
               echo ' <div class="media my-1">
               <img class="mr-3 " width="50px" src="https://cdn.onlinewebfonts.com/svg/img_184513.png" alt="Generic placeholder image">
               <div class="media-body">
                   <h3>'.$row['username'].'</h3>
                   <h6>'.$row['comment_time'].'</h6>
                   <p>'.$row['comment_content'].'</p>   
               </div>
           </div>';
           }
        
        
        ?>
        <div class="container my-3">
            <h1>Add a comment</h1>
            <form action="<?php $_SERVER['REQUEST_URI']?>" method="post">
                <div class="form-group">
                    <textarea name="comment" id="comment" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-success my-3">Submit</button>
            </form>
        </div>
        <?php
//$id=$_GET['getid'];
         //echo $id;
         $request=$_SERVER['REQUEST_METHOD'];
         if($request=="POST")
         {
           $isresult=false;
           if(isset($_SESSION['login']))
                {
                    $comment=$_POST['comment'];
                    $user=$_SESSION['uname'];
                    $sql="INSERT INTO `comment` (`thread_id`, `comment_content`,`username`,`comment_time`) VALUES ('$id','$comment','$user',current_timestamp());";
                    $result= mysqli_query($conn,$sql);
                    if($result)
                         $isresult=true;
                         if($isresult)
                         {
                           echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                           <strong>successfully inserted!</strong>
                         </div>
                         ';
                         } 
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>You are not logged in please login<a href="partial/_login.php">Log in</a></strong>
                  </div>
                  ';
                 }
           
        }
        // if($sql)
        //   echo true;
       
      ?>
    </div>
    </div>
    <?php include 'partial/_footer.php';?>
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