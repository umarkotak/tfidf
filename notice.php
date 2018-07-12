<?php if (isset($_SESSION['red-notice'])): ?>
<div class="alert alert-danger alert-dismissible" style="padding: 5px; margin-bottom: 0px;">
  <p><b>Notice : </b><?php echo $_SESSION['red-notice']; ?><button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="alert" aria-hidden="true">×</button></p>
</div>
<?php unset($_SESSION['red-notice']); ?>
<?php endif ?>

<?php if (isset($_SESSION['green-notice'])): ?>
<div class="alert alert-success alert-dismissible" style="padding: 5px; margin-bottom: 0px;">
  <p><b>Notice : </b><?php echo $_SESSION['green-notice']; ?><button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="alert" aria-hidden="true">×</button></p>
</div>
<?php unset($_SESSION['green-notice']); ?>
<?php endif ?>

<?php if (isset($_SESSION['blue-notice'])): ?>
<div class="alert alert-info alert-dismissible" style="padding: 5px; margin-bottom: 0px;">
  <p><b>Notice : </b><?php echo $_SESSION['blue-notice']; ?><button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="alert" aria-hidden="true">×</button></p>
</div>
<?php unset($_SESSION['blue-notice']); ?>
<?php endif ?>