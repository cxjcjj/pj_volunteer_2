<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/datepicker/datepicker3.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/iCheck/all.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url();?>AdminLTE2/plugins/select2/select2.min.css">

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
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="child_id">班级学生编号</label>
            <div class="col-sm-5">
                <input id="child_id" name="child_id" class="form-control" type="text" value="<?php echo isset($student->child_id) ? substr($student->child_id, 6, 3) : ''; ?>" placeholder="班级学生编号"/>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="name">学生姓名</label>
            <div class="col-sm-5">
                <input id="name" name="name" class="form-control" type="text" value="<?=$student->name?>" placeholder="学生姓名"/>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="sex">学生性别</label>
            <div class="col-sm-5">
                <div class="raw">
                    <input id="child_sex_0" type="radio" value="0" name="sex" class="flat-blue" <?php echo (!isset($student) || $student->sex == '0') ? 'checked' : '';?>/>&nbsp;男&nbsp;&nbsp;
                    <input id="child_sex_1" type="radio" value="1" name="sex" class="flat-blue" <?php echo $student->sex == '1' ? 'checked' : '';?>/>&nbsp;女
                </div>
            </div>
        </div>
        <div class="form-group col-md-12">
        <label class="col-sm-2 control-label" for="entrance">入学年份</label>
            <div class="col-sm-3">
                <select class="form-control select2" id="entrance" name="entrance">
                    <?php foreach ($school as $key => $value):?>
                        <option value="<?php echo $key;?>" <?php if(isset($student->entrance) && $student->entrance == $key) echo 'selected';?>><?php echo $key;?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group col-md-12">
        <label class="col-sm-2 control-label" for="class">所在班级</label>
            <div class="col-sm-3">
                <select class="form-control select2" id="class" name="class">
                    <option value="1" <?php if (isset($student->class) && $student->class == '1') echo 'selected';?>>1班</option>
                </select>
            </div>
        </div>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="birthday">学生生日</label>
            <div class="col-sm-5">
                <div class="input-group date">
                    <input id="datepicker" name="birthday" class="form-control" type="text" value="<?=$student->birthday?>"/>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a onclick="gotoUrl('<?php echo site_url('student/index');?>')" href="#"><i class="fa fa-reply">&nbsp;返回</i></a>
        <button class="btn btn-info pull-right" type="button" onclick="save('<?php echo site_url('student/store')?>')"><i class="fa fa-save">&nbsp;保存</i></button>
    </div>
    </form>
</div>

<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
set_class();
$(function(){
    $("#entrance").change(function(){
        clean_class();
        set_class();
    });
});

function clean_class(){
    $("#class option").remove();
    var origin = <?php echo $student->class;?>;
    var flag = (origin == 1) ? 'selected' : '';
    $("<option value='1' " + flag + " >1班</option>").appendTo("#class");
}

function set_class(){
    var entrance = $("#entrance option:selected").val();
    var all = <?php print $school_json; ?>;
    var num = parseInt(all[entrance]);
    for (var i = 2; i <= num; i++){
        var origin = <?php echo $student->class;?>;
        var flag = (origin == i) ? 'selected' : '';
        $("<option value='" + i + "' " + flag + " >" + i + "班</option>").appendTo("#class");
    }
}

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
</script>

</section>
    <!-- /.content -->
