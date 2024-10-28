<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="parent.css">
  <title>RamenLamig Homepage</title>
</head>
<body>
  <div class="wrapper">
  <h1>Welcome to RamenLamig <br> Savor Your Ramen Creations! 🍜</h1>
  <div class="container">
    <form action="core/handleForms.php" method="POST">
      <p>
        <input type="hidden" name="customer_id" id="customer_id">
      </p>
      <p>
        <label for="customer_name">Customer Name</label>
        <input type="text" name="customer_name" id="customer_name" required>
      </p> 
      <p>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
      </p>
      <p>
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" required>
      </p>
      <p>
        <label for="created_at">Date</label>
        <input type="date" name="created_at" id="created_at" required>
      </p>
      <button class="btn" type="submit" name="submitCustomerButton">Submit</button>
    </form>

    <?php $getAllCustomers = getAllCustomers($pdo); ?>
    <table>
      <thead>
        <tr>
          <th>Customer Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($getAllCustomers as $row) { ?>
          <tr>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td>
              <li><a class="links" href="vieworder.php?customer_id=<?php echo $row['customer_id']; ?>">View Order</a></li>
              <li><a class="links" href="editcustomer.php?customer_id=<?php echo $row['customer_id']; ?>">Edit Customer</a></li>
              <li><a class="links" href="deletecustomer.php?customer_id=<?php echo $row['customer_id']; ?>">Delete Customer</a></li>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  </div>
  
</body>
</html>
