<?php
if (isset($_POST['btn_proses'])) {
  $judul = $_POST['judul'];
  $sumber = $_POST['sumber'];
  $tahun = $_POST['tahun'];
  $jenis = $_POST['jenis'];
  $kategori = $_POST['kategori'];
  $dokumen = $_POST['teks_berita'];

  $myfile = fopen("temp.txt", "w") or die("Unable to open file!");
  fwrite($myfile, $dokumen);

  $command = "proses.py";
  exec($command, $outputs, $status);
  $hasil_stem = $outputs[5];

  $hasil_stem = str_replace("[","",$hasil_stem);
  $hasil_stem = str_replace("]","",$hasil_stem);
  $hasil_stem = str_replace(",","",$hasil_stem);
  $hasil_stem = str_replace("'","",$hasil_stem);
  $hasil_stem = str_replace("\"","",$hasil_stem);
  $token = $hasil_stem;

  try {
    $sql = $conn->prepare("INSERT INTO data_training (judul, sumber, tahun, jenis, dokumen, token, kategori) VALUES(:judul, :sumber, :tahun, :jenis, :dokumen, :token, :kategori)");
    $data = Array(
      ':judul' => $judul,
      ':sumber' => $sumber,
      ':tahun' => $tahun,
      ':jenis' => $jenis,
      ':dokumen' => $dokumen,
      ':token' => $token,
      ':kategori' => $kategori
    );
    $sql->execute($data);

    $_SESSION['green-notice'] = "Data berhasil disimpan";
    header("location: ?page=data-trainning");
  } catch (Exception $e) {

    $_SESSION['red-notice'] = "Terjadi kesalahan " . $e->getMessage();
    header("location: ?page=data-trainning");
  }
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data-Trainning
    <small>Laporan CSR</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Setting</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <form action="" method="post">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Form Masukkan Data Training</h3>
        </div>

        <div class="box-body">
          <div class="form-group">
            <label>Judul</label>
            <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul Berita">
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Sumber</label>
                <input type="text" id="sumber" name="sumber" class="form-control" placeholder="Sumber Berita">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Tahun</label>
                <input type="text" id="tahun" name="tahun" class="form-control" placeholder="Tahun Terbit">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Jenis</label>
                <select id="jenis" name="jenis" class="form-control">
                  <option value="csr">CSR</option>
                  <option value="berita">Berita</option>
                </select>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Kategori</label>
                <select id="kategori" name="kategori" class="form-control">
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
            <textarea id="teks_berita" name="teks_berita" class="form-control" rows="7"></textarea>
          </div>

          <div class="form-group">
            <button type="submit" id="btn_proses" name="btn_proses" class="btn btn-success pull-right" value="proses"><i class="fa fa-refresh"></i> Proses</button>
          </div>
        </div>

        <div class="box-footer">
          <?php if (isset($_POST['btn_proses'])): ?>
            <pre>
              <?php print_r($outputs); ?>
            </pre>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
  </form>
</section>
