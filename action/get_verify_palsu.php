<section class="content-header">
  <h1>
    GET
    <small><?php echo "string"; ?></small>
  </h1>
</section>

<?php

$id = $_GET['id'];
$status = 'fake';

try {
  $sql = $conn->prepare("UPDATE certificates SET status = :status WHERE id = :id");

  $data = array(':status' => $status,
                ':id' => $id
              );
  $sql->execute($data);

  $_SESSION['green-notice'] = "Sertifikat berhasil diverifikasi";
  header("location: dashboard.php?page=certificate-manager");
} catch (Exception $e) {

  $_SESSION['red-notice'] = "Terjadi kesalahan " . $e->getMessage();
  header("location: dashboard.php?page=certificate-manager");
}

?>