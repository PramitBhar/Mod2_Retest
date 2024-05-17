<?php

include 'ConnectionDb.php';
//Connect to the database.
$conn = new ConnectionDb();
$conn->connection();
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$orderDetails = json_decode($_POST['orderDetails'], true);
$totalAmount = 0;

foreach ($orderDetails as $item) {
    $result = $conn->fetchProductPrice($item["id"]);
    $totalAmount += (int)$result * $item['quantity'];
}
$orderDetailsJson = json_encode($orderDetails);
$conn->storeOrderDetails($name, $email, $phone, $totalAmount);

file_put_contents('orders/' . $name . "-" . $orderDetails['id'] . '.txt', "Name: $name\nEmail: $email\nPhone: $phone\nTotal Amount: $totalAmount\n");

echo 'Order placed successfully.';
