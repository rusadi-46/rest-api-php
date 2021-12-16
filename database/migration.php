<?php
require_once __DIR__.("/../config/database.php");

try {
  $connect = new Database();

  // sql to create table
  $sql = "CREATE TABLE `orders` (
    `id` bigint(20) NOT NULL,
    `invoice_id` int(11) NOT NULL,
    `item_name` varchar(100) NOT NULL,
    `amount` double NOT NULL,
    `payment_type` varchar(20) NOT NULL,
    `customer_name` varchar(100) NOT NULL,
    `merchant_id` int(11) NOT NULL,
    `references_id` int(11) NOT NULL,
    `number_va` varchar(20) DEFAULT NULL,
    `status` varchar(15) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `update_at` timestamp NULL DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1; ";

  $connect->executeStatement($sql);
  echo "Table orders created successfully";
} catch(PDOException $e) {
  echo "Error: " . $exception->getMessage();
}

$connect = null;
