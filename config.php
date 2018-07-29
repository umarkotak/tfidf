<?php
try {
  $host     = 'localhost';
  $dbname   = 'prediksicsr';
  $user     = 'root';
  $password = '';

  $conn = new PDO("mysql:host=$host;dbname=$dbname","$user","$password");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {

  $_SESSION['notice'] = "There is some trouble in your connection" . $e->getMessage();
  die();
}
?>

<?php
function sanitize($string) {
  $string = preg_replace("/[\r\n]/", " ", $string);
  $string = preg_replace("/[^A-Za-z ]/", '', $string);

  return $string;
}
?>