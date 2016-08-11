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
                <a class="btn btn-info pull-right" type="button" href="#" onclick="gotoUrl('<?php echo site_url('user/add')?>')"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="box-body">
        <table id="shit" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>用户名</th>
                    <th>姓名</th>
                    <th>电子邮箱</th>
                    <th>电话</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $key => $user):?>
                <tr>
                    <td><?=$user->useraccount;?></td>
                    <td><?=$user->username;?></td>
                    <td><?=$user->email;?></td>
                    <td><?=$user->phone;?></td>
                    <td>
                        <a onclick="gotoUrl('<?php echo site_url('user/edit/' . $user->useraccount)?>')" href="#"><i class="fa fa-edit">修改</i></a>&nbsp;
                        <a onclick="gotoUrl('<?php echo site_url('user/changepw/' . $user->useraccount);?>')" href="#"><i class="fa fa-edit">更改密码</i></a>&nbsp;
                        <?php if($this->session->username != $user->username):?>
                            <a onclick="delete_info('<?php echo site_url('user/delete/' . $user->useraccount) ?>')" href="#"><i class="fa fa-remove">删除</i></a>
                        <?php endif;?>
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
<script type="text/javascript">
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

function delete_user(id) {
    if (confirm("确定删除该登录人员信息吗？")) {
        var url = "<?php echo base_url('user/delete');?>";
        $.post(url+ '/' + id)
            .fail(function(data) {
                alert('删除失败');
            }).done(function(data) {
                alert('删除成功');
                location.href = "<?php echo base_url('user/index');?>";
            });
    }
}
</script>

</section>
    <!-- /.content -->
