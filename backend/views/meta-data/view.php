<?php

use backend\models\forms\MetaDataForm;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var MetaDataForm $model
 */

$this->title = MetaDataForm::getTypeValue($model->type);
$this->params['breadcrumbs'][] = ['label' => 'Meta Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attractions-view">
    <div class="panel panel-default">
        <div class="panel-body">
            <p>
                <?= Html::a(
                    'Edit',
                    ['update', 'id' => $model->id],
                    ['class' => 'btn btn-sm btn-primary']
                ) ?>
            </p>
            <?= DetailView::widget(
                [
                    'model'      => $model,
                    'attributes' => [
                        'id',
                        [
                            'label' => 'Url or Youtube code',
                            'attribute' => 'url',
                        ],
                        [
                            'label' => 'Tag type',
                            'attribute' => 'type',
                            'value'     => MetaDataForm::getTypeValue($model->type)
                        ],
                        'title',
                        [
                            'label' => 'Tag attributes',
                            'value' => $model->getDataAttributes()
                        ],
                        'created_at',
                        'updated_at',
                    ],
                ]
            ) ?>
        </div>
    </div>
</div>
