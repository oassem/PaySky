# Paysky E-Commerce Payment System API

This is a simple Laravel-based API for handling orders and payments for an e-commerce platform. It allows users to create orders, retrieve order details, and update payment statuses.

---

## **Table of Contents**
1. [Features](#features)
2. [Technologies Used](#technologies-used)
3. [Setup Instructions](#setup-instructions)
4. [API Documentation](#api-documentation)
5. [Database Schema](#database-schema)
   
---

## **Features**
- Create orders with products, quantities, and prices.
- Calculate total order amount with a 10% tax.
- Retrieve order details, including products and quantities.
- Simulate payment status updates (pending, successful, failed).

---

## **Technologies Used**
- **Backend**: Laravel (PHP Framework)
- **Database**: MySQL
- **API Testing**: Postman or any HTTP client

---

## **Setup Instructions**

### **Prerequisites**
- PHP >= 8.0
- Composer
- MySQL
- Laravel CLI

### **Steps**
1. Clone the repository:
   ```
   git clone https://github.com/your-username/paysky-ecommerce.git
   cd paysky-ecommerce
   ```

2. Install dependencies:
   ```
   composer install
   ```

3. Set up the `.env` file:
   - Copy `.env.example` to `.env`:
     ```
     cp .env.example .env
     ```
   - Update the database credentials in `.env`:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=paysky_ecommerce
     DB_USERNAME=root
     DB_PASSWORD=
     ```

4. Generate an application key:
   ```
   php artisan key:generate
   ```

5. Run migrations and seed the database:
   ```
   php artisan migrate --seed
   ```

6. Start the Laravel development server:
   ```
   php artisan serve
   ```

7. Access the API at `http://127.0.0.1:8000/api`.

---

## **API Documentation**

### **Base URL**
```
http://127.0.0.1:8000/api
```

### **Endpoints**

#### 1. **Create an Order**
- **URL**: `/orders`
- **Method**: `POST`
- **Request Body**:
  ```json
  {
    "products": [
      {"id": 1, "quantity": 2},
      {"id": 2, "quantity": 1}
    ]
  }
  ```
- **Response Body**:
  ```json
    {
        "data": {
            "id": 2,
            "total_amount": 440.00000000000006,
            "status": "pending",
            "created_at": "2025-01-23T16:53:49.000000Z",
            "updated_at": "2025-01-23T16:53:49.000000Z",
            "products": [
                {
                    "id": 1,
                    "name": "Product 1",
                    "price": "100.00",
                    "created_at": "2025-01-23T14:33:26.000000Z",
                    "updated_at": "2025-01-23T14:33:26.000000Z"
                },
                {
                    "id": 2,
                    "name": "Product 2",
                    "price": "200.00",
                    "created_at": "2025-01-23T14:33:26.000000Z",
                    "updated_at": "2025-01-23T14:33:26.000000Z"
                }
            ]
        }
    }
  ```


#### 2. **Retrieve an Order**
- **URL**: `/orders/{id}`
- **Method**: `GET`
- **Response Body**:
  ```json
    {
        "data": {
            "id": 2,
            "total_amount": 440.00000000000006,
            "status": "pending",
            "created_at": "2025-01-23T16:53:49.000000Z",
            "updated_at": "2025-01-23T16:53:49.000000Z",
            "products": [
                {
                    "id": 1,
                    "name": "Product 1",
                    "price": "100.00",
                    "created_at": "2025-01-23T14:33:26.000000Z",
                    "updated_at": "2025-01-23T14:33:26.000000Z"
                },
                {
                    "id": 2,
                    "name": "Product 2",
                    "price": "200.00",
                    "created_at": "2025-01-23T14:33:26.000000Z",
                    "updated_at": "2025-01-23T14:33:26.000000Z"
                }
            ]
        }
    }
  ```


#### 3. **Update Payment Status**
- **URL**: `/orders/{id}/payment`
- **Method**: `PATCH`
- **Request Body**:
  ```json
  {
    "status": "successful"
  }
  ```
  - **Response Body**:
    ```json
    {
        "data": {
        "id": 1,
        "total_amount": "440.00",
        "status": "successful",
        "created_at": "2025-01-23T14:33:30.000000Z",
        "updated_at": "2025-01-23T15:33:20.000000Z"
        }
    }
    ```         

---

## **Database Schema**

### **Tables**
1. **Products**
   - `id` (Primary Key)
   - `name` (String)
   - `price` (Decimal)
   - `created_at` (Timestamp)
   - `updated_at` (Timestamp)

2. **Orders**
   - `id` (Primary Key)
   - `total_amount` (Decimal)
   - `status` (String: pending, completed)
   - `created_at` (Timestamp)
   - `updated_at` (Timestamp)
   - `deleted_at` (Timestamp)

3. **Order_Products** (Pivot Table)
   - `id` (Primary Key)
   - `order_id` (Foreign Key)
   - `product_id` (Foreign Key)
   - `quantity` (Integer)
   - `price` (Decimal)
   - `created_at` (Timestamp)
   - `updated_at` (Timestamp)

### **Relationships**
- An **Order** belongs to many **Products**.
- A **Product** belongs to many **Orders**.
- The `order_products` table acts as a pivot table to store the relationship between orders and products.

---
