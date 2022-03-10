<?php
session_start();
//connect to database
include 'backend/database.php';
if(isset($_POST['register_btn']))
{
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $password2=mysqli_real_escape_string($conn,$_POST['password2']);  
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result=mysqli_query($conn,$query);
      if($result)
      {
     
        if( mysqli_num_rows($result) > 0)
        {
                
                echo '<script language="javascript">';
                echo 'alert("Username already exists")';
                echo '</script>';
        }
        
          else
          {
            
            if($password==$password2)
            {           //Create User
                $password=md5($password); //hash password before storing for security purposes
                $sql="INSERT INTO users(username, email, password ) VALUES('$username','$email','$password')"; 
                mysqli_query($conn,$sql);  
                $_SESSION['message']="You are now logged in"; 
                $_SESSION['username']=$username;
                header("location:crudOperations.php");  //redirect home page
            }
            else
            {
                $_SESSION['message']="The two password do not match";   
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

<div class="Rcontainer">
  <hgroup>
    <h1 class="Rheader"> Register Here! </h1><br>
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
<form method="post" action="register.php">

          <label class="Ru">Username : </label><br><br>
          <input type="text" name="username" class="textInput" required=""><br><br>
   
           <label class="Ru">Email :</label><br><br>
           <input type="email" name="email" class="textInput" required=""><br><br>
     
           <label class="Ru">Password : </label><br><br>
           <input type="password" name="password" class="textInput" required=""><br><br>
    
           <label class="Ru"> Password again: </label><br><br>
           <input type="password" name="password2" class="textInput" required=""><br><br>
     
           <input type="submit" name="register_btn" class="Register" required=""><br><br>
     
    <a class="La" href="index.php">LOGIN----></a>
</form>
</div>

</main>
</div>

</body>
</html>




