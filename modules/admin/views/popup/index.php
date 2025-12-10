<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Website Popups';
?>

<div class="page-title">
    <?= Html::encode($this->title) ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight" style="padding: 0;">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Manage Popups</h5>
                    <div class="ibox-tools">
                        <?= Html::a('<i class="fa fa-plus"></i> Add New Popup', ['create'], ['class' => 'btn btn-primary btn-sm']) ?>
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
                                    'attribute' => 'image_url',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::img(Yii::getAlias('@web/') . $model->image_url, ['width' => '100px']);
                                    },
                                ],
                                [
                                    'attribute' => 'status',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if ($model->status == 1) {
                                            return Html::a('<span class="badge badge-primary">Active</span>', ['toggle-status', 'id' => $model->id]);
                                        } else {
                                            return Html::a('<span class="badge badge-secondary">Inactive</span>', ['toggle-status', 'id' => $model->id]);
                                        }
                                    },
                                ],
                                'created_at',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{delete}',
                                    'buttons' => [
                                        'delete' => function ($url, $model, $key) {
                                            return Html::a('<i class="fa fa-trash"></i>', $url, [
                                                'title' => Yii::t('yii', 'Delete'),
                                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                                'data-method' => 'post',
                                                'class' => 'btn btn-white btn-sm',
                                                'style' => 'color: var(--danger);'
                                            ]);
                                        },
                                    ],
                                ],
                            ],
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
