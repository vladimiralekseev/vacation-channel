<?php

use common\models\Video;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var Video        $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
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
                            'confirm' => 'Are you sure you want to delete this text page?',
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
                        'name',
                        [
                            'attribute' => 'status',
                            'value'     => Video::getStatusValue($model->status),
                        ],
                        'code',
                        'youtube_code',
                        'order',
                        [
                            'label'  => 'Category',
                            'value'  => $model->category->name ?? null
                        ],
                        [
                            'label'  => 'Display as the main video',
                            'value'  => $model->main ? 'Yes' : 'No',
                        ],
                        [
                            'label'  => 'Display in the main slider on the main page',
                            'value'  => $model->main_slider ? 'Yes' : 'No',
                        ],
                        [
                            'label'  => 'Display on the main page',
                            'value'  => $model->main_page ? 'Yes' : 'No',
                        ],
                        'link',
                        'description',
                        'created_at',
                        'updated_at',
                    ],
                ]
            ) ?>

        </div>
    </div>
</div>
