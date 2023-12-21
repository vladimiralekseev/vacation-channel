<?php

use backend\models\search\VideoSearch;
use common\models\Video;
use webvimark\components\StatusColumn;
use webvimark\extensions\GridPageSize\GridPageSize;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View               $this
 * @var ActiveDataProvider $dataProvider
 * @var VideoSearch        $searchModel
 */

$this->title = 'Videos';
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
                            'value'     => static function (Video $model) {
                                return Html::a($model->id, ['view', 'id' => $model->id], ['data-pjax' => 0]);
                            },
                            'format'    => 'raw',
                        ],
                        'name',
                        'code',
                        'youtube_code',
                        [
                            'label'     => 'Main Video',
                            'attribute' => 'main',
                            'value'     => static function (Video $model) {
                                return $model->main ? 'Yes' : 'No';
                            },
                            'filter'    => [0 => 'No', 1 => 'Yes'],
                        ],
                        [
                            'label'     => 'Main Slider',
                            'attribute' => 'main_slider',
                            'value'     => static function (Video $model) {
                                return $model->main_slider ? 'Yes' : 'No';
                            },
                            'filter'    => [0 => 'No', 1 => 'Yes'],
                        ],
                        [
                            'label'     => 'Main Page',
                            'attribute' => 'main_page',
                            'value'     => static function (Video $model) {
                                return $model->main_page ? 'Yes' : 'No';
                            },
                            'filter'    => [0 => 'No', 1 => 'Yes'],
                        ],
                        [
                            'class'        => StatusColumn::class,
                            'attribute'    => 'status',
                            'optionsArray' => [
                                [0, Video::getStatusValue(0), 'warning'],
                                [1, Video::getStatusValue(1), 'success'],
                            ],
                        ],
                        'order',
                        [
                            'label' => 'Category',
                            'attribute' => 'category_id',
                            'value'     => static function (Video $model) {
                                return $model->category->name ?? null;
                            },
                        ],
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
