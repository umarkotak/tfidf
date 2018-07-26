<?php
$sql = $conn->prepare("SELECT * FROM data_berita ORDER BY id_berita DESC");
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
          <h3 class="box-title">Manager Data Berita</h3>
          <a href="?page=data-trainning" class="btn btn-success btn-sm pull-right">+</a>
        </div>

        <div class="box-body">
          <table id="data_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Id</th>
                <th>Judul</th>
                <th>Sumber</th>
                <th>Token</th>
                <th>Kategori</th>
                <th>Kemiripan</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($datas as $data): ?>
              <tr>
                <td><?php echo $data['id_berita']; ?></td>
                <td><?php echo $data['judul']; ?></td>
                <td><?php echo $data['sumber']; ?></td>
                <td><?php echo $data['token']; ?></td>
                <td><?php echo $data['kategori']; ?></td>
                <td><?php echo $data['kemiripan']; ?></td>
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
