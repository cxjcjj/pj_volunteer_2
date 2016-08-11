<div class="box box-primary box-solid">
    <div class="box-header">
        <h3 class="box-title">可以提供的志愿者服务内容</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
    	<table id="shit_" class="table table-bordered table-striped">
        <tbody>
    		<tr>
				<td>教育服务</td>
				<td>服务内容</td>
				<td colspan="5">
				<?php $service_set = ['security' => '安全执勤', 'tour' => '带队参观', 'photograph' => '摄影宣传', 'library' => '图书馆工作','culture' => '校园文化设计', 'communication' => '家长沟通工作', 'activity' => '活动策划', 'maintenance' => '维修服务', 'network' => '班网管理'];
				foreach ($service_set as $key => $value):?>
					<span class="label label-success"><?php $param_name = 'service_' . $key; if($parent->{$param_name}) echo $value;?></span>
				<?php endforeach;?>
				<span class="label label-success"><?php if($parent->service_others) echo $parent->service_others;?></span>
				</td>
			</tr>
			<tr>
				<td>学生导师</td>
				<td>辅导内容</td>
				<td colspan="5">
				<?php $tutor_set = ['sinology' => '国学教育', 'art' => '艺术教育', 'science' => '科技教育', 'environment' => '环保教育','security' => '安全教育', 'handmade' => '手工制作', 'psychology' => '心理辅导', 'revolution' => '革命传统教育', 'bodybuilding' => '健身辅导'];
				foreach ($tutor_set as $key => $value):?>
					<span class="label label-danger"><?php $param_name = 'tutor_' . $key; if($parent->{$param_name}) echo $value;?></span>
				<?php endforeach;?>
				<span class="label label-danger"><?php if($parent->tutor_others) echo $parent->tutor_others;?></span>
				</td>
			</tr>
			<tr>
				<td>家长学堂</td>
				<td>讲座内容</td>
				<td colspan="5">
				<?php $lecture_set = ['education' => '家庭教育', 'law' => '法律知识', 'diet' => '健康饮食'];
				foreach ($lecture_set as $key => $value):?>
					<span class="label label-warning"><?php $param_name = 'lecture_' . $key; if($parent->{$param_name}) echo $value;?></span>
				<?php endforeach;?>
				<span class="label label-warning"><?php if($parent->lecture_others) echo $parent->lecture_others;?></span>
				</td>
			</tr>
        </tbody>
        </table>
    </div>
</div>

<div class="box box-danger box-solid">
    <div class="box-header">
        <h3 class="box-title">志愿信息</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
    	<table id="shit_" class="table table-bordered table-striped">
        <tbody>
        	<tr>
        		<td>做“志愿者”时间</td>
        		<td colspan="4">
        			<?php $weekday = [1 => '星期一', 2 => '星期二', 3 => '星期三', 4 => '星期四', 5 => '星期五', 6 => '星期六', 7 => '星期天'];
        			$time = [1 => '上午', 2 => '中午', 3 => '下午'];
        			for($i=1; $i<=7; $i++):?>
        				<span class="label label-primary"><?php if($parent->week[$i-1]) echo $weekday[$i] . $time[$parent->timerange[$i-1]];?></span>
        			<?php endfor;?>
        		</td>
        	</tr>
        	<tr>
        		<td>志愿者口号创意</td>
        		<td colspan="4"><?=$parent->slogan;?></td>
        	</tr>
        </tbody>
        </table>
    </div>
</div>





