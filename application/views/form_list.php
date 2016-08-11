<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/datatables/dataTables.bootstrap.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url() ?>AdminLTE2/plugins/select2/select2.min.css">

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


<div class="box box-default">
    <div class="box-header with-border">
        条件搜索(按住ctrl键可以多选)
        <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
    </div>
    <form method="post" name="form1" id="form1">
    <div class="box-body">
        <div class="row">
            <div class="form-group col-sm-4">
                <label class="control-label">年级选择</label>
                <select class="form-control select2" multiple="multiple" name="entrance[]" data-placeholder="选择年级">
                    <option value="1" <?php if(isset($input['entrance']) && in_array(1, $input['entrance'])) echo 'selected';?>>一年级</option>
                    <option value="2" <?php if(isset($input['entrance']) && in_array(2, $input['entrance'])) echo 'selected';?>>二年级</option>
                    <option value="3" <?php if(isset($input['entrance']) && in_array(3, $input['entrance'])) echo 'selected';?>>三年级</option>
                    <option value="4" <?php if(isset($input['entrance']) && in_array(4, $input['entrance'])) echo 'selected';?>>四年级</option>
                    <option value="5" <?php if(isset($input['entrance']) && in_array(5, $input['entrance'])) echo 'selected';?>>五年级</option>
                    <option value="6" <?php if(isset($input['entrance']) && in_array(6, $input['entrance'])) echo 'selected';?>>六年级</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="control-label">家长与学生关系</label>
                <select class="form-control select2" name="relationship" data-placeholder="选择关系">
                    <option></option>
                    <option value="2" <?php if(isset($input['relationship']) && $input['relationship'] == 2) echo 'selected';?>>父亲</option>
                    <option value="3" <?php if(isset($input['relationship']) && $input['relationship'] == 3) echo 'selected';?>>母亲</option>
                    <option value="4" <?php if(isset($input['relationship']) && $input['relationship'] == 4) echo 'selected';?>>其他</option>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="control-label">专业或特长</label>
                <select class="form-control select2" multiple="multiple" name="ability[]" data-placeholder="家长专业或特长">
                    <?php $ability_set = ['literary' => '文学', 'science' => '科技', 'paint' => '书画', 'dance' => '舞蹈', 'music' => '乐器',
                    'language' => '外语', 'handwork' => '手工', 'sport' => '体育', 'photograph' => '摄影', 'cook' => '厨艺'];
                    foreach ($ability_set as $key => $value):?>
                        <option value="ability_<?=$key?>" <?php if(isset($input['ability']) && in_array("ability_$key", $input['ability'])) echo 'selected';?>><?=$value?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-4">
                <label class="control-label">教育服务</label>
                <select class="form-control select2" multiple="multiple" name="service[]" data-placeholder="教育服务内容">
                    <?php $service_set = ['security' => '安全执勤', 'tour' => '带队参观', 'photograph' => '摄影宣传', 'library' => '图书馆工作',
                    'culture' => '校园文化设计', 'communication' => '家长沟通工作', 'activity' => '活动策划', 'maintenance' => '维修服务', 'network' => '班网管理'];
                    foreach ($service_set as $key => $value):?>
                        <option value="service_<?=$key?>" <?php if(isset($input['service']) && in_array("service_$key", $input['service'])) echo 'selected';?>><?=$value?></option>
                    <?php endforeach?>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="control-label">学生导师</label>
                <select class="form-control select2" multiple="multiple" name="tutor[]" data-placeholder="辅导内容">
                    <?php $tutor_set = ['sinology' => '国学教育', 'art' => '艺术教育', 'science' => '科技教育', 'environment' => '环保教育',
                    'security' => '安全教育', 'handmade' => '手工制作', 'psychology' => '心理辅导', 'revolution' => '革命传统教育', 'bodybuilding' => '健身辅导'];
                    foreach ($tutor_set as $key => $value):?>
                        <option value="tutor_<?=$key?>" <?php if(isset($input['tutor']) && in_array("tutor_$key", $input['tutor'])) echo 'selected';?>><?=$value?></option>
                    <?php endforeach?>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="control-label">家长学堂</label>
                <select class="form-control select2" multiple="multiple" name="lecture[]" data-placeholder="讲座内容">
                    <?php $lecture_set = ['education' => '家庭教育', 'law' => '法律知识', 'diet' => '健康饮食'];
                    foreach ($lecture_set as $key => $value):?>
                        <option value="lecture_<?=$key?>" <?php if(isset($input['lecture']) && in_array("lecture_$key", $input['lecture'])) echo 'selected';?>><?=$value?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-4">
                <label class="control-label">志愿时间（星期）</label>
                <select class="form-control select2" multiple="multiple" name="week[]" data-placeholder="选择星期">
                    <?php $week = [1 => '星期一', 2 => '星期二', 3 => '星期三', 4 => '星期四', 5 => '星期五', 6 => '星期六', 7 => '星期天'];
                    for ($i = 1; $i <= 7; $i++):?>
                        <option value="<?=$i?>" <?php if(isset($input['week']) && in_array($i, $input['week'])) echo 'selected';?>><?=$week[$i]?></option>
                    <?php endfor?>
                </select>
            </div>
            <div class="form-group col-sm-4">
                <label class="control-label">志愿时间（时间段)</label>
                <select class="form-control select2" multiple="multiple" name="timerange[]" data-placeholder="选择时间段">
                    <option value="1" <?php if(isset($input['timerange']) && in_array(1, $input['timerange'])) echo 'selected';?>>上午</option>
                    <option value="2" <?php if(isset($input['timerange']) && in_array(2, $input['timerange'])) echo 'selected';?>>中午</option>
                    <option value="3" <?php if(isset($input['timerange']) && in_array(3, $input['timerange'])) echo 'selected';?>>下午</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <button class="btn btn-info pull-right" id="search" type="button" ><i class="fa fa-search">&nbsp;搜索</i></button>
            </div>
        </div>
    </div>
    </form>
</div>

<div class="box" id="parent_box">
    <div class="box-header">
        家长填写总览
    </div>
    <div class="box-body">
        <table id="shit" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>学生ID</th>
                    <th>入学年份</th>
                    <th>班级</th>
                    <th>学生姓名</th>
                    <th>家长ID</th>
                    <th>家长姓名</th>
                    <th>与学生关系</th>
                    <th>联系电话</th>
                    <th>志愿者</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($parents as $key => $parent):?>
                <tr>
                    <td><?=$parent->child_id;?></td>
                    <td><?=$parent->entrance;?></td>
                    <td><?=$parent->class;?></td>
                    <td><?=$parent->child_name;?></td>
                    <td><?=$parent->parent_id;?></td>
                    <td><?=$parent->parent_name;?></td>
                    <td><?=$parent->relation;?></td>
                    <td><?=$parent->phone;?></td>
                    <td><?php if($parent->is_volunteer) echo '是'; else echo '否';?></td>
                    <td>
                        <a onclick="gotoUrl('<?php echo site_url("form/detail/$parent->parent_id")?>')" href="#"><i class="fa fa-search">查看</i></a>
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
<!-- Select2 -->
<script src="<?php echo base_url();?>AdminLTE2/plugins/select2/select2.full.min.js"></script>
<script>
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

function delete_student(id) {
    if (confirm("确定删除改学生信息吗？")) {
        var url = "<?php echo base_url('school/delete');?>" ;
        $.post(url+ '/' + id)
            .fail(function(data) {
                console.log('fail');
            }).done(function(data) {
                console.log('success');
                location.href = "<?php echo base_url('student/index');?>";
            });
    }
}


$(".select2").select2();
</script>

</section>
    <!-- /.content -->
