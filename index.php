<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}
require_once "./config.php";
$userId = $_SESSION["id"];
$sql = "SELECT count(*) as count FROM cart where user_id = $userId";
$result = $connection->query($sql);
$count = 0;
if ($row = $result->fetch_assoc()) {
  $count = $row['count'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
</head>

<body>
  <div class="container">
    <div class="alert alert-success my-5">
      Welcome ! You are now signed in to your account.
    </div>
    <!-- User profile -->
    <div class="row justify-content-center">
      <div class="col-lg-5 text-center">
        <h4 class="my-4">Hello, <?= htmlspecialchars($_SESSION["username"]); ?></h4>
        <a href="./cart.php" class="btn btn-primary">Cart(<?=  $count ?>)</a>
        <a href="./logout.php" class="btn btn-primary">Log Out</a>
      </div>
      <div class="container">
        <h2>Product List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "./config.php";
                $sql = "SELECT * FROM products";
                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='" . $row['product_image'] . "' alt='Product Image' width='100'></td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['product_description'] . "</td>";
                        echo "<td>$" . number_format($row['product_price'], 2) . "</td>";
                        echo "<td><a href='add_cart.php?productId=" . $row['product_id'] . "'>Add to Cart</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No products found.</td></tr>";
                }

                $connection->close();
                ?>
            </tbody>
        </table>
    </div>
    </div>
  </div>
</body>

</html>