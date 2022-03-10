<?php
session_start();
if(  isset($_SESSION['username']) )
{
  header("location:crudOperations.php");
  die();
}
//connect to database
include 'backend/database.php';

if($conn)
{
  if(isset($_POST['login_btn']))
  {
      $username=mysqli_real_escape_string($conn,$_POST['username']);
      $password=mysqli_real_escape_string($conn,$_POST['password']);
      $password=md5($password); //Remember we hashed password before storing last time
      $sql="SELECT * FROM users WHERE  username='$username' AND password='$password'";
      $result=mysqli_query($conn,$sql);
      
      if($result)
      {
     
        if( mysqli_num_rows($result)>=1)
        {
            $_SESSION['message']="You are now Loggged In";
            $_SESSION['username']=$username;
            header("location:crudOperations.php");
        }
       else
       {
              $_SESSION['message']="Username and Password combiation incorrect";
       }
      }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rabbani sarkar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="Lcontainer">
  <hgroup>
    <img src="" alt="">
    <h1 class="Lheader">Login Here!</h1><br>
  </hgroup>

<br>


<main class="main-content">
 <div class="col-md-6 col-md-offset-2">
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>
<form method="post" action="index.php">
 
           <label class="Lusername">Username : </label><br><br>
           <input type="text" name="username" class="textInput" required=""><br><br>
     
      
           <label class="Lpassword">Password :  </label><br><br>
           <input type="password" name="password" class="textInput" required=""><br><br>
    
           <input type="submit" name="login_btn" class="Log In"><br><br>
  
<a class="La" href="register.php">SIGNUP----></a>
</form>
</div>

</main>
</div>

</body>
</html>
