<section class="content-header">
  <h1>
    GET
    <small><?php echo "string"; ?></small>
  </h1>
</section>

<?php

$id = $_GET['id'];

try {
  $sql = $conn->prepare("SELECT * FROM certificates WHERE id = :id");

  $data = array(':id' => $id);
  $sql->execute($data);
  $certificate = $sql->fetch(PDO::FETCH_OBJ);
  unlink("images/uploaded_certificate/$certificate->link_gambar");

  $sql = $conn->prepare("DELETE FROM certificates WHERE id = :id");
  $data = array(':id' => $id);
  $sql->execute($data);

  $_SESSION['green-notice'] = "Sertifikat berhasil dihapus";
  header("location: dashboard.php?page=certificate-manager");
} catch (Exception $e) {

  $_SESSION['red-notice'] = "Terjadi kesalahan " . $e->getMessage();
  header("location: dashboard.php?page=certificate-manager");
}

?>