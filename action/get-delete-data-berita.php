<section class="content-header">
  <h1>
    GET
    <small><?php echo "string"; ?></small>
  </h1>
</section>

<?php

$id = $_GET['id'];

try {
  $sql = $conn->prepare("DELETE FROM data_berita WHERE id_berita = :id");
  $data = array(':id' => $id);
  $sql->execute($data);

  $_SESSION['green-notice'] = "Data berhasil dihapus";
  header("location: dashboard.php?page=manager-data-berita");
} catch (Exception $e) {

  $_SESSION['red-notice'] = "Terjadi kesalahan " . $e->getMessage();
  header("location: dashboard.php?page=manager-data-berita");
}

?>