<?php
$this->breadcrumbs=array(
	'Web Coupons'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List WebCoupon', 'url'=>array('index')),
	array('label'=>'Create WebCoupon', 'url'=>array('create')),
	array('label'=>'Update WebCoupon', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete WebCoupon', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage WebCoupon', 'url'=>array('admin')),
);
?>

<h1>View WebCoupon #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'web_domain',
		'code',
		'code_describe',
		'expiration_date',
		'sort',
		'good',
		'bad',
		'status',
	),
)); ?>
