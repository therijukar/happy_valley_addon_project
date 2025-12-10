<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pricing Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-title">
    <?= Html::encode($this->title) ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight" style="padding: 0;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>All Tickets</h5>
                    <div class="ibox-tools">
                        <?= Html::a('<i class="fa fa-plus"></i> Create Ticket', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'tableOptions' => ['class' => 'table dataTable'],
                            'summary' => '',
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'product_code',
                                    'label' => 'CODE',
                                    'contentOptions' => ['style' => 'font-weight: 600;'],
                                ],
                                [
                                    'attribute' => 'name',
                                    'label' => 'TICKET NAME',
                                    'contentOptions' => ['style' => 'font-weight: 600; color: var(--primary);'],
                                ],
                                [
                                    'attribute' => 'original_price',
                                    'label' => 'MRP',
                                    'value' => function($model) {
                                        return $model->original_price ? '₹' . $model->original_price : '-';
                                    },
                                    'contentOptions' => ['style' => 'text-decoration: line-through; color: var(--text-muted);'],
                                ],
                                [
                                    'attribute' => 'price',
                                    'label' => 'ADULT PRICE',
                                    'value' => function($model) {
                                        return '₹' . $model->price;
                                    },
                                    'contentOptions' => ['style' => 'font-weight: 700; color: var(--success);'],
                                ],
                                [
                                    'attribute' => 'price_child',
                                    'label' => 'CHILD PRICE',
                                     'value' => function($model) {
                                        return '₹' . $model->price_child;
                                    }
                                ],
                                [
                                    'attribute' => 'discount_label',
                                    'label' => 'DISCOUNT',
                                    'format' => 'raw',
                                    'value' => function($model) {
                                        $label = '-';
                                        if ($model->discount_label) {
                                            $label = $model->discount_label;
                                        } elseif ($model->original_price > $model->price) {
                                            $label = round((($model->original_price - $model->price) / $model->original_price) * 100) . '% OFF';
                                        }
                                        
                                        if($label != '-') {
                                            return '<span class="badge badge-warning">' . $label . '</span>';
                                        }
                                        return $label;
                                    }
                                ],
                                [
                                    'attribute' => 'updated_at',
                                    'label' => 'LAST UPDATED',
                                    'format' => ['date', 'php:d M Y']
                                ],
                    
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'ACTIONS',
                                    'template' => '{update} {delete}',
                                    'buttons' => [
                                        'update' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                                'class' => 'btn btn-white btn-sm',
                                                'title' => 'Edit',
                                                'style' => 'margin-right: 5px; color: var(--text-main);'
                                            ]);
                                        },
                                        'delete' => function ($url, $model) {
                                            return Html::a('<i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
                                                'class' => 'btn btn-white btn-sm',
                                                'title' => 'Delete',
                                                'style' => 'color: var(--danger);',
                                                'data' => [
                                                    'confirm' => 'Are you sure you want to delete this ticket?',
                                                    'method' => 'post',
                                                ],
                                            ]);
                                        }
                                    ]
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
