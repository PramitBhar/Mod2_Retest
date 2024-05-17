<?php
session_start();
// Include database connection file.
include 'ConnectionDb.php';

// This variable is used to check if the username and password are correct.
$isUserValid = TRUE;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    // Create a new object.
    $connectDb = new ConnectionDb();
    // Get the user given username.
    $username = $_POST['email'];
    // Connect to the database.
    $connectDb->connection();
    // Fetch the user details from the database.
    $userDetails = $connectDb->fetchingData($username);

    // Verify the password and start the session.
    if ($userDetails) {
      if (password_verify($_POST['password'], $userDetails[0]['hash_password'])) {
        // Store the session id as user id.
        $_SESSION['id'] = $userDetails[0]['id'];
        // Redirect to the main index page.
        header('Location:/listofproducts');
        exit;
      }
    }
    $isUserValid = FALSE;
  } catch (PDOException $e) {
    echo "There is some problem." . $e->getMessage();
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
      <?php include 'login.css'; ?>
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="container">
      <div class="wrapper">
        <div class="title"><span>Login Form</span></div>
        <form action="" method="post">
          <div class="row">
            <i class="fas fa-user"></i>
            <input type="text" name="email" placeholder=" enter your email" maxlength="25" pattern="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$" required>
          </div>
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" maxlength="10" pattern="^[A-Za-z0-9-\#\$\.\%\&\*\@]+$" required>
          </div>
          <div class="pass"><a href="/admin">Login as a Admin</a></div>
          <div class="row button">
            <input type="submit" value="Login">
          </div>
          <div class="signup-link">Not a member? <a href="/register">Signup now</a></div>
        </form>
      </div>
    </div>
  </body>
</html>
