<!-- Purpose: This file contains the functions that interact with the database. -->

<?php

require_once 'dbConfig.php';

// Function to insert a new customer into the database
function insertCustomers ($pdo,  $customer_name, $email ,$phone, $created_at) {
  $sql = "INSERT INTO customers (customer_name, email, phone, created_at) VALUES (?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute(array($customer_name, $email, $phone, $created_at));
  if ($executeQuery) {
    return true;
  }
}

// Function to show all customers from the index
function getAllCustomers($pdo) {
  $sql = "SELECT * FROM customers";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute();
  if ($executeQuery) {
      return $stmt->fetchAll(); 
  }
  return []; 
}

// Function to get a customer by ID 
function getCustomerByID($pdo, $customer_id) {
  $sql = "SELECT * FROM customers WHERE customer_id = ?";
  $stmt = $pdo->prepare($sql);
  if ($stmt->execute(array($customer_id))) {
      return $stmt->fetch(); 
  } else {
      return false; 
  }
}

// Function to update a customer from the databse
function updateCustomers($pdo, $customer_id, $customer_name, $email, $phone, $created_at) {
  $sql = "UPDATE customers SET customer_name = ?, email = ?, phone = ?, created_at = ? WHERE customer_id = ?";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute(array($customer_name, $email, $phone, $created_at, $customer_id));

  return $executeQuery; 
}

// Function to delete a customer from the database
function deleteCustomers($pdo, $customer_id) {
  $sql = "DELETE FROM customers WHERE customer_id = ?";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute(array($customer_id));
  return $executeQuery; 
}

// Function to show all orders from the table
function getOrderByCustomer($pdo, $customer_id) {
  $sql = "SELECT 
      orders.order_id AS order_id,
      orders.ramen_type AS ramen_type,
      orders.quantity AS quantity,
      orders.total_price AS total_price,
      CONCAT(customers.customer_name, ' ', customers.customer_id) AS customer_order
  FROM orders
  JOIN customers ON orders.customer_id = customers.customer_id
  WHERE customers.customer_id = ?
  GROUP BY orders.order_id"; 
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$customer_id]);
  return $stmt->fetchAll(); 
}

// Function to add orders from the database
function insertOrders(PDO $pdo, $quantity, $ramen_type, $customer_id, $total_price) {
  $sql = "INSERT INTO orders (quantity, ramen_type, customer_id, total_price) VALUES (?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute(array($quantity, $ramen_type, $customer_id, $total_price));
  if ($executeQuery) {
    return true;
  } else {
    return false;
  }
}

// Function to show all orders from the table
function getOrderbyID($pdo, $order_id) {
    $sql = "SELECT 
        orders.order_id AS order_id,
        orders.ramen_type AS ramen_type,
        orders.quantity AS quantity,
        orders.total_price AS total_price,
        CONCAT(customers.customer_name, ' ', customers.customer_id) AS customer_order
    FROM orders
    JOIN customers ON orders.customer_id = customers.customer_id
    WHERE orders.order_id = ?
    GROUP BY orders.order_id"; 

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute(array($order_id));
    if ($executeQuery) {
        return $stmt->fetch(); 
    }
}

// Function to update orders from the database
function updateOrders($pdo, $order_id, $ramen_type, $quantity, $total_price) {
  $sql = "UPDATE orders SET ramen_type = ?, quantity = ?, total_price = ? WHERE order_id = ?";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute(array($ramen_type, $quantity, $total_price, $order_id));  
  if ($executeQuery) {
      return true;
  }
  return false; 
}

// Function to delete orders from the database
function deleteOrders ($pdo, $order_id) {
  $sql = "DELETE FROM orders WHERE order_id = ?";
  $stmt = $pdo->prepare($sql);
  $executeQuery = $stmt->execute(array($order_id));
  if ($executeQuery) {
    return true;
  }
}
?>