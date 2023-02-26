<?php
// require __DIR__.'.\..\vendor\autoload.php';
// // Create connection
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'\..');
// try {
//     $dotenv->load();
//     // $dotenv->required(['DEPLOY_PATH'])->notEmpty();
// } catch ( Exception $e )  {
//     echo $e->getMessage();
// }

if(file_exists(dirname(__DIR__) . '/vendor/autoload.php')) {
  require_once dirname(__DIR__) . '/vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
  $dotenv->load();
}

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASSWORD'];
$name = $_ENV['DB_NAME'];

$con = mysqli_connect($host, $user, $pass, $name);
// Check connection
if (!$con)
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>