<?php
require_once __DIR__.("/../config/database.php");

class Order extends Database
{
  public function getOrdersByParams($params)
  {
      return Database::query("SELECT references_id, invoice_id, status FROM orders WHERE references_id=". $params['references_id'] ." AND merchant_id=". $params['merchant_id'] ."", $params);
  }

  public function create($params)
  {
    return Database::query("INSERT INTO orders(invoice_id, item_name, amount, payment_type, customer_name, merchant_id, references_id, number_va, status, created_at, update_at) VALUES (:invoice_id, :item_name, :amount, :payment_type, :customer_name, :merchant_id, :references_id, :number_va, :status, :created_at, :update_at);", $params);
  }

  public function getDataById($id)
  {
    return Database::query("SELECT references_id, number_va, merchant_id FROM orders WHERE id=". $id."");
  }

  public function update($params)
  {
    return Database::query("UPDATE orders SET status='". $params['status']."' WHERE references_id=". $params['references_id']."", $params);
  }

  public function response($code = null, $message = null, $data = []) {
    echo json_encode([
      "code" => $code,
      "message" => $message,
      "data" => $data
    ]);
  }
}
