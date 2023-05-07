<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=5"/>
    <link rel="icon" href="devchallenges.png" />
    <link rel="shortcut icon" type="image/x-icon" href="https://devchallenges.io/"/>
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="./css/style.css">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/9ca08a6a82.js" crossorigin="anonymous"></script>
 
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <title>Payment Page</title>
  </head>
  <body style="background-image:url(R.jpg);">
<div class="container">
    <section class="checkout__header">
        <h2 class="checkout__title">
          Payment Processing
        </h2>
      <!-- checkout form -->
    <form action="" method="POST" style="background-color:skyblue">
          <div class="checkout__form--control">
            <p>Contact infomation</p>
          </div>
          <!-- email input -->
          <div class="checkout__form--control">
            <label for="email">E-mail</label>
            <div class="input_icon">
              <i class="fas fa-envelope "></i><input type="email" name="email" placeholder="Enter your email">
            </div>
          </div>  
         <!-- phone -->
          <div class="checkout__form--control">
          <label for="email">Phone</label>
          <div class="input_icon">
            <i class="fas fa-phone-alt"></i><input type="text" name="email" placeholder="Enter your phone">
          </div>
          <div class="checkout__form--control">
            <label for="fullname">Full name</label>
            <div class="input_icon">
              <i class="fas fa-user-circle"></i><input type="text" name="fullname" placeholder="Your full name">
            </div>
          </div>
          <!--  -->
          <div class="checkout__form--control">
            <label for="address">Address</label>
            <div class="input_icon">
              <i class="fas fa-home"></i><input type="text" name="address" placeholder="Your address">
            </div>
          </div>
          <!--  -->
          <div class="checkout__form--control">
            <label for="city">City</label>
            <div class="input_icon">
              <i class="fas fa-city"></i><input type="text" name="city" placeholder="Your city">
            </div>
          </div>
          <div class="checkout__form--control col-2">
            <div>
              <label for="country">Country</label>
            <div class="input_icon">
              <i class="fas fa-globe-africa"></i><input type="text" name="country" placeholder="Your country">
            </div>
            </div>
            <div>
              <label for="postalcode">Postal code</label>
            <div class="input_icon">
              <i class="fas fa-mail-bulk"></i><input type="text" name="postalcode" placeholder="Your postal code">
            </div>
            </div>
          </div>
          <div>
              <label for="postalcode">Amount:</label>
            <div class="input_icon">
              <i class="fas fa-mail-bulk"></i><input type="text" name="amount" placeholder="Amount To Pay">
            </div>
            </div>
            <div>
              <label for="postalcode">Credit Card Number:</label>
            <div class="input_icon">
              <i class="fas fa-mail-bulk"></i><input type="text" name="creditcard" placeholder="Your credit card number">
            </div>
            </div>
          <div class="checkbox">
          <input type="checkbox"> <label for="checkbox">Save this information for next time</label>
          </div>
          <div class="button">
            <button class="btn" type="submit" name="pay">Pay</button>
            
            
            </div>
        </div>
        </form>
    </section>

   </div> 
   <footer>
     <div class="content">
     </div>
   </footer>
  <script src="./js/main.js"></script>
  </body>
</html>
<?php

if(isset($_POST['pay']))
{
    $connection=mysqli_connect('localhost','root',"",'wt_database');
    $amount=$_POST['amount'];
    $cardnumber=$_POST['creditcard'];
    $username=$_SESSION['username'];
   $sql="insert into transactions(username,creditcard,Amount,date) values('$username','$cardnumber','$amount','$cardnumber')";
$query=mysqli_query($connection,$sql);
 if($query)
 {
     include("success.php");
 }
 else{
    include("error.php");
 }
}
?>
