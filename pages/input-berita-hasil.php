<?php
  $judul = $_POST['judul'];
  $sumber = $_POST['sumber'];
  $tahun = $_POST['tahun'];
  $teks_berita = $_POST['teks_berita'];
  $dokumen = sanitize($teks_berita);
  $kriteria = '';

  $myfile = fopen("temp.txt", "w") or die("Unable to open file!");
  fwrite($myfile, $dokumen);

  $command = "proses.py";
  exec($command, $outputs, $status);
  $hasil_stem = $outputs[5];

  $hasil_stem = str_replace("[","",$hasil_stem);
  $hasil_stem = str_replace("]","",$hasil_stem);
  $hasil_stem = str_replace(",","",$hasil_stem);
  $hasil_stem = str_replace("'","",$hasil_stem);

  // PROSES PERHITUNGAN

  $stem_berita = explode(" ", $hasil_stem);
  $terms = $stem_berita;
  $stem_data_training = Array();

  $sql = $conn->prepare("SELECT * FROM data_training WHERE jenis='berita' ORDER BY judul ASC");
  $data = Array(); $sql->execute($data);
  $data_trainings = $sql->fetchAll();

  foreach ($data_trainings as $key => $data_training) {
    $data_training = explode(" ", $data_training['token']);
    array_push($stem_data_training, $data_training);
    $terms = array_merge($terms, $data_training);
  } $terms = array_unique($terms);

  $query_data = array();
  array_push($query_data, $stem_berita);
  $query_data = array_merge($query_data, $stem_data_training);
  foreach ($query_data as $key => $value) {
    $query_data[$key] = array_count_values($value);
  }

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Hasil Pemrosesan Berita
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
          <p id="final_message" style="text-align: center">
            Berita dengan judul <small class="label bg-blue"><b><?php echo $judul; ?></b></small>
            yang diterbitkan oleh <small class="label bg-blue"><b><?php echo $sumber; ?></b></small>
            pada tahun <small class="label bg-blue"><b><?php echo $tahun; ?></b></small>
            memiliki kriteria <small class="label bg-blue"><b id="final_kriteria"><?php echo $kriteria; ?></b></small>
            <br><br>
          </p>

          <p style="text-align: center">
            <button type="button" id="show_proses" name="show_proses" class="btn btn-success" onclick="btn_show_proses()"><i class="fa fa-hourglass-3"></i> Lihat Detail Proses Pencocokan Berita</button>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div id="detail_proses" class="row" style="display: none;">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Proses Penghitungan Pencocokan Berita</h3>
        </div>

        <div class="box-body">
          <div class="form-group">
            <label>Proses berita menjadi stemming : </label><br>
            <pre>
              <?php print_r($outputs); ?>
            </pre>
          </div><hr>

          <div class="form-group" style="overflow-x:auto;">
            <table id="" class="table table-sm table-bordered table-hover">
              <thead>
                <tr class="info">
                  <?php $span = 2; ?>
                  <td colspan="<?php echo $span; ?>"></td>
                  <?php $span = count($query_data);; ?>
                  <td align="center" colspan="<?php echo $span; ?>">TF Kemunculan di Dokumen</td>
                  <?php $span = 4; ?>
                  <td colspan="<?php echo $span; ?>"></td>
                  <?php $span = count($query_data); ?>
                  <td align="center" colspan="<?php echo $span ?>">TF IDF</td>
                  <?php $span = count($query_data); ?>
                  <td align="center" colspan="<?php echo $span ?>">Panjang Vector</td>
                  <?php $span = count($query_data) - 1; ?>
                  <td align="center" colspan="<?php echo $span ?>">Wdt = W0 * Wi</td>
                </tr>
                <tr class="info">
                  <td>No</td>
                  <td>Terms</td>
                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if ($key == 0): ?>
                      <td><?php echo "q" ?></td>
                    <?php else: ?>
                      <td><?php echo "D".$key ?></td>
                    <?php endif ?>
                  <?php endforeach ?>
                  <td>DF</td>
                  <td>N</td>
                  <td>N/DF</td>
                  <td>IDF</td>
                  <?php foreach ($query_data as $key => $value): ?>
                    <td><?php echo "W".$key ?></td>
                  <?php endforeach ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <td><?php echo "W".$key ?></td>
                  <?php endforeach ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if($key == 0) continue; ?>
                    <td><?php echo "W".$key ?></td>
                  <?php endforeach ?>
                </tr>
              </thead>

              <tbody>
                <?php $ds = array(); $dfs = array(); $ns = array(); $ndfs = array(); $idfs = array(); ?>
                <?php $tfidfs = array(); $pvs = array(); $wdts = array(); ?>
                <?php $sum_pvs = array_fill(0, count($query_data), 0); ?>
                <?php $sum_wdts = array_fill(0, count($query_data), 0); ?>
                <?php $root_pvs = array_fill(0, count($query_data), 0); ?>
                <?php $root_wdts = array_fill(0, count($query_data), 0); ?>

                <?php foreach ($terms as $key_term => $term): ?>
                <tr>
                  <td id="no">
                    <?php echo $no = $key_term; ?>
                  </td>

                  <td id="term">
                    <?php echo $term; ?>
                  </td>

                  <!-- Untuk TF kemunculan di dokumen -->
                  <?php $hitung_awal_array = array(); ?>
                  <?php $df = 0; ?>
                  <?php $temp = array(); ?>
                  <?php foreach ($query_data as $key_data => $data): ?>
                    <?php $occur = 0; ?>
                    <?php if (isset($data[$term])) $occur = $data[$term]; ?>

                    <td id="d-<?php echo $key_data; ?>">
                      <?php if ($occur == 0): ?>
                        <?php echo $occur; ?>
                      <?php else: ?>
                        <span class="badge bg-light-blue"><?php echo $occur; ?></span>
                        <?php if($key_data > 0) $df++; ?>
                      <?php endif ?>

                      <?php $temp[$key_data] = $occur; ?>
                    </td>
                  <?php endforeach ?>
                  <?php $ds[$key_term] = $temp; ?>

                  <td id="df">
                    <?php $dfs[$key_term] = $df; ?>
                    <?php if ($df == 0): ?>
                      <?php echo $df; ?>
                    <?php else: ?>
                      <span class="badge bg-light-blue"><?php echo $df; ?></span>
                    <?php endif ?>
                  </td>

                  <td id="n">
                    <?php echo $ns[$key_term] = $n = count($data_trainings); ?>
                  </td>

                  <td id="ndf">
                    <?php $ndfs[$key_term] = ($df == 0) ? $ndf = 0 : $ndf = $n/$df; echo $ndf; ?>
                  </td>

                  <td id="idf">
                    <?php $idf = ($ndf == 0) ? $idfs[$key_term] = 0 : $idfs[$key_term] = log10($ndf); ?>
                    <?php if ($idf == 0): ?>
                      <?php echo number_format($idf, 6); ?>
                    <?php else: ?>
                      <span class="badge bg-light-blue"><?php echo number_format($idf, 6); ?></span>
                    <?php endif ?>
                  </td>

                  <!-- TF IDF -->
                  <?php $temp = array(); ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <td id="tfidf-w-<?php echo $key; ?>">
                      <?php $temp[$key] = $ds[$key_term][$key] * $idf; ?>
                      <?php if ($temp[$key] == 0): ?>
                        <?php echo number_format($temp[$key], 3); ?>
                      <?php else: ?>
                        <span class="badge bg-light-blue"><?php echo number_format($temp[$key], 3); ?></span>
                      <?php endif ?>
                    </td>
                  <?php endforeach ?>
                  <?php $tfidfs[$key_term] = $temp; ?>

                  <?php $temp = array(); ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <td id="panjang-vector-w-<?php echo $key; ?>">
                      <?php $temp[$key] = $tfidfs[$key_term][$key] * $tfidfs[$key_term][$key]; ?>
                      <?php if ($temp[$key] == 0): ?>
                        <?php echo number_format($temp[$key], 3); ?>
                      <?php else: ?>
                        <span class="badge bg-light-blue"><?php echo number_format($temp[$key], 3); ?></span>
                      <?php endif ?>
                      <?php $sum_pvs[$key] += $temp[$key]; ?>
                    </td>
                  <?php endforeach ?>
                  <?php $pvs[$key_term] = $temp[$key]; ?>

                  <?php $temp = array(); ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if($key == 0) continue; ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <?php $temp[$key] = $tfidfs[$key_term][0] * $tfidfs[$key_term][$key]; ?>
                      <?php if ($temp[$key] == 0): ?>
                        <?php echo number_format($temp[$key], 3); ?>
                      <?php else: ?>
                        <span class="badge bg-light-blue"><?php echo number_format($temp[$key], 3); ?></span>
                      <?php endif ?>
                      <?php $sum_wdts[$key] += $temp[$key]; ?>
                    </td>
                  <?php endforeach ?>
                  <?php $pvs[$key_term] = $temp[$key]; ?>
                </tr>
                <?php endforeach ?>

                <tr class="info">
                  <?php $span = 2 + count($query_data) + 4 + count($query_data) - 2; ?>
                  <td colspan="<?php echo $span; ?>"></td>
                  <?php $span = 2; ?>
                  <td colspan="<?php echo $span; ?>">Jumlah Bobot</td>

                  <?php foreach ($query_data as $key => $value): ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <span class="badge bg-light-blue"><?php echo number_format($sum_pvs[$key], 3); ?></span>
                    </td>
                  <?php endforeach ?>

                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if($key == 0) continue; ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <span class="badge bg-light-blue"><?php echo number_format($sum_wdts[$key], 3); ?></span>
                    </td>
                  <?php endforeach ?>
                </tr>

                <tr class="info">
                  <?php $span = 2 + count($query_data) + 4 + count($query_data) - 2; ?>
                  <td colspan="<?php echo $span; ?>"></td>
                  <?php $span = 2; ?>
                  <td colspan="<?php echo $span; ?>">Akar Bobot</td>

                  <?php foreach ($query_data as $key => $value): ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <?php $root_pvs[$key] = sqrt($sum_pvs[$key]); ?>
                      <span class="badge bg-light-blue"><?php echo number_format($root_pvs[$key], 3); ?></span>
                    </td>
                  <?php endforeach ?>

                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if($key == 0) continue; ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <?php $root_wdts[$key] = sqrt($sum_wdts[$key]); ?>
                      <span class="badge bg-light-blue"><?php echo number_format($root_wdts[$key], 3); ?></span>
                    </td>
                  <?php endforeach ?>
                </tr>
              </tbody>
            </table>
          </div>

          <div>
            <h3>Hasil Kategori</h3>
            <table class="table table-bordered">
              <tr>
                <?php $hasil =  array(); ?>
                <?php $name_fix_kategori = ""; $value_kecocokan_berita = 0; ?>
                <?php foreach ($data_trainings as $key => $data_training): ?>
                  <td>
                    <?php $tmp = ($root_pvs[0]*$root_pvs[$key+1]); ?>
                    <?php $hasil[$key] = $tmp == 0 ? 0 : $sum_wdts[$key+1]/$tmp; ?>
                    <?php if($hasil[$key] > $value_kecocokan_berita) { $value_kecocokan_berita = $hasil[$key]; $name_fix_kategori = $data_training['kategori']; } ?>
                    <span class="badge bg-light-blue"><?php echo $data_training['kategori']." = ".$hasil[$key]; ?></span>
                  </td>
                <?php endforeach ?>
                <td>
                  <span class="badge bg-green"><?php echo $name_fix_kategori." = ".number_format($value_kecocokan_berita, 3); ?></span>
                </td>
              </tr>
            </table> 

            <?php if ($value_kecocokan_berita >= 0.45): ?>
              <p style="text-align: center">
                <input id="hidden_value_fix_kategori" type="hidden" name="hidden_value_fix_kategori" value="<?php echo $value_kecocokan_berita ?>">
                <button type="button" id="show_proses2" name="show_proses" class="btn btn-success" onclick="btn_show_proses2()"><i class="fa fa-hourglass-3"></i> Lihat Detail Proses Kategorisasi CSR</button>
              </p>
            <?php else: ?>
              <script type="text/javascript">
                setTimeout(
                  function() {
                  $("#final_message").html('Bukan termasuk berita pemberdayaan perempuan');
                  }, 1000);
              </script>
            <?php endif ?>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php
    $stem_data_training = Array();

    $sql = $conn->prepare("SELECT * FROM data_training WHERE jenis='csr' ORDER BY judul ASC");
    $data = Array(); $sql->execute($data);
    $data_trainings = $sql->fetchAll();

    foreach ($data_trainings as $key => $data_training) {
      $data_training = explode(" ", $data_training['token']);
      array_push($stem_data_training, $data_training);
      $terms = array_merge($terms, $data_training);
    } $terms = array_unique($terms);

    $query_data = array();
    array_push($query_data, $stem_berita);
    $query_data = array_merge($query_data, $stem_data_training);
    foreach ($query_data as $key => $value) {
      $query_data[$key] = array_count_values($value);
    }
  ?>

  <div id="detail_proses2" class="row" style="display: none;">
    <div class="col-sm-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Proses Penghitungan Kategorisasi CSR</h3>
        </div>

        <div class="box-body">
          <div class="form-group">
            <label>Proses berita menjadi stemming : </label><br>
            <pre>
              <?php print_r($outputs); ?>
            </pre>
          </div><hr>

          <div class="form-group" style="overflow-x:auto;">
            <table id="" class="table table-sm table-bordered table-hover">
              <thead>
                <tr class="info">
                  <?php $span = 2; ?>
                  <td colspan="<?php echo $span; ?>"></td>
                  <?php $span = count($query_data);; ?>
                  <td align="center" colspan="<?php echo $span; ?>">TF Kemunculan di Dokumen</td>
                  <?php $span = 4; ?>
                  <td colspan="<?php echo $span; ?>"></td>
                  <?php $span = count($query_data); ?>
                  <td align="center" colspan="<?php echo $span ?>">TF IDF</td>
                  <?php $span = count($query_data); ?>
                  <td align="center" colspan="<?php echo $span ?>">Panjang Vector</td>
                  <?php $span = count($query_data) - 1; ?>
                  <td align="center" colspan="<?php echo $span ?>">Wdt = W0 * Wi</td>
                </tr>
                <tr class="info">
                  <td>No</td>
                  <td>Terms</td>
                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if ($key == 0): ?>
                      <td><?php echo "q" ?></td>
                    <?php else: ?>
                      <td><?php echo "D".$key ?></td>
                    <?php endif ?>
                  <?php endforeach ?>
                  <td>DF</td>
                  <td>N</td>
                  <td>N/DF</td>
                  <td>IDF</td>
                  <?php foreach ($query_data as $key => $value): ?>
                    <td><?php echo "W".$key ?></td>
                  <?php endforeach ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <td><?php echo "W".$key ?></td>
                  <?php endforeach ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if($key == 0) continue; ?>
                    <td><?php echo "W".$key ?></td>
                  <?php endforeach ?>
                </tr>
              </thead>

              <tbody>
                <?php $ds = array(); $dfs = array(); $ns = array(); $ndfs = array(); $idfs = array(); ?>
                <?php $tfidfs = array(); $pvs = array(); $wdts = array(); ?>
                <?php $sum_pvs = array_fill(0, count($query_data), 0); ?>
                <?php $sum_wdts = array_fill(0, count($query_data), 0); ?>
                <?php $root_pvs = array_fill(0, count($query_data), 0); ?>
                <?php $root_wdts = array_fill(0, count($query_data), 0); ?>

                <?php foreach ($terms as $key_term => $term): ?>
                <tr>
                  <td id="no">
                    <?php echo $no = $key_term; ?>
                  </td>

                  <td id="term">
                    <?php echo $term; ?>
                  </td>

                  <?php $hitung_awal_array = array(); ?>
                  <?php $df = 0; ?>
                  <?php $temp = array(); ?>
                  <?php foreach ($query_data as $key_data => $data): ?>
                    <?php $occur = 0; ?>
                    <?php if (isset($data[$term])) $occur = $data[$term]; ?>

                    <td id="d-<?php echo $key_data; ?>">
                      <?php if ($occur == 0): ?>
                        <?php echo $occur; ?>
                      <?php else: ?>
                        <span class="badge bg-light-blue"><?php echo $occur; ?></span>
                        <?php if($key_data > 0) $df++; ?>
                      <?php endif ?>

                      <?php $temp[$key_data] = $occur; ?>
                    </td>
                  <?php endforeach ?>
                  <?php $ds[$key_term] = $temp; ?>

                  <td id="df">
                    <?php $dfs[$key_term] = $df; ?>
                    <?php if ($df == 0): ?>
                      <?php echo $df; ?>
                    <?php else: ?>
                      <span class="badge bg-light-blue"><?php echo $df; ?></span>
                    <?php endif ?>
                  </td>

                  <td id="n">
                    <?php echo $ns[$key_term] = $n = count($data_trainings); ?>
                  </td>

                  <td id="ndf">
                    <?php $ndfs[$key_term] = ($df == 0) ? $ndf = 0 : $ndf = $n/$df; echo $ndf; ?>
                  </td>

                  <td id="idf">
                    <?php $idf = ($ndf == 0) ? $idfs[$key_term] = 0 : $idfs[$key_term] = log10($ndf); ?>
                    <?php if ($idf == 0): ?>
                      <?php echo number_format($idf, 6); ?>
                    <?php else: ?>
                      <span class="badge bg-light-blue"><?php echo number_format($idf, 6); ?></span>
                    <?php endif ?>
                  </td>

                  <?php $temp = array(); ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <td id="tfidf-w-<?php echo $key; ?>">
                      <?php $temp[$key] = $ds[$key_term][$key] * $idf; ?>
                      <?php if ($temp[$key] == 0): ?>
                        <?php echo number_format($temp[$key], 3); ?>
                      <?php else: ?>
                        <span class="badge bg-light-blue"><?php echo number_format($temp[$key], 3); ?></span>
                      <?php endif ?>
                    </td>
                  <?php endforeach ?>
                  <?php $tfidfs[$key_term] = $temp; ?>

                  <?php $temp = array(); ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <td id="panjang-vector-w-<?php echo $key; ?>">
                      <?php $temp[$key] = $tfidfs[$key_term][$key] * $tfidfs[$key_term][$key]; ?>
                      <?php if ($temp[$key] == 0): ?>
                        <?php echo number_format($temp[$key], 3); ?>
                      <?php else: ?>
                        <span class="badge bg-light-blue"><?php echo number_format($temp[$key], 3); ?></span>
                      <?php endif ?>
                      <?php $sum_pvs[$key] += $temp[$key]; ?>
                    </td>
                  <?php endforeach ?>
                  <?php $pvs[$key_term] = $temp[$key]; ?>

                  <?php $temp = array(); ?>
                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if($key == 0) continue; ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <?php $temp[$key] = $tfidfs[$key_term][0] * $tfidfs[$key_term][$key]; ?>
                      <?php if ($temp[$key] == 0): ?>
                        <?php echo number_format($temp[$key], 3); ?>
                      <?php else: ?>
                        <span class="badge bg-light-blue"><?php echo number_format($temp[$key], 3); ?></span>
                      <?php endif ?>
                      <?php $sum_wdts[$key] += $temp[$key]; ?>
                    </td>
                  <?php endforeach ?>
                  <?php $pvs[$key_term] = $temp[$key]; ?>
                </tr>
                <?php endforeach ?>

                <tr class="info">
                  <?php $span = 2 + count($query_data) + 4 + count($query_data) - 2; ?>
                  <td colspan="<?php echo $span; ?>"></td>
                  <?php $span = 2; ?>
                  <td colspan="<?php echo $span; ?>">Jumlah Bobot</td>

                  <?php foreach ($query_data as $key => $value): ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <span class="badge bg-light-blue"><?php echo number_format($sum_pvs[$key], 3); ?></span>
                    </td>
                  <?php endforeach ?>

                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if($key == 0) continue; ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <span class="badge bg-light-blue"><?php echo number_format($sum_wdts[$key], 3); ?></span>
                    </td>
                  <?php endforeach ?>
                </tr>

                <tr class="info">
                  <?php $span = 2 + count($query_data) + 4 + count($query_data) - 2; ?>
                  <td colspan="<?php echo $span; ?>"></td>
                  <?php $span = 2; ?>
                  <td colspan="<?php echo $span; ?>">Akar Bobot</td>

                  <?php foreach ($query_data as $key => $value): ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <?php $root_pvs[$key] = sqrt($sum_pvs[$key]); ?>
                      <span class="badge bg-light-blue"><?php echo number_format($root_pvs[$key], 3); ?></span>
                    </td>
                  <?php endforeach ?>

                  <?php foreach ($query_data as $key => $value): ?>
                    <?php if($key == 0) continue; ?>
                    <td id="wdt-w-<?php echo $key; ?>">
                      <?php $root_wdts[$key] = sqrt($sum_wdts[$key]); ?>
                      <span class="badge bg-light-blue"><?php echo number_format($root_wdts[$key], 3); ?></span>
                    </td>
                  <?php endforeach ?>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="form-group" style="overflow-x:auto;">
            <h3>Hasil Kategori</h3>
            <table class="table table-bordered">
              <tr>
                <?php $hasil =  array(); ?>
                <?php $name_fix_kategori = ""; $value_fix_kategori = 0; ?>
                <?php foreach ($data_trainings as $key => $data_training): ?>
                  <td>
                    <?php $hasil[$key] = $sum_wdts[$key+1]/($root_pvs[0]*$root_pvs[$key+1]); ?>
                    <?php if($hasil[$key] > $value_fix_kategori) { $value_fix_kategori = $hasil[$key]; $name_fix_kategori = $data_training['kategori']; } ?>
                    <span class="badge bg-light-blue"><?php echo $data_training['kategori']." = ".number_format($hasil[$key], 3); ?></span>
                  </td>
                <?php endforeach ?>
                <td>
                  <span class="badge bg-green"><?php echo $name_fix_kategori." = ".number_format($value_fix_kategori, 3); ?></span>
                </td>
              </tr>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
  </form>
</section>

<?php
  $judul = $_POST['judul'];
  $sumber = $_POST['sumber'];
  $token = implode(' ',$stem_berita);
  $kategori = ($value_kecocokan_berita >= 0.5) ? $name_fix_kategori : 'bukan berita csr';
  $kemiripan = ($value_kecocokan_berita >= 0.5) ? number_format($value_fix_kategori, 2) : 0;

  $sql = $conn->prepare("INSERT INTO data_berita (judul, sumber, token, kategori, kemiripan) VALUES(:judul, :sumber, :token, :kategori, :kemiripan)");
  $data = Array(
    ':judul' => $judul,
    ':sumber' => $sumber,
    ':token' => $token,
    ':kategori' => $kategori,
    ':kemiripan' => $kemiripan
  );
  $sql->execute($data);
?>

<script type="text/javascript">
  var pesan = "<?php echo $name_fix_kategori; ?>";

  setTimeout(
    function() {
    $("#final_kriteria").text(pesan);
    }, 2000);

  function btn_show_proses() {
    $("#detail_proses").css({"display": "block"});
  }

  function btn_show_proses2() {
    $("#detail_proses2").css({"display": "block"});
  }
</script>
