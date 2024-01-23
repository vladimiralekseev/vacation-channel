<?php

use common\models\Category;
use common\models\Video;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * @var yii\web\View             $this
 * @var yii\bootstrap\ActiveForm $form
 * @var Video                    $model
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
    <?= $form->field($model, 'status')->dropDownList(Video::getStatusList()) ?>
    <?= $form->field($model, 'order')->textInput() ?>
    <?= $form->field($model, 'youtube_code')->textInput() ?>
    <?= $form->field($model, 'link')->textInput() ?>
    <?= $form->field($model, 'link_name')->textInput() ?>
    <?= $form->field($model, 'category_id')
        ->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'name'), ['prompt' => '--Select Item--'])
        ->label('Category') ?>
    <?= $form->field($model, 'main')->checkbox()->label('Display as the main video') ?>
    <?= $form->field($model, 'main_slider')->checkbox()->label('Display in the main slider on the main page') ?>
    <?= $form->field($model, 'main_page')->checkbox()->label('Display on the main page') ?>
    <?= $form->field($model, 'description')->widget(CKEditor::class,[
        'editorOptions' => [
            'preset' => 'basic',
            'inline' => false,
        ],
    ]); ?>
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
