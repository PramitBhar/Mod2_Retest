<?php
 include 'ConnectionDb.php';

 $conn = new ConnectionDb();
 // Connect to the database.
 $conn->connection();
 // This variable is used to fetched data whose category are healthy.
 $result = $conn->fetchingData("healthy");
if (sizeof($result)>0) {
  // This variable contain the frontend table structutre
  $output ='<table border="1" width="100%" cellspacing="0" cellpadding="10px"
  <tr>
  <th>Product Name</th>
  <th>Product Cost</th>
  <th>Are you interest to buy?</th>
  <th>Quantity</th>
  </tr>';
  for ($i = 0; $i < sizeof($result); $i++) {
    $output.= "<tr><td>{$result[$i]["productName"]}</td><td>{$result[$i]["cost"]}</td>
    <td><input type='checkbox' class='check-btn' data-product-id='{$result[$i]['productId']}'></td>
    <td><input type='number' class='quantity' data-product-id='{$result[$i]['productId']}' min='1'></td>
    </tr>";
  }
  $output.="</table>";
  echo $output;
}
else {
  echo "<h2>No records found!</h2>";
}
