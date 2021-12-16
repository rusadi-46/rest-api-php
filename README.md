# REST API
## FEATURES
- PHP 7.4.3
- MYSQL

---
## SETUP
```
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE_NAME", "web_service");
define("APP_URL", "http://localhost/");
```
1. Edit env.php
    Change Value:
    - DB_HOST = your host,
    - DB_USERNAME = your database username
    - DB_PASSWORD = your database password
    - DB_DATABASE_NAME = your database name
    - APP_URL = url aplication

2. Create Database
3. run migration: php database/migration.php
4. run seeder: php database/seeder.php

---
## ENDPOINT
1. Create Payment:
    POST: http://localhost/api/create
    Params:
    ```
    {
      "invoice_id": 1,
      "item_name": "T-Shirt",
      "amount": 6000,
      "payment_type": "virtual_account | credit_card",
      "customer_name": "Rusadi",
      "merchant_id": 1
    }
    ```
    Response:
    ```
    {
      code: 200,
      message: "Success",
      data: {
        "references_id": 1
        "number_va": 673452,
        "status": "Pending"
      }
    }
    ```

2. Get Payment:
    GET: http://localhost/api/show
    Params:
    ```
    {
      "references_id": 1,
      "merchant_id": "T-Shirt",
    }
    ```
    Response:
    ```
    {
      code: 200,
      message: "Success",
      data: [
        {
          "references_id": 1
          "number_va": 673452,
          "status": "Pending"
        }
      ]
    }
    ```

3. Update Paymanet:
    run this script using terminal:
    script:
    ```
    php transaction-cli.php {references_id} {status}
    ```
    Example:
    ```
    php transaction-cli.php {1} {Paid}
    ```

