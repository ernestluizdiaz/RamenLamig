<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RamenLamig</title>
  <link rel="stylesheet" href="child.css"> 
</head>
<body>
  <div class="wrapper" style="height: 70vh";>
    <a class="links" href="index.php">Back to Customer</a>
    <?php $getCustomerByID = getCustomerByID($pdo, $_GET['customer_id']); ?>
    <h1>Edit Customer Details</h1>
    <div class="container">
  <form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
    <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $getCustomerByID['customer_id']; ?>">
    <p>
      <label for="customer_name">Customer Name</label>
      <input type="text" name="customer_name" id="customer_name" value="<?php echo $getCustomerByID['customer_name']; ?>">
    </p>

    <p>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" value="<?php echo $getCustomerByID['email']; ?>">
    </p>

    <p>
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" value="<?php echo $getCustomerByID['phone']; ?>">
    </p>

    <p>
      <label for="created_at">Date</label>
      <input type="date" name="created_at" id="created_at" value="<?php echo $getCustomerByID['created_at']; ?>">
    </p>

    <button class="btn" type="submit" name="editCustomerBtn">Edit</button>
  </form>
  </div>
  </div>
  
  
</body>
</html>
