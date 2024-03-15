<?php
// define("DB_SERVER", "shopping-database-server.mysql.database.azure.com");
define("DB_SERVER", "shopping-database-instance.cjxdwhcpe4lg.ap-southeast-2.rds.amazonaws.com");
define("DB_USERNAME", "shopping_root");
define("DB_PASSWORD", "Happy123");
define("DB_NAME", "shopping");
# Connection
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

# Check connection
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}
