<script src="lib/cleanstego.js"></script>
<script src="lib/crypto/sha512v3.js"></script>
<script src="lib/crypto/aes.js"></script>
<script src="lib/crypto/aesctr.js"></script>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Protect Certificate
    <small>.</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Protect</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div id="result" style="background-color: rgba(0,255,0,0.3); padding: 10px 10px 10px 10px;" hidden></div>

  <form method="post" action="?action=post_publish_certificate" enctype="multipart/form-data">
  <div id="row_input" class="row" style="display: block;">
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Masukkan Data Sertifikat</h3>
        </div>

        <div class="box-body">
          <div class="form-group">
            <label>Nama Pemilik Sertifikat</label>
            <input type="text" id="certificate_owner_name" name="certificate_owner_name" class="form-control" placeholder="m umar ramadhana">
          </div>

          <div class="form-group">
            <label>Nama Sertifikat</label>
            <input type="text" id="certificate_name" name="certificate_name" class="form-control" placeholder="workshop html dasar">
          </div>

          <div class="form-group">
            <label>Penerbit Sertifikat</label>
            <input type="text" id="certificate_publisher" name="certificate_publisher" class="form-control" placeholder="lab dasar stt pln">
          </div>

          <div class="form-group">
            <label>Tanggal Terbit Sertifikat</label>
            <input type="date" id="certificate_date_published" name="certificate_date_published" class="form-control">
          </div>

          <div class="form-group">
            <label>Nomor Sertifikat</label>
            <input type="text" id="certificate_number" name="certificate_number" class="form-control" placeholder="201701">
          </div>

          <div class="form-group">
            <label>Informasi Tambahan</label>
            <textarea id="certificate_additional_information" name="certificate_additional_information" class="form-control" rows="4" placeholder="sertifikat workshop html lab dasar"></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header">
        </div>

        <div class="box-body">
          <div class="form-group">
            <label>Upload Gambar Sertifikat</label>
            <p>Gambar sertifikat yang diupload akan di resize menjadi 800 x 450 pixels,</p>
            <input type="file" accept="image/*" id="certificate_image" name="certificate_image" onchange="preview_image(event)" class="form-control">
            <img id="preview_certificate_image" width="100%" class="img-thumbnail">
          </div>

          <div id="div_confirmation" class="form-group">
            <button type="button" id="btn_protect_certificate" onclick="protect_certificate()" class="btn btn-success pull-right">Protect Certificate</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="row_result" class="row" style="display: block;">
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Hasil Sertifikat</h3>
        </div>

        <div class="box-body">
          <div class="form-group">
            <label>Pesan : </label>
            <textarea id="raw_message" class="form-control" rows="4" readonly></textarea>
            <hr>

            <label>Pesan Terenkripsi : </label>
            <textarea id="encrypted_message" class="form-control" rows="4" readonly></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header">
        </div>

        <div class="box-body">
          <div style="height: 460px;">
            <img src="" id="certificate_final_image" class="img-thumbnail">
          </div>

          <input type="hidden" id="base64_certificate" name="base64_certificate">

          <button type="submit" id="btn_publish_certificate" class="btn btn-success pull-right" style="display: none;">Publish Certificate</button>
          <a id="btn_download_certificate" name="btn_download_certificate" href="#" onclick="this.href = $('#certificate_final_image').attr('src');"  class="btn btn-success pull-right" style="display: none;" download>Download Certificate</a>
        </div>
      </div>
    </div>
  </div>
  </form>

  <div id="row_process" class="row" style="display: block">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Tahap Proses Steganografi Citra</h3>
        </div>

        <div class="box-body">
          <div id="log-before">
            <div class="form-group">
              <label>Tahap 1 : Enkripsi Pesan</label><br><hr>

              <label>Pesan Asli : </label>
              <textarea id="log_before_raw_message" class="form-control" rows="4" readonly></textarea>
              <hr>

              <label>Hasil Enkripsi sha512 : </label>
              <textarea id="log_before_message_encrypted_by_sha512" class="form-control" rows="4" readonly></textarea>
              <hr>

              <label>Hasil Enkripsi AES dengan Kunci sha512</label>
              <textarea id="log_before_message_encrypted_by_aes" class="form-control" rows="4" readonly></textarea>
              <hr>

              <label>Spesifikasi Pesan</label>
              <textarea id="log_before_message_spesification" class="form-control" rows="1" readonly></textarea>
              <hr>

              <label>Pesan dalam bentuk ASCII dan Biner</label>
              <textarea id="log_before_message_in_binary" class="form-control" rows="6" readonly></textarea>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
        </div>

        <div class="box-body">
          <div id="log-after">
            <div class="form-group">
              <label>Tahap 2 : Penyisipan Pesan</label><br><hr>

              <label>Spesifikasi Gambar</label>
              <textarea id="log_before_image_spesification" class="form-control" rows="3" readonly></textarea>
              <hr>

              <label>Nilai setiap pixel pada gambar sebelum penyisipan</label>
              <textarea id="log_before_image_data" class="form-control" rows="10" readonly></textarea>
              <hr>

              <label>Nilai mapping penyimpanan pesan</label>
              <textarea id="log_after_valid_pixels" class="form-control" rows="3" readonly></textarea>
              <hr>

              <label>Data nilai map diurut secara ascending</label>
              <textarea id="log_after_valid_pixels_asc" class="form-control" rows="3" readonly></textarea>
              <hr>

              <label>Nilai setiap pixel pada gambar sesudah penyisipan</label>
              <textarea id="log_after_image_data" class="form-control" rows="10" readonly></textarea>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">

  var preview_image = function(event) {
    var preview_certificate_image = document.getElementById('preview_certificate_image');
    preview_certificate_image.src = URL.createObjectURL(event.target.files[0]);
    $("#div_confirmation").show();
  };

  function protect_certificate() {
    var certificate_data = initiate_data();
    var processed_certificate_data = preprocess_certificate_data(certificate_data);

    var message_spesification = {};
    message_spesification["panjang_pesan"] = processed_certificate_data["certificate_secret_data"].length;
    message_spesification["panjang_pesan_dalam_bit"] = processed_certificate_data["certificate_secret_data"].length*8;

    $("#raw_message").val(processed_certificate_data["certificate_data_json"]);
    $("#log_before_raw_message").val(processed_certificate_data["certificate_data_json"]);
    $("#log_before_message_encrypted_by_sha512").val(processed_certificate_data["certificate_data_json_512hash"]);
    $("#log_before_message_encrypted_by_aes").val(processed_certificate_data["certificate_secret_data"]);
    $("#encrypted_message").val(processed_certificate_data["certificate_secret_data"]);
    $("#log_before_message_spesification").val(JSON.stringify(message_spesification));

    write_data_to_image(processed_certificate_data["certificate_secret_data"]);
  }

  function write_data_to_image(certificate_secret_data) {
    $("#certificate_final_image").hide();
    $("#certificate_final_image").attr('src','');
    $("#result").show();
    $("#result").html('Sedang mengolah gambar sertifikat . . .');
    function writefunc(){
      var t = writeMsgToCanvas('canvas',certificate_secret_data,"default");
      if(t!=null){
        var myCanvas = document.getElementById("canvas");
        var image = myCanvas.toDataURL("image/png");
        $("#certificate_final_image").attr('src',image);
        $("#result").html('Data rahasia berhasil disisipkan, Silahkan save gambar di bawah ini kedalam perangkat anda.');
        show_blocks();
        modify_original_file_content(image);
      }
    }
    loadIMGtoCanvas('certificate_image','canvas',writefunc,850,170);

    console.log("finished");
  }

  function initiate_data() {
    var certificate_data = {};
    certificate_data["certificate_name"] = $("#certificate_name").val();
    certificate_data["certificate_publisher"] = $("#certificate_publisher").val();
    certificate_data["certificate_date_published"] = $("#certificate_date_published").val();
    certificate_data["certificate_number"] = $("#certificate_number").val();
    certificate_data["certificate_additional_information"] = $("#certificate_additional_information").val();
    certificate_data["certificate_owner_name"] = $("#certificate_owner_name").val();
    return certificate_data;
  }

  function preprocess_certificate_data(certificate_data) {
    var data = {};
    data["certificate_data_json"] = JSON.stringify(certificate_data);
    data["certificate_data_json_512hash"] = Sha512.hash(data["certificate_data_json"]);
    data["certificate_data_json_aes_enc"] = AesCtr.encrypt(data["certificate_data_json"], data["certificate_data_json_512hash"], 256);
    data["certificate_data_json_dec"] = AesCtr.decrypt(data["certificate_data_json_aes_enc"], data["certificate_data_json_512hash"], 256);
    data["certificate_secret_data"] = data["certificate_data_json_aes_enc"] + "0|" + data["certificate_data_json_512hash"].split("").reverse().join("");
    data["output"] = data["certificate_secret_data"].split("0|");
    data["output"] = AesCtr.decrypt(data["output"][0], data["output"][1].split("").reverse().join(""), 256);
    return data;
  }

  function show_blocks() {
    $("#row_input").css({"display": "none"});
    $("#row_result").show();
    $("#row_process").show();

    $("#certificate_final_image").show();
    $("#btn_publish_certificate").show();
    $("#btn_download_certificate").show();
  }

  function modify_original_file_content(image) {
    $("#base64_certificate").val(image);
  }

</script>