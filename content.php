<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];

  if ($page == 'dashboard')                                      { include "pages/dashboard.php"; }
  else if ($page == 'setting')                                   { include "pages/setting.php"; }

  else if ($page == 'input-berita')                              { include "pages/input-berita.php"; }
  else if ($page == 'input-berita-hasil')                        { include "pages/input-berita-hasil.php"; }
  else if ($page == 'data-trainning')                            { include "pages/data-trainning.php"; }
  else if ($page == 'data-trainning-edit')                       { include "pages/data-trainning-edit.php"; }
  else if ($page == 'manager-data')                              { include "pages/manager-data.php"; }


  else                                                           { include "pages/notfound.php"; }

} else if (isset($_GET['action'])) {
  $action = $_GET['action'];

  if ($action == 'post_publish_certificate')                     { include "action/post_publish_certificate.php"; }
  else if ($action == 'post_upload_certificate')                 { include "action/post_upload_certificate.php"; }
  else if ($action == 'delete-data-training')                    { include "action/get-delete-data-training.php"; }

} else {
  include "pages/dashboard.php";
}
?>