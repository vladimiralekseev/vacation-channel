<?php

use backend\models\search\BransonScheduleSearch;
use common\models\BransonSchedule;
use webvimark\extensions\GridPageSize\GridPageSize;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View                  $this
 * @var ActiveDataProvider    $dataProvider
 * @var BransonScheduleSearch $searchModel
 */

$this->title = 'Schedule';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="text-page-index">

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
                    'id' => 'text-page-grid-pjax',
                ]
            ) ?>

            <?= GridView::widget(
                [
                    'id'           => 'text-page-grid',
                    'dataProvider' => $dataProvider,
                    'layout'       => '{items}<div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">{summary}</div></div>',
                    'filterModel'  => $searchModel,
                    'pager'        => [
                        'options'          => ['class' => 'pagination pagination-sm'],
                        'hideOnSinglePage' => true,
                        'lastPageLabel'    => '>>',
                        'firstPageLabel'   => '<<',
                    ],
                    'columns'      => [
                        [
                            'class'   => SerialColumn::class,
                            'options' => ['style' => 'width:10px'],
                        ],
                        [
                            'attribute' => 'id',
                            'value'     => static function (BransonSchedule $model) {
                                return Html::a($model->id, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                            },
                            'format'    => 'raw',
                        ],
                        'title',
                        [
                            'attribute' => 'type',
                            'filter'    => BransonSchedule::getTypesList()
                        ],
                        'external_id',
                        'order',
                        [
                            'class'          => ActionColumn::class,
                            'contentOptions' => ['style' => 'width:70px; text-align:center;'],
                        ],
                    ],
                ]
            ) ?>

            <?php Pjax::end() ?>
        </div>
    </div>
</div>
