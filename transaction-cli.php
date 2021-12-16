<?php
include_once __DIR__ ."/controllers/PaymentController.php";

if ($argv[1] && $argv[2]) {
  $params = [
    "references_id" => trim($argv[1], '{}'),
    "status" => trim($argv[2], '{}')
  ];

  $payment = new PaymentController();
  $payment->update($params);
}

