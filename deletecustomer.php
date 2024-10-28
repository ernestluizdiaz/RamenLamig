<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RamenLamig - Delete Customer</title>
  <link rel="stylesheet" href="child.css">
</head>
<body>
  <div class="wrapper" style="height: 70vh";>
    <a class="links" href="index.php">Back to Customer</a>
    <?php $getCustomerByID = getCustomerByID($pdo, $_GET['customer_id']); ?>
    <h1 style="font-size: 3rem" !important; >Are you sure you want to delete this user?</h1>
  <div class="container">
  <form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
    <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $getCustomerByID['customer_id']; ?>">

    <p>
      <label for="customer_name">Customer Name</label>
      <input type="text" name="customer_name" id="customer_name" value="<?php echo htmlspecialchars($getCustomerByID['customer_name']); ?>" readonly>
    </p>

    <p>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($getCustomerByID['email']); ?>" readonly>
    </p>

    <p>
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($getCustomerByID['phone']); ?>" readonly>
    </p>

    <p>
      <label for="created_at">Date</label>
      <input type="text" name="created_at" id="created_at" value="<?php echo htmlspecialchars($getCustomerByID['created_at']); ?>" readonly>
    </p>

    <button class="btn" type="submit" name="deleteCustomerBtn">Delete</button>
  </form>
    </div>
  </div>
  
</body>
</html>
