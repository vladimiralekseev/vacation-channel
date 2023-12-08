<?php

use common\models\Category;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View             $this
 * @var yii\bootstrap\ActiveForm $form
 * @var Category                 $model
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

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'order')->textInput() ?>
    <?php /*= $this->render(
        '../components/upload-file',
        [
            'model'        => $model,
            'uploadForm'   => $adUploadForm,
            'form'         => $form,
            'label'        => 'Image',
            'field'        => 'img',
            'canBeDeleted' => false,
        ]
    ) */ ?>
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
