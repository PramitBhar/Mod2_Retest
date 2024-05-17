<?php

include 'Product.php';
// Include the Book which consist of to insert book data and fetched book details.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // This variable takes the book title
  $fname = trim($_POST["fname"], " ");
  $lname = trim($_POST["lname"], " ");
  // This variable takes the book cost
  $cost = $_POST["cost"];
  // New obj created.
  $user = new Product($fname, $lname, $cost);
  //Store the book details into the database.
  $user->storeProductData();
}
?>

<!DOCTYPE HTML>
<html>
<head>
  <style>
    <?php include "productEntries.css"; ?>
  </style>
</head>
<body>
  <!-- Container start. -->
  <div class="container">
    <div class="logout">
      <a href="/logout">Logout</a>
    </div>
    <div class="form-container">
      <!-- Form heading. -->
      <h1>Fill the products Details which you want to upload</h1>
      <div class="form-contents">
        <!-- Form input fields.-->
        <form method="post" action="/product-entries"
        enctype="multipart/form-data">
          <span class="warning-message">
            <?php if ($error_message != "") echo $error_message; ?>
          </span>
          <!-- First name input field. -->
          <div class="form-fields">
            <label class="form-fields-heading">
              <span class="warning-message">*</span>Product Name:</label>
            <input type="text" class="form-input-fields"
            placeholder="Enter the title of the book" value="<?php echo $fname ?>" name="fname"
            maxlength="35" required pattern="^[A-Za-z]+$"
            title="Fill this fields with alphabets only">
            <p class="warning-message">
              <?php echo $first_input_error_message ?>
            </p>
          </div>
          <!-- Product Category Input field-->
          <div class="form-fields">
            <label class="form-fields-heading">
              <span class="warning-message">*</span>Product Category:</label>
            <input type="text" class="form-input-fields"
            placeholder="Enter Category of the Product.Plaese Write Healthy or Unhealthy" value="<?php echo $lname ?>" name="lname"
            maxlength="35" required pattern="^[A-Za-z]+$"
            title="Fill this fields with alphabets only">
            <p class="warning-message">
              <?php echo $first_input_error_message ?>
            </p>
          </div>
               <!-- Product Cost input field. -->
            <div class="form-fields">
              <label class="form-fields-heading"> <span class="warning-message">*
                </span>Book cost:</label>
              <input type="text" class="form-input-fields"
              placeholder="Enter the cost price of the product"
              value="<?php echo $cost ?>" name="cost" maxlength="35" required
              pattern="^[0-9]+$" title="Fill this fields with alphabets only">
              <p class="warning-message">
                <?php echo $second_input_error_message ?>
              </p>
            </div>
          <!-- Submit button. -->
          <input type="submit" class="form-submit-btn" name="submit"
          value="Submit">
        </form>
      </div>
    </div>
  </div>
  <!-- Container end. -->
</body>

</html>
