<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }

   }else{
      $message[] = 'Incorrect Email or Password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      .form-container{
         min-height: 100vh;
         display: flex;
         align-items: center;
         justify-content: center;
         padding:2rem;
         background:linear-gradient(rgba(255, 255, 255, 0.59), rgba(231, 211, 255, 0.64));
      }
      .form-container form{
         padding:2rem;
         width: 50rem;
         border-radius: .5rem;
         border: solid 0.1px;
         border-color:rgb(155, 101, 255);
         text-align: center;
         background:linear-gradient(rgba(255, 255, 255, 0.26), rgba(228, 194, 255, 0.13));
         box-shadow: var(--box-shadow);
         backdrop-filter: blur(70px);
      }
      .input-field {
         background:linear-gradient(rgba(240, 227, 255, 0.55), rgba(235, 217, 255, 0.53));
         backdrop-filter: blur(20px);
         border: solid .5px;
         border-color:rgba(150, 94, 255, 0.91);
         padding: 14px;
         margin-bottom: 15px;
         border-radius: 8px;
         font-size: 16px;
         width: 100%;
      }
      .btn {
         display: block;
         width: 100%;
         padding: 1.2rem 2.5rem;
         background: linear-gradient(to right, #7c34db, #7329b9); /* Blue glossy button */
         color: #fff;
         border: none;
         border-radius: 10px;
         font-size: 1.3rem;
         font-weight: 600;
         cursor: pointer;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
         transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
         position: relative;
         overflow: hidden;
      }

      .btn::before {
         content: '';
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: linear-gradient(to right, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.2) 100%);
         opacity: 0;
         transition: opacity 0.3s ease;
      }

      .btn:hover {
         background: linear-gradient(to right, #6a29b9, #63259a);
         transform: translateY(-3px);
         box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
      }

      .btn:hover::before {
         opacity: 1;
      }

      .btn:active {
         transform: translateY(0);
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }
      
   </style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">
   <form action="" method="post">
      <div class="form-cont">
         <h3>Login Now</h3>
         <input type="email" name="email" placeholder="Enter your Email" required class="input-field">
         <input type="password" name="password" placeholder="Enter your Password" required class="input-field">
         <input type="submit" name="submit" value="Login Now" class="btn">
         <p class="link">Don't have an Account? <a href="register.php">Register Now</a></p>
      </div>
   </form>

</div>

</body>
</html>