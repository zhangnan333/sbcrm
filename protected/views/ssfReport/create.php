<?php
$kf_type = $business->id > 1 ? '企业客户' : '个人客户';
$this->breadcrumbs = array(
    $kf_type => array('business/admin'),
    $business->business_name,
    '报表',
);
?><div class="box corners shadow">
    <div class="box-header">
        <h2><?php echo $ssf_date; ?>月份 <?php echo $business->business_name; ?></h2>
        <div class="box-header-ctrls">	
            <a href="javascript:void(null);" title="" class="close"><!-- --></a>
        </div>
    </div>
    <div class="box-content">
        <div class="inbox-sf">
            <form id="ssf-search" method="GET" class="search-form" >
                <select id="year">
                    <option>年</option>
                    <option>2015</option>
                    <option>2016</option>
                    <option>2017</option>
                    <option>2018</option>
                    <option>2019</option>
                    <option>2020</option>
                </select>
                <select id="mouth">
                    <option value="">月</option>
                    <?php
                    for ($i = 1; $i < 13; $i++) {
                        printf("<option value='%02d'>%d</option>", $i, $i);
                    }
                    ?>
                </select>
                <input type="hidden" value="<?php echo $b_id;?>" name="b_id" />
                <input type="hidden" value="" name="ssf_date" id="ssf_date" />
                <input type="button" onclick="subSearch()" value="查询" class="inbox-sf-search-btn" />
            </form>
            <a class="button black fr" href="<?php echo $this->rewriteCreateUrl('customer/admin', array('b_id' => $b_id)) ?>">
                <span>员工管理</span>
            </a>
        </div>
        
        <?php echo $this->renderPartial('_list', array('model' => $model, 'b_id' => $b_id, 'ssf_date' => $ssf_date, 'business' => $business)); ?> 
    </div>
</div>
<div class="clear"></div>
<script>
    function subSearch(){
        if($("#year").val()=='' || $("#mouth").val()==''){
            alert('请设置时间');
            return false;
        }
        $("#ssf_date").val($("#year").val() + '-' + $("#mouth").val());
        $("#ssf-search").submit();
    }
</script>