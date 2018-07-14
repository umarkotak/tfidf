<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Input Berita
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
          <?php if (isset($hasil) == false): ?>
            <div class="form-group">
              <label>Judul</label>
              <input type="text" id="judul" name="judul" class="form-control" placeholder="" value="suatu judul berita">
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Sumber</label>
                  <input type="text" id="sumber" name="sumber" class="form-control" placeholder="Sumber Berita" value="radar bogor">
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tahun</label>
                  <input type="text" id="tahun" name="tahun" class="form-control" placeholder="Tahun Terbit" value="2018">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Teks Berita</label>
              <textarea id="teks_berita" name="teks_berita" class="form-control" rows="7">pontianak antaranews kalbar bayi bernama zahratussyifa meninggal diduga karena menderita demam berdarah dengue DBD meski sempat dirawat rumah sakit umum daerah rsud sultan syarif muhammad pontianak</textarea>
            </div>

            <div class="form-group">
              <button type="submit" id="btn_proses" name="btn_proses" class="btn btn-success pull-right" value="proses"><i class="fa fa-refresh"></i> Proses</button>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
  </form>
</section>
