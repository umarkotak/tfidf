<section class="content-header">
  <h1>
    GET
    <small><?php echo "string"; ?></small>
  </h1>
</section>

<?php

$id = $_GET['id'];

try {
  $sql = $conn->prepare("SELECT * FROM published_certificates WHERE id = :id");

  $data = array(':id' => $id);
  $sql->execute($data);
  $certificate = $sql->fetch(PDO::FETCH_OBJ);
  unlink("images/published_certificate/$certificate->link_gambar");

  $sql = $conn->prepare("DELETE FROM published_certificates WHERE id = :id");
  $data = array(':id' => $id);
  $sql->execute($data);

  $_SESSION['green-notice'] = "Sertifikat berhasil dihapus";
  header("location: dashboard.php?page=certificate-published");
} catch (Exception $e) {

  $_SESSION['red-notice'] = "Terjadi kesalahan " . $e->getMessage();
  header("location: dashboard.php?page=certificate-published");
}

?>