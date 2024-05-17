<?php

session_start();
include 'ConnectionDb.php';
//Create new obj.
$connectDb = new ConnectionDb();
//Connect to the database.
$connectDb->connection();
// If session is not set then send to the login page.
if (isset($_SESSION['id']) == false) {
  header('Location:/');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Available Products</title>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N"
crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
<script src="script.js"></script>
</head>
<style>
  <?php include 'listOfProducts.css'?>
</style>
<body>

    <header class="header" id="header">
   <nav class="navbar">
    <div class="container">

      <h2>LOGO</h2>
      <!-- Logout Button -->
      <input type="submit" id="healthy-btn" value="Healthy Snacks">
      <input type="submit" id="unhealthy-btn" value="Unhealthy Snacks">
      <div class="btn btn-success logout">
        <a href="/logout">Logout</a>
      </div>
    </div>
    </nav>
</header>
  <div class="sorting-heading container">
    <h1>List of Products</h1>
  </div>
  <main class="table container" id="customers_table">
        <section class="table__body">
          <div id="table-data">

          </div>
          <button id="submitBtn">Submit</button>
      <!-- Order Form Contents -->
    <div id="orderForm" class="hidden">
        <h2>Order Details</h2>
        <form id="orderDetailsForm" action="/listOfProducts.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required><br>

            <label for="totalAmount">Total Payable Amount:</label>
            <input type="text" id="totalAmount" name="totalAmount" disabled><br>

            <input type="submit" value="Submit Order">
        </form>
    </div>
        </section>
    </main>
</body>
</html>
