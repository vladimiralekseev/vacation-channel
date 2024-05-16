<?php

use common\models\BransonSchedule;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View       $this
 * @var BransonSchedule    $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Schedule', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="text-page-view">

    <div class="panel panel-default">
        <div class="panel-body">

            <p>
                <?= Html::a(
                    'Edit',
                    ['update', 'id' => $model->id],
                    ['class' => 'btn btn-sm btn-primary']
                ) ?>
                <?= Html::a(
                    'Create',
                    ['create'],
                    ['class' => 'btn btn-sm btn-success']
                ) ?>

                <?= Html::a(
                    'Delete',
                    ['delete', 'id' => $model->id],
                    [
                        'class' => 'btn btn-sm btn-danger pull-right',
                        'data'  => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method'  => 'post',
                        ],
                    ]
                ) ?>
            </p>

            <?= DetailView::widget(
                [
                    'model'      => $model,
                    'attributes' => [
                        'id',
                        'title',
                        'external_id',
                        [
                            'attribute' => 'type',
                            'value'     => BransonSchedule::getTypeValue($model->type),
                        ],
                        'order',
                        'expiry_date',
                        'url',
                        'created_at',
                        'updated_at',
                    ],
                ]
            ) ?>

        </div>
    </div>
</div>

