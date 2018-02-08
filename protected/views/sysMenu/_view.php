<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('m_name')); ?>:</b>
	<?php echo CHtml::encode($data->m_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('m_parent')); ?>:</b>
	<?php echo CHtml::encode($data->m_parent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('m_path')); ?>:</b>
	<?php echo CHtml::encode($data->m_path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('m_role')); ?>:</b>
	<?php echo CHtml::encode($data->m_role); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('m_order')); ?>:</b>
	<?php echo CHtml::encode($data->m_order); ?>
	<br />


</div>