<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $sql = $conn->prepare("SELECT * FROM data_training WHERE id=:id");
  $data = Array(':id' => $id);
  $sql->execute($data);
  $data_training = $sql->fetch();
}
?>

<?php
if (isset($_POST['btn_update'])) {
  $judul = $_POST['judul'];
  $sumber = $_POST['sumber'];
  $tahun = $_POST['tahun'];
  $jenis = $_POST['jenis'];
  $kategori = $_POST['kategori'];
  $dokumen = $_POST['teks_berita'];
  $token = $_POST['token_berita'];

  try {
    $sql = $conn->prepare("UPDATE data_training SET judul=:judul, sumber=:sumber, tahun=:tahun, jenis=:jenis, dokumen=:dokumen, token=:token, kategori=:kategori WHERE id=:id");
    $data = Array(
      ':judul' => $judul,
      ':sumber' => $sumber,
      ':tahun' => $tahun,
      ':jenis' => $jenis,
      ':dokumen' => $dokumen,
      ':token' => $token,
      ':kategori' => $kategori,
      ':id' => $id
    );
    $sql->execute($data);

    $_SESSION['green-notice'] = "Data berhasil diperbaharui";
    header("location: ?page=manager-data");
  } catch (Exception $e) {

    $_SESSION['red-notice'] = "Terjadi kesalahan " . $e->getMessage();
    header("location: ?page=manager-data");
  }
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Data-Trainning
    <small>Laporan CSR</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Setting</li>
  </ol>
</section>

<!-- Main content -->
<?php if (isset($id)): ?>
<section class="content">
  <form action="" method="post">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Form Edit Data Training</h3>
        </div>

        <div class="box-body">
          <div class="form-group">
            <label>Judul</label>
            <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul Berita" value="<?php echo $data_training['judul'] ?>">
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Sumber</label>
                <input type="text" id="sumber" name="sumber" class="form-control" placeholder="Sumber Berita" value="<?php echo $data_training['sumber'] ?>">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Tahun</label>
                <input type="text" id="tahun" name="tahun" class="form-control" placeholder="Tahun Terbit" value="<?php echo $data_training['tahun'] ?>">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Jenis</label>
                <select id="jenis" name="jenis" class="form-control">
                  <option value="<?php echo $data_training['jenis'] ?>"><?php echo $data_training['jenis'] ?></option>
                  <option value="csr">CSR</option>
                  <option value="berita">Berita</option>
                </select>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Kategori</label>
                <select id="kategori" name="kategori" class="form-control">
                  <option value="<?php echo $data_training['kategori'] ?>"><?php echo $data_training['kategori'] ?></option>
                  <option value="lingkungan">Lingkungan</option>
                  <option value="Pendidikan">Pendidikan</option>
                  <option value="bencana_alam">Bencana Alam</option>
                  <option value="ekonomi">Ekonomi</option>
                  <option value="sosial">Sosial</option>
                  <option value="publik_faisilitas">Publik Fasilitas</option>
                  <option value="pengetas_kemiskinan">Pengentas Kemiskinan</option>
                  <option value="berita">Berita</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Teks Berita</label>
            <textarea id="teks_berita" name="teks_berita" class="form-control" rows="7"><?php echo $data_training['dokumen'] ?></textarea>
          </div>

          <div class="form-group">
            <label>Token Berita</label>
            <textarea id="token_berita" name="token_berita" class="form-control" rows="7"><?php echo $data_training['token'] ?></textarea>
          </div>

          <div class="form-group">
            <button type="submit" id="btn_update" name="btn_update" class="btn btn-success pull-right" value="proses"><i class="fa fa-refresh"></i> Update</button>
          </div>
        </div>

        <div class="box-footer">
          <?php if (isset($_POST['btn_update'])): ?>
            <pre>
            </pre>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
  </form>
</section>
<?php endif ?>
