<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('web_logo')); ?>:</b>
	<?php echo CHtml::encode($data->web_logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('web_domain')); ?>:</b>
	<?php echo CHtml::encode($data->web_domain); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('web_name')); ?>:</b>
	<?php echo CHtml::encode($data->web_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('web_describe')); ?>:</b>
	<?php echo CHtml::encode($data->web_describe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('web_status')); ?>:</b>
	<?php echo CHtml::encode($data->web_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('append_date')); ?>:</b>
	<?php echo CHtml::encode($data->append_date); ?>
	<br />


</div>