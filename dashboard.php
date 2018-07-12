<?php session_start(); ?>

<?php include "config.php" ?>

<!DOCTYPE html>
<html>
<?php include "head.php"; ?>

<body class="hold-transition skin-blue sidebar-mini">

<?php include "notice.php" ?>
<div class="wrapper">
  <?php include "navbar.php"; ?>
  <?php include "sidebar.php"; ?>

  <div class="content-wrapper">
  <?php include "content.php"; ?>
  </div>

  <?php include "footer.php"; ?>
  <?php include "script.php"; ?>
</div>

</body>
</html>