<?php
 include 'ConnectionDb.php';
//Connect to the database
 $conn = new ConnectionDb();
 $conn->connection();
 //Fetched data those whose category are unhealthy
 $result = $conn->fetchingData("Unhealthy");
if (sizeof($result)>0) {
  // This variable create the table structure in the frontend
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
