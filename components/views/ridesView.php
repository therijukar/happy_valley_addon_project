<ul class="sub-menu text-left mycustom">
    <?php 
        foreach ($models as $model) {
     ?>
    <li class="active">
        <a href="striking_car.html">
            <img src="<?php echo Yii::getAlias('@web') . '/web/assets/' ?>images/ride/<?php echo $model->filename; ?>">
            <h4><?php echo $model->name; ?></h4>
        </a>
    </li>
    <?php 
        }
     ?> 
</ul>