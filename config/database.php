<?php

include_once __DIR__ ."../env.php";

class Database 
{
  public  $connection;

  public function __construct()
  {
    $this->connection = null;

    try {
      $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE_NAME, DB_USERNAME, DB_PASSWORD);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $exception){
      echo "Error: " . $exception->getMessage();
    }

    return $this->connection;
  }

  public function query($query = "" , $params = [])
  {
    try {
      $stmt = $this->executeStatement( $query , $params );

      if ($params['response_type'] == 'get_id') {
        $result = $this->connection->lastInsertId();
      } else if ($params['response_type'] == 'multiple') {
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC); 
      } else {
        $result = $stmt->fetch(\PDO::FETCH_ASSOC); 
      }

      return $result;
    } catch(Exception $e) {
      throw New Exception( $e->getMessage() );
    }
    return false;
  }
 
  public function executeStatement($query = "" , $params = [])
  {
    try {
      $stmt = $this->connection->prepare( $query );

      if($stmt === false) {
        throw New Exception("Unable to do prepared statement: " . $query);
      }

      if( $params ) {
        $stmt->bindParam(':invoice_id', $params['invoice_id']);
        $stmt->bindParam(':item_name', $params['item_name']);
        $stmt->bindParam(':amount', $params['amount']);
        $stmt->bindParam(':payment_type', $params['payment_type']);
        $stmt->bindParam(':customer_name', $params['customer_name']);
        $stmt->bindParam(':merchant_id', $params['merchant_id']);
        $stmt->bindParam(':references_id', $params['references_id']);
        $stmt->bindParam(':number_va', $params['number_va']);
        $stmt->bindParam(':status', $params['status']);
        $stmt->bindParam(':created_at', $params['created_at']);
        $stmt->bindParam(':update_at', $params['created_at']);
      }

      $stmt->execute();

      return $stmt;
    } catch(Exception $e) {
      throw New Exception( $e->getMessage() );
    }   
  }        
}