<!-- Purpose: Handle form data from index.php and insert into database -->

<?php

require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['submitCustomerButton'])) {
  $query = insertCustomers($pdo,  $_POST['customer_name'], $_POST['email'], $_POST['phone'], $_POST['created_at']);
  if ($query) {
    echo "Order added successfully!<br><br>";
    echo "<a href='../index.php'>Return Home</a>";

  } else {
    echo "Failed to add order!";
  }
}


if (isset($_POST['editCustomerBtn'])) {
  $query = updateCustomers($pdo, $_GET['customer_id'], $_POST['customer_name'], $_POST['email'], $_POST['phone'], $_POST['created_at']);
  if ($query) {
    echo "Order updated successfully!<br><br>";
    echo "<a href='../index.php'>Return Home</a>";
  } else {
    echo "Failed to update order!";
  }
}


if (isset($_POST["deleteCustomerBtn"])) {
  $query = deleteCustomers($pdo, $_GET['customer_id']);
  if ($query) {
    echo "Order deleted successfully!<br><br>";
    echo "<a href='../index.php'>Return Home</a>";
  } else {
    echo "Failed to delete order!";
  }
}


if (isset($_POST["addOrderBtn"])) {
  $total_price = $_POST['total_price']; 
  $customer_id = $_POST['customer_id']; 
  $query = insertOrders($pdo, $_POST['quantity'], $_POST['ramen_type'], $customer_id, $total_price);
  if ($query) {
      echo "Order added successfully!<br><br>";
      echo '<a href="../vieworder.php?customer_id=' . urlencode($customer_id) . '">Return to View Order</a>';
  } else {
      echo "Failed to add order!";
  }
}


if (isset($_POST['editOrderBtn'])) {
  $order_id = $_POST['order_id'];
  $ramen_type = $_POST['ramen_type'];
  $quantity = $_POST['quantity'];
  $total_price = $_POST['total_price'];
  $customer_id = $_POST['customer_id']; 
  $updateSuccessful = updateOrders($pdo, $order_id, $ramen_type, $quantity, $total_price);
  
  if ($updateSuccessful) {
    echo "Order updated successfully!<br><br>";
    echo '<a href="../vieworder.php?customer_id=' . urlencode($customer_id) . '">Return to View Order</a>';
    exit();
  } else {
      echo "Error updating order.";
  }
}


if (isset($_POST['deleteOrderBtn'])) {
  $order_id = $_GET['order_id'];
  $customer_id = $_GET['customer_id'];
  $deleteSuccessful = deleteOrders($pdo, $order_id);
  if ($deleteSuccessful) { 
    echo 'Order deleted successfully!<br><br>';
    echo '<a href="../vieworder.php?customer_id=' . urlencode($customer_id) . '">Return to View Order</a>';
    exit();
  } else {
    echo 'Failed to delete order!';
  }
}
?>