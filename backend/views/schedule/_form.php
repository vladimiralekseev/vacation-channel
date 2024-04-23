<?php

use common\models\BransonSchedule;
use common\models\Category;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * @var yii\web\View             $this
 * @var yii\bootstrap\ActiveForm $form
 * @var BransonSchedule          $model
 */
?>

<div class="text-page-form">

    <?php $form = ActiveForm::begin(
        [
            'options'        => ['enctype' => 'multipart/form-data'],
            'id'             => 'text-page',
            'layout'         => 'horizontal',
            'validateOnBlur' => false,
        ]
    ); ?>

    <?= $form->field($model, 'title')->textInput()->hint("Copy item's name") ?>
    <?= $form->field($model, 'type')->dropDownList(
            BransonSchedule::getTypesList(), ['prompt' => '--Select Item--']
    ) ?>
    <?= $form->field($model, 'external_id')->textInput()
        ->hint('Copy an external id from <a href="https://admin.ibranson.com/shows/index" target="_blank">Shows</a> or <a href="https://admin.ibranson.com/attractions/index" target="_blank">Attractions</a>') ?>
    <?= $form->field($model, 'order')->textInput()->hint("Default value: 500. If this value will less than 500 this item will first in the list
    ") ?>
    <?= $form->field($model, 'url')->textInput() ?>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php if ($model->isNewRecord): ?>
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-plus-sign"></span> Create',
                    ['class' => 'btn btn-success']
                ) ?>
            <?php else: ?>
                <?= Html::submitButton(
                    '<span class="glyphicon glyphicon-ok"></span> Save',
                    ['class' => 'btn btn-primary']
                ) ?>
            <?php endif; ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
