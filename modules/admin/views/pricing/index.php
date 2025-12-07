<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pricing Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pricing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ticket', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'product_code',
            'name',
            [
                'attribute' => 'price',
                'label' => 'Adult Price',
                'value' => function($model) {
                    return '₹' . $model->price;
                }
            ],
            [
                'attribute' => 'price_child',
                'label' => 'Child Price',
                 'value' => function($model) {
                    return '₹' . $model->price_child;
                }
            ],
            [
                'attribute' => 'original_price',
                'label' => 'MRP',
                'value' => function($model) {
                    return $model->original_price ? '₹' . $model->original_price : '-';
                }
            ],
            [
                'attribute' => 'discount_label',
                'value' => function($model) {
                    if ($model->discount_label) return $model->discount_label;
                    if ($model->original_price > $model->price) {
                        return round((($model->original_price - $model->price) / $model->original_price) * 100) . '% OFF (Auto)';
                    }
                    return '-';
                }
            ],
            'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                         return \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                            'class' => '',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>

</div>
