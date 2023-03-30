<?php

include 'jconfig.php';

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
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'jheader.php'; ?>

<div class="heading">
   <h3>Seller Details</h3>
   <p> <a href="index.php">home</a> / seller contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Enter your details</h3>
      <input type="text" name="name" required placeholder="Enter seller name " class="box">
      <input type="email" name="email" required placeholder="Enter seller email" class="box">
      <input type="number" name="number" required placeholder="Enter seller number" class="box">
      <textarea name="message" class="box" placeholder="Enter book details,price and your location" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Send details to admin" name="send" class="btn">
   </form>

</section>








<?php include 'jfooter.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>