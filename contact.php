<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      .contact form{
         background: linear-gradient(135deg, #f4f0f78c, #e8e2ec8e); /* Slightly darker glossy background for form */
         padding: 3.5rem;
         border-radius: 15px;
         box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
         margin-bottom: 3rem;
         position: relative;
         border: 1px solid rgba(222, 199, 255, 0.7);
         margin:0 auto;
         border-radius: .5rem;
         max-width: 50rem;
         margin:0 auto;
         text-align: center;
      }

      .contact form h3{
         font-size: 2.5rem;
         text-transform: uppercase;
         margin-bottom: 1rem;
         color:var(--black);
      }

      .contact form .box{
         margin:1rem 0;
         width: 100%;
         background-color: var(--white);
         padding: 1.2rem 1.5rem;
         border: solid .5px;
         border-color:rgba(165, 63, 255, 0.7);
         border-radius: 8px;
         box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05), 0 1px 0 rgba(255, 255, 255, 0.7); /* Inner shadow for depth, subtle highlight */
         font-size: 1.75rem;
         color: #6c6c6c;
         transition: box-shadow 0.3s ease, border-color 0.3s ease;
      }

      .contact form textarea{
         height: 20rem;
         resize: none;
      }
      .contact_btn {
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

      .contact_btn::before {
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

      .contact_btn:hover {
         background: linear-gradient(to right, #6a29b9, #63259a);
         transform: translateY(-3px);
         box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
      }

      .contact_btn:hover::before {
         opacity: 1;
      }

      .contact_btn:active {
         transform: translateY(0);
         box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }
   </style>
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Contact Us</h3>
   <p> <a href="home.php">Home</a> / contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Say Something!</h3>
      <input type="text" name="name" required placeholder="Enter Your Name" class="box">
      <input type="email" name="email" required placeholder="Enter Your Email" class="box">
      <input type="phone" name="number" required placeholder="Enter Your Number" class="box">
      <textarea name="message" class="box" placeholder="Enter Your Message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Send Message" name="send" class="contact_btn">
   </form>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>