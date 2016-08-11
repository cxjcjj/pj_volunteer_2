<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>苏州市平江实验学校“家长志愿者”填写平台后台管理</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/offline/font-awesome-4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/bootstrap/offline/ionicons-2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
                page. However, you can choose any other skin. Make sure you
                apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/dist/css/skins/skin-blue.min.css">

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.2.0 -->
        <script src="<?php echo base_url();?>AdminLTE2/plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url();?>AdminLTE2/bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url();?>AdminLTE2/dist/js/app.min.js"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
            Both of these plugins are recommended to enhance the
            user experience. Slimscroll is required when using the
            fixed layout. -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
<body class="hold-transition login-page" style="background-color:#ECF0F5">
<div class="box box-info login-box">
  <div class="box-header with-border" align="center">
    <h3 class="box-title">平台管理员登录</h3>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p style="color:red;"><?php echo isset($message)?$message:"";?></p>

    <?php echo form_open('login/check', 'class="form-horizontal" id="login"');?>
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="用户名">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="密码">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row" style="text-align:center;">
        <a href="<?php echo site_url('login/index');?>">
          <button type="button" class="btn btn-info pull-default">
            返回
          </button>
        </a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <button type="submit" class="btn btn-info pull-default">登录</button>
        <!-- /.col -->
      </div>
    <?php echo form_close();?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
