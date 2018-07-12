<?php session_start(); ?>
<?php include "config.php"; ?>
<?php include "head.php"; ?>
<?php include "notice.php"; ?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Certi</b>Tect</a>
  </div>

  <div class="login-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="action/post_register.php" method="post">
      <div class="form-group has-feedback">
        <input name="full_name" type="text" class="form-control" placeholder="Full name" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password_confirmation" type="password" class="form-control" placeholder="Retype password" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <div class="checkbox">
          <label>
            <input type="checkbox" required> I agree with the terms and conditions
          </label>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="register">Register</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body>