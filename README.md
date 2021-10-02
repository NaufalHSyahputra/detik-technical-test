
# Detik.com Technical Test

Technical Test di Detik.com menggunakan PHP Native

## Tech Stack

- Docker
- PHP 7.4
- MySQL 8
- Apache
  
## Run Locally (Docker)

Clone the project

```bash
  git clone https://github.com/NaufalHSyahputra/detik-technical-test.git
```

Go to the project directory

```bash
  cd detik-technical-test
```

Run docker

```bash
  docker-compose up -d
```
Access Via API Client (Postman/Insomnia/Thunder Client via VSCode)

## Run Locally (Non Docker)

### Requirements: 
- Xampp or Laragon

Go to XAMPP or Laragon project directory
``` bash
Xampp: cd /path/to/xampp/htdocs
Laragon: cd /path/to/laragon/www
```

Clone the project

```bash
  git clone https://github.com/NaufalHSyahputra/detik-technical-test.git
```

Go to the project directory

```bash
  cd detik-technical-test
```

Change configuration in src/config.php

Access Via API Client (Postman/Insomnia/Thunder Client via VSCode)
## API Reference

### Base URL

```http
API = http://localhost:8001
PHPMYADMIN = http://localhost:8000
```

#### Get Transaction

```http
  GET http://localhost:8001/get.php?reference_id=&merchant_id=
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `merchant_id` | `string` | **Required**. Merchant Id |
| `reference_id` | `string` | **Required**. Reference Id |

#### Create Transaction

```http
  POST http://localhost:8001/create.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `invoice_id`     | `string` | **Required**. Invoice ID |
| `item_name`     | `string` | **Required**. Item Name |
| `amount`     | `int` | **Required**. Amount |
| `payment_type`     | `string` | **Required**. Payment Type (credit_card or virtual_account) |
| `customer_name`     | `string` | **Required**. Customer Name |
| `merchant_id`     | `string` | **Required**. Merchant ID |


#### Update Transaction (Docker)

```bash
  docker exec <www_container_id> php transaction-cli.php <reference_id> <new_status>
```
#### Update Transaction (Non Docker)

```bash
  php transaction-cli.php <reference_id> <new_status>
```