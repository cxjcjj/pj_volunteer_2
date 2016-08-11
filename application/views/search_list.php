
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
