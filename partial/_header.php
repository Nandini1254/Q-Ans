<?php
session_start();
$logged=false;
$active="deactive";
//echo $_SESSION['uname'];
if(isset($_SESSION['uname']) || isset($_SESSION['pass']))
{
     $logged=true;
    // echo "%";
}
if(isset($_SESSION['contact']))
{
  //echo $_SESSION['contact'];
  if($_SESSION['contact'])
        $active="active";
}
// echo $active;
echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="forum">Q&A</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="/forum">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
         <a class="nav-link '.$active.'" href="contact.php" >Contact</a>
    </li>
  </ul>
  <form action="'.$_SERVER['REQUEST_URI'].'" method="post" class="form-inline my-2 my-lg-0">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-success my-2 mx-2 my-sm-0" type="submit">Search</button>';
    if($logged==false)
    {
      echo ' <button class="btn my-2 mx-2 my-sm-0" style=" background-color:black;" type="submit" ><a href="partial/_login.php" style="text-decoration:none; color:white; font-size:18px;">Log in</a></button>
      <button class="btn btn my-2  mx-2 my-sm-0"   style=" background-color:black;" type="submit"><a href="partial/_signup.php" style="text-decoration:none;  color:white; font-size:18px;">Sign UP</a></button>';
    }
    else{
      echo '<a class="nav-link " style="text-decoration:none; border-radius:3px; color:black; background-color: white; font-size:18px;" href="partial/_Logout.php"><img class="mr-3 " width="20px" style="color:white" src="https://cdn.onlinewebfonts.com/svg/img_184513.png" alt="Generic placeholder image">'.$_SESSION['uname'].'</a>';
      echo '<button class="btn btn my-2  mx-2 my-sm-0"   style=" background-color:white;" type="submit"><a href="partial/_profile.php" style="text-decoration:none;  color:black; font-size:18px;">Profile</a></button>      ';
    }
   echo '</form>
</div>
</nav>';
 ?>
