<?php
$this->breadcrumbs=array(
	'Web Coupons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List WebCoupon', 'url'=>array('index')),
	array('label'=>'Create WebCoupon', 'url'=>array('create')),
	array('label'=>'View WebCoupon', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage WebCoupon', 'url'=>array('admin')),
);
?>

<h1>Update WebCoupon <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>