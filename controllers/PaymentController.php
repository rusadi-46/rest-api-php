<?php
include_once __DIR__ . "/../models/order.php";

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

class PaymentController
{
  private $order;

  public function __construct() {
    $this->order = new Order();
  }

  public function create() {
    try {
      $params = $_POST;
      $result = null;

      $params['response_type'] = 'get_id';
      $params['merchant_id']   = rand(1,99999);
      $params['references_id'] = rand(1,99999);
      $params['number_va']     = $this->generateVirtualAccount($params['payment_type']);
      $params['status']        = 'Pending';
      $params['created_at']    = date('Y-m-d H:i:s');

      $order_id = $this->order->create($params);

      if ($order_id) {
        $result = $this->order->getDataById($order_id);
      }

      $this->order->response(200, 'Success',  $result);
    } catch(PDOExecption $e) {
      throw New Exception( $e->getMessage() );
    }
  }

  public function show()
  {
    try {
      $params = $_GET;
      $result = null;
      $params['response_type'] = 'multiple';

      $result = $this->order->getOrdersByParams($params);

      $this->order->response(200, 'Success',  $result);
    } catch(PDOExecption $e) {
      throw New Exception( $e->getMessage() );
    }
  }

  public function update($params)
  {
    try {
      $result = null;
      $params['response_type'] = 'get_id';
      $this->order->update($params);

      echo "Update transakstion successfully";
    } catch (PDOExecption $e) {
      throw New Exception( $e->getMessage() );
    }
  }

  public function generateVirtualAccount($payment_type = null) {
    $virtual_account = null;

    if ($payment_type === 'virtual_account') {
      $virtual_account = rand(100000, 999999);
    }

    return $virtual_account;
  }
}
