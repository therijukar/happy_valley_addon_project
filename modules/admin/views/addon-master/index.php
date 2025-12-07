<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AddonMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Addon Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="addon-master-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Addon Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'price',
            'product_id',
            'category',
            //'created_date',
            //'created_by',
            //'modified_date',
            //'modified_by',
            //'is_active',
            //'soft_delete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
