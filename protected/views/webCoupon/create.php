<?php
$this->breadcrumbs = array(
    'Web Coupons' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List WebCoupon', 'url' => array('index')),
    array('label' => 'Manage WebCoupon', 'url' => array('admin')),
);
?>

<h1>Submit Your Coupon</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>