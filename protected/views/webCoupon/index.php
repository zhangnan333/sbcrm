<?php
if (isset($_GET['domain'])) {
    $this->breadcrumbs = array(
        'Web Coupons'=>array('webCoupon/index'),
        $_GET['domain']
    );
    $this->pageTitle = $_GET['domain'].' Coupon codes, Coupons - ' . Yii::app()->name;
} else {
    $this->breadcrumbs = array(
        'Web Coupons',
    );
    $this->pageTitle = 'Coupon Codes, Coupons - ' . Yii::app()->name;
}

$this->menu = array(
    array('label' => 'Create WebCoupon', 'url' => array('create')),
    array('label' => 'Manage WebCoupon', 'url' => array('admin')),
);

?>

<h1><?php echo isset($_GET['domain']) ? $_GET['domain'].' Coupon Codes' : 'Web Coupons';?></h1>
<?php 
if(isset($_GET['domain'])):
?>
<blockquote>
<p><?php echo !empty($siteModel) ? $siteModel->web_describe : "";?></p>
<small><?php echo $_GET['domain'];?> <cite title="raviews">raviews(0)</cite> </small>
</blockquote>
<?php 
endif;
?>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'ajaxUpdate' => FALSE,
    'itemView' => '_view',
    'itemsTagName' => 'ul',
    
    'itemsCssClass' => 'coupons',
    'pagerCssClass' => 'pagination',
    'pager' => array(
        'htmlOptions' => array('class' => ''),
        'header' => '',
    )
));
?>
