<?php
$sql = $conn->prepare("SELECT * FROM data_training ORDER BY id DESC");
$data = Array();
$sql->execute($data);
$datas = $sql->fetchAll();
?>

<!-- Content Header (Page header) -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Manager Data Training</h3>
          <a href="?page=data-trainning" class="btn btn-success btn-sm pull-right">+</a>
        </div>

        <div class="box-body">
          <table id="data_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Judul</th>
                <th>Sumber</th>
                <th>Tahun</th>
                <th>Jenis</th>
                <th>Dokumen</th>
                <th>Token</th>
                <th>Kategori</th>
                <th width="5%">Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($datas as $data): ?>
              <tr>
                <td><?php echo $data['id']; ?></td>
                <td><?php echo $data['judul']; ?></td>
                <td><?php echo $data['sumber']; ?></td>
                <td><?php echo $data['tahun']; ?></td>
                <td><?php echo $data['jenis']; ?></td>
                <td><?php echo $data['dokumen']; ?></td>
                <td><?php echo $data['token']; ?></td>
                <td><?php echo $data['kategori']; ?></td>
                <td>
                  <a href="?page=data-trainning-edit&id=<?php echo $data['id']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> edit</a>
                  <a href="?action=delete-data-training&id=<?php echo $data['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> delete</a>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">

  </div>
</section>
