<?php 
 $judul = $_POST['judul'];
 $sumber = $_POST['sumber'];
 $tahun = $_POST['tahun'];
 $teks_berita = $_POST['teks_berita'];
 $kriteria = 'kriteria';

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Hasil Pemrosesasn Berita
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">input berita</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <form action="?page=input-berita-hasil" method="post">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header">
        </div>

        <div class="box-body">
          <p style="text-align: center">
            Berita dengan judul <small class="label bg-blue"><b><?php echo $judul; ?></b></small> 
            yang diterbitkan oleh <small class="label bg-blue"><b><?php echo $sumber; ?></b></small> 
            pada tahun <small class="label bg-blue"><b><?php echo $tahun; ?></b></small> 
            memiliki kriteria <small class="label bg-blue"><b><?php echo $kriteria; ?></b></small>
            <br><br>
            <button type="button" id="show_proses" name="show_proses" class="btn btn-success" onclick="btn_show_proses()"><i class="fa fa-hourglass-3"></i> Lihat Detail Proses</button>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div id="detail_proses" class="row" style="display: none;">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Proses Penghitungan</h3>
        </div>

        <div class="box-body">
          
        </div>
      </div>
    </div>
  </div>
  </form>
</section>

<script type="text/javascript">
  function btn_show_proses() {
    $("#detail_proses").css({"display": "block"});
  }
</script>
