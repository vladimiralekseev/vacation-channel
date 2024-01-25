<?php

use backend\models\search\MetaDataSearch;
use webvimark\extensions\GridPageSize\GridPageSize;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * @var MetaDataSearch  $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Meta Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attractions-index">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <p>
                        <?= Html::a(
                            '<span class="glyphicon glyphicon-plus-sign"></span> Create',
                            ['create'],
                            ['class' => 'btn btn-success']
                        ) ?>
                    </p>
                </div>

                <div class="col-sm-6 text-right">
                    <?= GridPageSize::widget(['pjaxId' => 'text-page-grid-pjax']) ?>
                </div>
            </div>
            <?php Pjax::begin(
                [
                    'id' => 'attractions-grid-pjax',
                ]
            ) ?>
            <?= GridView::widget(
                [
                    'id' => 'attractions-grid',
                    'dataProvider' => $dataProvider,
                    'layout' => '{items}<div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">{summary}</div></div>',
                    'filterModel' => $searchModel,
                    'pager' => [
                        'options' => ['class' => 'pagination pagination-sm'],
                        'hideOnSinglePage' => true,
                        'lastPageLabel' => '>>',
                        'firstPageLabel' => '<<',
                    ],
                    'columns' => [
                        [
                            'class' => SerialColumn::class,
                            'options' => ['style' => 'width:10px'],
                        ],
                        [
                            'attribute' => 'id',
                            'value' => static function ($model) {
                                return Html::a($model->id, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                            },
                            'format' => 'raw',
                        ],
                        [
                            'label' => 'Url or Youtube code',
                            'attribute' => 'url',
                        ],
                        [
                            'label' => 'Tag type',
                            'attribute' => 'type',
                        ],
                        'title',
                        [
                            'label' => 'Tag attributes',
                            'attribute' => 'data',
                            'value' => static function ($model) {
                                return $model->getDataAttributes();
                            },
                            'format' => 'raw',
                        ],
                        [
                            'class' => ActionColumn::class,
                            'contentOptions' => ['style' => 'white-space:nowrap;text-align:center;'],
                            'template' => '{view} {update} {delete}',
                        ],
                    ],
                ]
            ) ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>
