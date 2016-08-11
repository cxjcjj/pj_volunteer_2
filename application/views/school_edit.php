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
			<label class="col-sm-2 control-label" for="entrance">入学年份</label>
			<div class="col-sm-5">
				<input id="entrance" type="text" name="entrance" class="form-control" placeholder="入学年份" value="<?=$school->entrance?>" />
			</div>
		</div>
		<div class="form-group col-md-12">
			<label class="col-sm-2 control-label" for="class_num">班级数</label>
			<div class="col-sm-5">
				<input id="class_num" type="text" name="class_num" class="form-control" placeholder="班级数" value="<?=$school->class_num?>" />
			</div>
		</div>
	</div>
	<div class="box-footer">
		<a onclick="gotoUrl('<?php echo site_url('school/index');?>')" href="#"><i class="fa fa-reply">&nbsp;返回</i></a>
		<button class="btn btn-info pull-right" type="button" onclick="save('<?php echo site_url('school/store')?>')"><i class="fa fa-save">&nbsp;保存</i></button>
	</div>
	</form>
</div>

</section>
    <!-- /.content -->
