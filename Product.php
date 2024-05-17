<?php

include 'ConnectionDb.php';
/**
  * This class is used to validate user input.
  *
  * @param type: string
  *
  * @return type: object
*/
class Product {
  // This variable indicates the name of the product.
  public string $productName;
  // This variable indicates the Category of the product.
  public string $productCategory;
  // This varibale indicates the cost of the product.
  public string $cost;
  // This variable indicated the connection of the database;
  public string $connectDb;
  /**
    * This constuctor class initialize the fname and lname variable.
    *
    * @param type: string
  */
  public function __construct(
      string $productName,
      string $productCategory,
      string $cost,
  ) {
    $this->productName = $productName;
    $this->productCategory = $productCategory;
    $this->cost = $cost;
  }

  public function storeProductData() {
    try {
      $connectDb = new ConnectionDb();
      $connectDb->connection();
      $productId = uniqid();
      $sql = "INSERT INTO product_info (productId, productName, productCategory, cost) VALUES ('$productId', '$this->productName', '$this->productCategory' , '$this->cost')";
      $stmt = $connectDb->insertData($sql);
      // Execute the statement and check for errors
    }
    catch (Exception $e) {
      echo "Book Data Insertion Failed.";
    }
  }

  /**
    * This function is used to validate user input using regex
    *
    * @param type: no parameter is passed
    *
    * @return type: string
  */
  public function validateUserInput() {
    // This pattern is used to check given input is valid or not.
    $pattern = "/^[A-Za-z]+$/";
    // Below condition is used to check if both the input field is correct.
    if (preg_match($pattern, $this->title) &&
      preg_match($pattern, $this->lname)) {
      $fullName = $this->fname . " " . $this->lname;
      return $fullName;
    }
    // Below condition is used to check if both the input field is wrong or not.
    elseif(
      !preg_match($pattern, $this->fname) &&
      !preg_match($pattern, $this->lname)) {
        return "";
    }
    // Below condition is used to check if first name input field is wrong or not.
    elseif (!preg_match($pattern, $this->fname)) {
      return $this->fname;
    }
    //Below condition is used to check if last name input field is wrong or not.
    elseif (!preg_match($pattern, $this->lname)) {
      return $this->lname;
    }
  }
  /**
    * This function is used to validate image.
    *
    * @param type: no params is pass.
    *
    * @return type: string
  */
  public function isUploadedImageValidate() : string {
    // if (isset($_FILES["image"])) {
    //   $uploadedImgDir = "user_uploaded_image/";
    //   $targetFile = $uploadedImgDir .
    //   basename($_FILES["image"]["name"]);
    // }
    // return $targetFile;
    $targetFile = ""; // Initialize the variable

    if (isset($_FILES["image"])) {
        $uploadedImgDir = "user_uploaded_image/";
        $targetFile = $uploadedImgDir . basename($_FILES["image"]["name"]);
    }

    return $targetFile;
  }
}
?>
