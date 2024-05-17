<?php

include 'loadenv.php';
/**
 * Class databaseConnection is used for connect database.
 */
class ConnectionDb {
  /**
   * @var string $serverName
   *  Servername store the database host name.
   */
  private $serverName;
  /**
   * @var string $dbName
   *  Database name is stored inside dbName.
   */
  private $dbName;
  /**
   * @var string $userName
   *  It is used to store username.
   */
  private $userName;
  /**
   * @var string $password
   *  It is used to store password.
   */
  private $password;
  /**
   * @var string $conn.
   *  It stores connection.
   */
  public $conn;

  /**
   * This constructor is used to set hostname ,username, password and database name.
   */
  public function __construct() {

    $this->serverName = $_ENV['My_db_host'];
    $this->userName = $_ENV['username'];
    $this->password = $_ENV['password'];
    $this->dbName = $_ENV['My_dbName'];
  }

/**
 * This is function is used for connecting database.
 * @return string
 */
  public function connection() {
    try {
      $this->conn = new PDO("mysql:host=$this->serverName;dbname=$this->dbName", $this->userName, $this->password);
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  /**
   * This function is used to insert the user data into the database
   *
   * @param string $sql
   *  This variable contains the query.
   */
  public function insertData(string $sql) {

    try {
      $statement = $this->conn->prepare($sql);
      $statement->execute();
    }
    catch (PDOException $e) {
      echo "Data insertion failed " . $e->getMessage();
    }
  }

  /**
   * This function is used to fetched user data from the database
   *
   * @param string $user
   * @return array
   */
  public function fetchingData(string $category): array {
    $query1 = "SELECT * FROM product_info where productCategory='$category'";
    // Preparing and executing the sql query.
    $stmt = $this->conn->prepare($query1);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
  }

  /**
   * This function is used to fetch all book data of a table.
   *
   * @return array $results
   * Contain all the rows and column of a table.
   */
  public function fetchingBookData(): array {
    $query1 = "SELECT * FROM book_info";
    // Preparing and executing the sql query.
    $stmt = $this->conn->prepare($query1);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
  }
  /**
   * This function is used to fetch the price of a particulat product using their id.
   *
   * @param string $productId
   * @return string
   */
  public function fetchProductPrice($productId) :string {
    $query1 = "SELECT cost FROM product_info WHERE productId = '$productId'";
    $stmt = $this->conn->prepare($query1);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
  }
  /**
   * This function is used to store the customers orders details and send them to  the mail address.
   *
   * @param string $name
   * @param string $email
   * @param string $phone
   * @param string $totalAmount
   * @return void
   */
  public function storeOrderDetails(string $name, string $email, string $phone, string $totalAmount) {
    $orderId = uniqid();
    $sql = "INSERT INTO orders (customer_name, email, phone, total_amount, order_id) VALUES ('$name', '$email', '$phone', '$totalAmount', '$orderId')";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    include 'sendMail.php';
  }
}
