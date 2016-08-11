<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">

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
        <div class="row">
            <div class="col-sm-11">
                <?php if(isset($message)):?>
                <div class="callout callout-info">
                    <p><?=$message?></p>
                </div>
                <?php endif?>
            </div>
            <div class="col-sm-1">
                <a class="btn btn-info pull-right" type="button" onclick="gotoUrl('<?php echo site_url('school/add')?>')" href="#"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="box-body">
        <table id="shit" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>入学年份</th>
                    <th>年级</th>
                    <th>班级数</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($school as $key => $school):?>
                <tr>
                    <td><?=$school->entrance?></td>
                    <td><?=$school->grade?></td>
                    <td><?=$school->class_num?></td>
                    <td>
                        <a onclick="gotoUrl('<?php echo site_url("school/edit/$school->id") ?>')" href="#"><i class="fa fa-edit">修改</i></a>&nbsp;
                        <a onclick="delete_info('<?php echo site_url("school/delete/$school->id") ?>')" href="#"><i class="fa fa-remove">删除</i></a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>AdminLTE2/plugins/datatables/dataTables.bootstrap.min.js"></script>

</section>
    <!-- /.content -->
