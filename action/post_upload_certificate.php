<section class="content-header">
  <h1>
    POST
    <small><?php echo "string"; ?></small>
  </h1>
</section>

<?php

$nama_pemilik = $_POST['certificate_owner_name'];
$nama_sertifikat = $_POST['certificate_name'];
$penerbit_sertifikat = $_POST['certificate_publisher'];
$tanggal_terbit = $_POST['certificate_date_published'];
$nomor_sertifikat = $_POST['certificate_number'];
$informasi_tambahan = $_POST['certificate_additional_information'];
$raw_data = $_POST['result'];
$link_gambar = $nama_pemilik . "-" . $tanggal_terbit . "-" . $nama_sertifikat . ".png";
$link_gambar = str_replace(" ","_",$link_gambar);
$status = 'unverified';

$name_image  = $link_gambar;
$loc_image   = $_FILES['certificate_image']['tmp_name'];

move_uploaded_file($loc_image,"images/uploaded_certificate/$name_image");

try {
  $sql = $conn->prepare('INSERT INTO certificates (nama_pemilik, nama_sertifikat,penerbit_sertifikat,tanggal_terbit, nomor_sertifikat, informasi_tambahan, link_gambar, status, raw_data)
         values (:nama_pemilik, :nama_sertifikat,:penerbit_sertifikat,:tanggal_terbit, :nomor_sertifikat, :informasi_tambahan, :link_gambar, :status, :raw_data)');

  $data = array(':nama_pemilik' => $nama_pemilik,
                ':nama_sertifikat' => $nama_sertifikat,
                ':penerbit_sertifikat' => $penerbit_sertifikat,
                ':tanggal_terbit' => $tanggal_terbit,
                ':nomor_sertifikat' => $nomor_sertifikat,
                ':informasi_tambahan' => $informasi_tambahan,
                ':link_gambar' => $link_gambar,
                ':status' => $status,
                ':raw_data' => $raw_data
              );
  $sql->execute($data);

  $_SESSION['green-notice'] = "Sertifikat anda berhasil di publish";
  header("location: dashboard.php?page=certificate-manager");
} catch (Exception $e) {

  $_SESSION['red-notice'] = "Terjadi kesalahan " . $e->getMessage();
  header("location: dashboard.php?page=certificate-manager");
}

?>