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
        <input type="hidden" name="useraccount" value="<?=$account?>"/>
        <div class="form-group col-md-12">
            <label class="col-sm-2 control-label" for="password">密码</label>
            <div class="col-sm-5">
                <input id="password" name="password" class="form-control" type="text" value="" placeholder="密码"/>
            </div>
        </div>

        <div class="form-group col-md-12">
        <label class="col-sm-2 control-label" for="passconf">确认密码</label>
            <div class="col-sm-5">
                <input id="passconf" name="passconf" class="form-control" type="text" value="" placeholder="确认密码"/>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a onclick="gotoUrl('<?php echo site_url('user/index')?>')" href="#"><i class="fa fa-reply">&nbsp;返回</i></a>
        <button class="btn btn-info pull-right" type="button" onclick="save('<?php echo site_url('user/store_pw')?>')"><i class="fa fa-save">&nbsp;保存</i></button>
    </div>
    </form>
</div>

</section>
    <!-- /.content -->
