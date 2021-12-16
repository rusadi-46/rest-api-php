<?php

require_once __DIR__.("/../config/database.php");

try {
$connect = new Database();
  // sql to create table
  $sql = "INSERT INTO orders(`invoice_id`, `item_name`, `amount`, `payment_type`, `customer_name`, `merchant_id`, `references_id`, `number_va`, `status`, `created_at`, `update_at`) VALUES 
  (1, 'T-Shirt (L)', 50000, 'credit_card', 'Jhon Doe', 1, 1, NULL, 'Pending', '2021-12-09 11:06:13', NULL), 
  (2, 'KYT Helmet', 450000, 'virtual_account', 'James ', 2, 3, 'GB33765994442636', 'Pending', '2021-12-09 11:06:13', NULL),
  (6, 'Name Item Test', 20000, 'credit_card', 'Rusadi', 2, 4, NULL, NULL, '2021-12-13 10:15:24', NULL);";

  $connect->executeStatement($sql);
  echo "Dump data created successfully";
} catch(PDOException $e) {
  echo "Error: " . $exception->getMessage();
}
