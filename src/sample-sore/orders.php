<?php

require("db_transaction.php");

$db_host = "database_host";
$db_name = "database_name";
$db_user = "database_user";
$db_password = "PASSWORD";

$customer_id = 2;

$products[] = [
  'product_id' => 1,
  'price' => 25.50,
  'quantity' => 1
];

$products[] = [
  'product_id' => 2,
  'price' => 13.90,
  'quantity' => 3
];

$products[] = [
  'product_id' => 3,
  'price' => 45.30,
  'quantity' => 2
];

$transaction = new DBTransaction($db_host, $db_user, $db_password, $db_name);

$order_query = "insert into orders (order_id, customer_id, order_date, order_total) values(:order_id, :customer_id, :order_date, :order_total)";
$product_query = "insert into orders_products (order_id, product_id, price, quantity) values(:order_id, :product_id, :price, :quantity)";

$transaction->insertQuery($order_query, [
  'customer_id' => $customer_id,
  'order_date' => "2020-01-11",
  'order_total' => 157.8
]);

$order_id = $transaction->last_insert_id;

foreach ($products as $product) {
  $transaction->insertQuery($product_query, [
    'order_id' => $order_id,
    'product_id' => $product['product_id'],
    'price' => $product['price'],
    'quantity' => $product['quantity']
  ]);
}

$result = $transaction->submit();

if ($result) {
    echo "Records successfully submitted";
} else {
    echo "There was an error.";
}