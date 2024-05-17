<?php

session_start();
include 'ConnectionDb.php';
if ($_SERVER['REQUEST_METHOD']=="POST") {
  // It takes the first name of the user.
  $firstName = $_POST['fname'];
  // It takes the last name of the user.
  $lastName = $_POST['lname'];
  // It takes the email of the user.
  $email = $_POST['email'];
  // It takes the password of the user.
  $password = $_POST['password'];
  // It takes the unique id of the user.
  $id = uniqid();
  try {
    //Convert the password to hash password enhance the security
    $hashPass = password_hash($password, PASSWORD_DEFAULT);
    // Sql query to insert the user details to the database
    $sql = "INSERT INTO user_info(first_name,last_name,id,email,hash_password,user_type)
    VALUES('$firstName','$lastName','$id','$email','$hashPass','customer');";
    // New obj created.
    $dbConnect = new ConnectionDb();
    // Connect to the database.
    $dbConnect->connection();
    // Insert the user data to the database.
    $dbConnect->insertData($sql);
    // After registration user redirect to the login page.
    header("Location: /");
  }
  catch (PDOException $e) {
    echo "User registration is not successful". $e->getMessage();
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registration Page</title>
    <style>
      <?php
       include 'register.css';
      ?>
    </style>
   </head>
<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form action="/register" method="post">
      <div class="input-box">
        <input type="text" placeholder="Enter your first name" name="fname" maxlength="25" pattern="^[A-Za-z]+$" title="Input Should be String to be matched" required>
      </div>
      <div class="input-box">
        <input type="text" placeholder="Enter your last name" name="lname" maxlength="25" pattern="^[A-Za-z]+$" title="Input Should be String to be matched" required>
      </div>
      <div class="input-box">
        <input type="email" placeholder="Enter your email" name="email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})?$" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Create password" name="password" pattern="^[A-Za-z0-9-\#\$\.\%\&\*\@]+$" required>
      </div>
      <div class="policy">
        <input type="checkbox">
        <h3>I accept all terms & condition</h3>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Register Now">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="/">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>
