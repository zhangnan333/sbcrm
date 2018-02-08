<li>
    <div class="web_domain">
        <?php echo substr($data->web_domain, 4); ?>
    </div>
    <div class="code">
        <span><b>Coupon Code:</b> <strong><?php echo CHtml::encode($data->code); ?></strong></span>
        <p><?php echo CHtml::encode($data->code_describe); ?></p>
    </div>
    <div class="clearfix"></div>
</li>