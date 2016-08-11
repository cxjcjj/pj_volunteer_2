<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/datepicker/datepicker3.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/iCheck/all.css">

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
    <?php echo $title;?>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
</ol>
</section>

    <!-- Main content -->
<section class="content" id="content">


<div class="box">
    <div class="box-header with-border">
        <?php if(isset($message)):?>
        <div class="callout callout-danger">
            <p><?=$message?></p>
        </div>
        <?php endif?>
    </div>
    <form>
    <div class="box-body">
        <input type="hidden" name="model" value="add"/>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="useraccount">用户名</label>
            <div class="col-sm-5">
                <input id="useraccount" name="useraccount" class="form-control" type="text" value="" placeholder="用户名"/>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="username">姓名</label>
            <div class="col-sm-5">
                <input id="username" name="username" class="form-control" type="text" value="<?=$user->username?>" placeholder="姓名"/>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="password">密码</label>
            <div class="col-sm-5">
                <input id="password" name="password" class="form-control" type="text" value="" placeholder="密码"/>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="email">邮箱</label>
            <div class="col-sm-5">
                <input id="email" name="email" class="form-control" type="text" value="<?=$user->email?>" placeholder="邮箱"/>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="phone">电话</label>
            <div class="col-sm-5">
                <input id="phone" name="phone" class="form-control" type="text" value="<?=$user->phone?>" placeholder="电话"/>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a onclick="gotoUrl('<?php echo site_url('user/index')?>')" href="#"><i class="fa fa-reply">&nbsp;返回</i></a>
        <button class="btn btn-info pull-right" type="button" onclick="save('<?php echo site_url('user/store')?>')"><i class="fa fa-save">&nbsp;保存</i></button>
    </div>
    </form>
</div>

<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript">

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
</script>

</section>
    <!-- /.content -->
