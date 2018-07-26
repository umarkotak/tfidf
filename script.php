<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/Chart.js/Chart.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="bower_components/Flot/jquery.flot.js"></script>
<script src="bower_components/Flot/jquery.flot.resize.js"></script>
<script src="bower_components/Flot/jquery.flot.pie.js"></script>
<script src="bower_components/Flot/jquery.flot.categories.js"></script>

<script>
  $(function () {
    $('#data_table').DataTable();
  })
</script>

<?php
$sql = $conn->prepare("SELECT kategori, count(kategori) AS jumlah FROM data_berita GROUP BY kategori DESC");
$data = Array();
$sql->execute($data);
$datas = $sql->fetchAll();
$grafik_data_array = array();
foreach ($datas as $data) {
  $string = '';
  $string = $string.'[';
  $string = $string."'";
  $string = $string.$data['kategori'];
  $string = $string."', ";
  $string = $string.$data['jumlah'];
  $string = $string.']';
  array_push($grafik_data_array, $string);
}
$grafik_data_string = implode(', ', $grafik_data_array);
$final = '['.$grafik_data_string.']';
?>

<script type="text/javascript">
  var bar_data = {
    data : <?php echo $final; ?>,
    color: '#3c8dbc'
  }
  $.plot('#bar-chart', [bar_data], {
    grid  : {
      borderWidth: 1,
      borderColor: '#f3f3f3',
      tickColor  : '#f3f3f3'
    },
    series: {
      bars: {
        show    : true,
        barWidth: 0.5,
        align   : 'center'
      }
    },
    xaxis : {
      mode      : 'categories',
      tickLength: 0
    }
  })
</script>
