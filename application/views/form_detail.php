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


<div class="box box-warning box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">基本信息</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <table id="shit_" class="table table-bordered table-striped">
        <tbody>
            <tr>
                <td>学生姓名</td>
                <td><?=$parent->child_name;?></td>
                <td>性别</td>
                <td><?php if($parent->child_sex) echo '女';else echo '男';?></td>
                <td>入学年份</td>
                <td><?=$parent->entrance;?></td>
                <td>所在班级</td>
                <td><?=$parent->class;?></td>
            </tr>
            <tr>
                <td>家长姓名</td>
                <td><?=$parent->parent_name;?></td>
                <td>性别</td>
                <td><?php if($parent->parent_sex) echo '女';else echo '男';?></td>
                <td>与学生关系</td>
                <td><?=$parent->relation;?></td>
                <td>联系电话</td>
                <td><?=$parent->phone;?></td>
            </tr>
            <tr>
                <td>工作单位</td>
                <td colspan="7"><?=$parent->workspace;?></td>
            </tr>
        </tbody>
        </table>
    </div>
</div>


<div class="box box-success box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">其他信息</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
        <table id="shit_" class="table table-bordered table-striped">
        <tbody>
            <tr>
                <td colspan="2">是否愿意参加家长志愿者活动？</td>
                <td><?php if($parent->is_volunteer) echo '是';else echo '否';?></td>
            </tr>
            <tr>
                <td colspan="2">是否愿意参加家长志愿者协会的组织工作？</td>
                <td><?php if($parent->is_organ) echo '是';else echo '否';?></td>
            </tr>
            <tr>
                <td>专业或特长</td>
                <td>
                    <?php $ability_set = ['literary' => '文学', 'science' => '科技', 'paint' => '书画', 'dance' => '舞蹈', 'music' => '乐器','language' => '外语', 'handwork' => '手工', 'sport' => '体育', 'photograph' => '摄影', 'cook' => '厨艺'];
                    foreach ($ability_set as $key => $value):?>
                        <span class="label label-info"><?php $param_name = 'ability_' . $key; if($parent->{$param_name}) echo $value;?></span>
                    <?php endforeach;?>
                    <span class="label label-info"><?php if($parent->ability_others) echo $parent->ability_others;?></span>
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</div>

<?php if($parent->is_volunteer || $parent->is_organ) echo $this->load->view('ability')?>
<div class="row">
    <div class="col-sm-6">
        <div class="box box-info box-solid">
            <div class="box-header">
                <h3 class="box-title">您希望家长志愿者开展哪些活动？</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?=$parent->suggest1?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="box box-info box-solid">
            <div class="box-header">
                <h3 class="box-title">您对于我校共建活动有何建议与意见？</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?=$parent->suggest2?>
            </div>
        </div>
    </div>
</div>

</section>
    <!-- /.content -->

