<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>家长志愿者后台</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/select2/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/iCheck/all.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- jQuery 2.2.0 -->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url();?>AdminLTE2/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>AdminLTE2/dist/js/app.min.js"></script>
    <script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/select2/select2.full.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?php echo base_url();?>AdminLTE2/plugins/iCheck/icheck.min.js"></script>

    <script>

      function clean_class(){
          $("#class option").remove();
          $("<option value='" + 1 + "'>" + 1 + "班</option>").appendTo("#class");
      }
      function set_class(){
          var entrance = $("#entrance option:selected").val();
          var all = <?php print $school_json; ?>;
          var num = parseInt(all[entrance]);
          for (var i = 2; i <= num; i++){

              if("<?php echo isset($origin)?>" && "<?php echo $origin['class']?>" == i){
              $("<option selected='selected' value='" + i + "'>" + i + "班</option>").appendTo("#class");
              continue;
              }
              $("<option value='" + i + "'>" + i + "班</option>").appendTo("#class");
          }
      }
      
      function table_info(url, elements = document.getElementById("AJAX"))
      {
        if (window.XMLHttpRequest)
        {
        xmlhttp=new XMLHttpRequest();
        }
        else
        {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            elements.innerHTML=xmlhttp.responseText;
            $('#shit').DataTable({
                        "padding": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "select": true,
                        "order": [[1,"desc"]]
                    });

            $(".select2").select2();
            $('#search').click(function(){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/form/search",
                data: $("form").serialize(),
                 // dataType: "json",
                success: function(data){
                        document.getElementById('parent_box').innerHTML = data;
                        $('#shit').DataTable({
                        "padding": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "select": true,
                        "order": [[1,"desc"]]
                    });
                      }
                 });
            });

            $(function(){
                $("#entrance").change(function(){
                    clean_class();
                    set_class();
                });
            });

            }
        }
        xmlhttp.open("GET",url,true);
        xmlhttp.send();
      }

      function delete_info(url, elements = document.getElementById("AJAX"))
      {

        if(!confirm("确定要删除这条数据吗？"))
        {
          return false;
        }

        if (window.XMLHttpRequest)
        {
        xmlhttp=new XMLHttpRequest();
        }
        else
        {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            elements.innerHTML=xmlhttp.responseText;
            $('#shit').DataTable({
                        "padding": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "select": true,
                        "order": [[1,"desc"]]
                    });

            $(".select2").select2();
            $('button').click(function(){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>index.php/form/search",
                data: $("form").serialize(),
                 // dataType: "json",
                success: function(data){
                        document.getElementById('parent_box').innerHTML = data;
                        $('#shit').DataTable({
                        "padding": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "select": true,
                        "order": [[1,"desc"]]
                    });
                      }
                 });
            });

            $(function(){
                $("#entrance").change(function(){
                    clean_class();
                    set_class();
                });
            });

            }
        }
        xmlhttp.open("GET",url,true);
        xmlhttp.send();
        return true;
      }

      
      function gotoUrl(url)
      {
        if (window.XMLHttpRequest)
        {
        xmlhttp=new XMLHttpRequest();
        }
        else
        {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
              document.getElementById("AJAX").innerHTML=xmlhttp.responseText;
              $('#shit').DataTable({
                          "padding": true,
                          "lengthChange": true,
                          "searching": true,
                          "ordering": true,
                          "info": true,
                          "autoWidth": false,
                          "select": true,
                          "order": [[1,"desc"]]
                      });

              $(".select2").select2();
              //Flat red color scheme for iCheck
              $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                  checkboxClass: 'icheckbox_flat-blue',
                  radioClass: 'iradio_flat-blue'
              });

              $('#datepicker').datepicker({
                  language:"zh-CN",
                  format:"yyyy-mm-dd",
                  showInputs: false,
                  endDate: "+0d",
              });
            }
        }
        xmlhttp.open("GET",url,true);
        xmlhttp.send();
      }

      function save(url)
      {
        $.ajax({
          type: 'post',
          url: url,
          data: $("form").serialize(),
          error: function(){alert('error');},
          success: function(data){
            document.getElementById("AJAX").innerHTML=data;
          }
        });
      }

    </script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">志愿</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">家长志愿者</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- /.messages-menu -->

          <!-- Notifications Menu -->
            <!-- Menu Toggle Button -->
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $this->session->username?></span>
            </a>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="<?php echo site_url('login/logout');?>"><i class="fa fa-power-off"></i>&nbsp;退出</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->

      <!-- search form (Optional) -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">菜单</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="#" onclick='table_info("<?php echo base_url();?>index.php/form/index")'><i class="fa fa-link"></i><span>表格填写情况</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span >基本信息设置</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li  onclick='table_info("<?php echo base_url();?>index.php/school/index")'><a href="#">班级信息</a></li>
            <li  onclick='table_info("<?php echo base_url();?>index.php/student/index")'><a href="#">学生管理</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>平台管理</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li  onclick='table_info("<?php echo base_url();?>index.php/user/index")'><a href="#">用户管理</a></li>
           <!-- <li><a href="#">日志</a></li>
            <li><a href="#">基本设置</a></li>-->
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="AJAX">

  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
    </div>
    <!-- Default to the left -->
  </footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
    
</body>
</html>
