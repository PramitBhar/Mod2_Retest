<?php
$url = parse_url($_SERVER['REQUEST_URI']);
//It takes the url from the browser header.
$path = $url["path"];
//Takes the path of the url.

$query = $url['query'];
$q1 = explode("=", $query);
if ($q1[0]=="sort_option") {
  $q = explode("_", $q1[1]);
}
else {
  $q=$q1;
}
switch ($path) {

  case '/':
    require __DIR__ . '/login.php';
    //It redirect to the login page
    break;
  case '/register':
    require __DIR__ . '/register.php';
    //It redirect to the register page
    break;
  case '/admin':
    require __DIR__ . '/admin_login.php';
    //It redirect to the admin login page
    break;
  case '/product-entries':
    require __DIR__ . '/productEntries.php';
    //It redirect to the entry of the book details page
    break;
  case '/listofproducts':
    //It redirect to the all the book display page
    require __DIR__ . '/listOfProducts.php';
    break;
  case '/logout':
    //It redirect to the all the book display page
    require __DIR__ . '/logout.php';
    break;
}

