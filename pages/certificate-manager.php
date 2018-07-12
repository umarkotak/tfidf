<?php
$sql = $conn->prepare("SELECT * FROM certificates ORDER BY id DESC");
$data = Array();
$sql->execute($data);
$certificates = $sql->fetchAll();
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Certificate Manager
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Certificate</a></li>
    <li class="active">Manager</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Data sertifikat diupload</h3>
        </div>

        <div class="box-body">
          <table id="data_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Pemilik</th>
                <th>Sertifikat</th>
                <th>Penerbit</th>
                <th>Tanggal Terbit</th>
                <th>Nomor Sertifikat</th>
                <th>Informasi Tambahan</th>
                <th>Gambar</th>
                <th>Status</th>
                <th width="5%">Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($certificates as $certifacate): ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $certifacate['nama_pemilik']; ?></td>
                <td><?php echo $certifacate['nama_sertifikat']; ?></td>
                <td><?php echo $certifacate['penerbit_sertifikat']; ?></td>
                <td><?php echo $certifacate['tanggal_terbit']; ?></td>
                <td><?php echo $certifacate['nomor_sertifikat']; ?></td>
                <td><?php echo $certifacate['informasi_tambahan']; ?></td>
                <td><a data-toggle="modal" data-target="#modal-primary-<?php echo $no; ?>"><img src="images/uploaded_certificate/<?php echo $certifacate['link_gambar']; ?>" class="img-thumbnail" style="width: 120px; height: 70px;"></a></td>
                <td>
                  <?php if ($certifacate['status'] == "unverified"): ?>
                    <small class="label bg-yellow"><?php echo $certifacate['status']; ?></small>
                  <?php elseif($certifacate['status'] == "verified"): ?>
                    <small class="label bg-green"><?php echo $certifacate['status']; ?></small>
                  <?php else: ?>
                    <small class="label bg-red"><?php echo $certifacate['status']; ?></small>
                  <?php endif ?>
                <td>
                  <a href="?action=get_verify_asli&id=<?php echo $certifacate['id']; ?>" class="btn btn-success btn-xs" onclick="return confirm('Apakah anda sudah mengecek kembali?')"><i class="glyphicon glyphicon-ok"></i> Asli</a>
                  <a href="?action=get_verify_palsu&id=<?php echo $certifacate['id']; ?>" class="btn btn-warning btn-xs" onclick="return confirm('Apakah anda sudah mengecek kembali?')"><i class="glyphicon glyphicon-remove"></i> Palsu</a>
                  <a href="?action=get_delete_uploaded_certificate&id=<?php echo $certifacate['id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin ingin menghapus sertifikat ini?')"><i class="glyphicon glyphicon-trash"></i> hapus</a>
                </td>
              </tr>

              <div class="modal modal-primary fade" id="modal-primary-<?php echo $no; ?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Sertifikat <?php echo $certifacate['nama_sertifikat']; ?></h4>
                    </div>
                    <div class="modal-body">
                      <img src="images/uploaded_certificate/<?php echo $certifacate['link_gambar']; ?>" class="img-thumbnail">
                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-success btn-sm pull-right" href="images/uploaded_certificate/<?php echo $certifacate['link_gambar']; ?>" download>Download</a>
                    </div>
                  </div>
                </div>
              </div>

              <?php $no += 1; ?>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
