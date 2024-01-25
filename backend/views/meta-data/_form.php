<?php

use backend\models\forms\MetaDataForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * @var MetaDataForm $model
 */

$metaData = Json::decode($model->data);
$errors = implode('<br>', $model->getErrorSummary(true));
?>
<div class="attractions-form">
    <?php $form = ActiveForm::begin(
        [
            'options'        => ['enctype' => 'multipart/form-data'],
            'id'             => 'attractions',
            'layout'         => 'horizontal',
            'validateOnBlur' => false,
        ]
    ); ?>
    <?= $form->field($model, 'url')->textInput()->label('Url or Youtube code')
        ->hint(
            'You can use or the url page or the youtube short code to define for with page this metadata will be displayed. ' .
            'Page url example: /show/rick-mcewan-the-gambler/'
        ) ?>
    <?= $form->field($model, 'type')->dropDownList(
        MetaDataForm::getTypeList(),
        ['prompt' => '']
    )->hint('< meta ....>, < link ....>, < title ....>')->label('Tag type') ?>
    <div class="js-title <?= $model->type !== MetaDataForm::TYPE_TITLE || empty($model->type) ? 'hide' : '' ?>">
        <?= $form->field($model, 'title')->textInput() ?>
    </div>

    <div class="js-data <?= $model->type === MetaDataForm::TYPE_TITLE || empty($model->type) ? 'hide' : '' ?>">
        <div class="form-group">
            <label class="control-label col-sm-3">Tag attributes</label>
            <div class="col-sm-6">
                <div class="form-group">
                    <?php if ($metaData) { ?>
                        <?php foreach ($metaData as $key => $value) { ?>
                            <div><?= $form->field($model, 'key[]')->textInput(['value' => $key]) ?></div>
                            <div><?= $form->field($model, 'value[]')->textInput(['value' => $value]) ?></div>
                            <br/>
                        <?php } ?>
                    <?php } ?>
                    <?php for ($i = 0; $i < 3; $i++) { ?>
                        <div><?= $form->field($model, 'key[]')->textInput() ?></div>
                        <div><?= $form->field($model, 'value[]')->textInput() ?></div>
                        <br/>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?php if ($errors) { ?>
                <div class="alert alert-danger">
                    <?= $errors ?>
                </div>
            <?php } ?>
            <?= Html::submitButton(
                '<span class="glyphicon glyphicon-ok"></span> Save',
                ['class' => 'btn btn-primary']
            ) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$this->registerJs("
$('[name=\"MetaDataForm[type]\"]').change(function(){
    if ($(this).val() === 'title') {
        $('.js-title').removeClass('hide')
        $('.js-data').addClass('hide')
    } else {
        $('.js-title').addClass('hide')
        $('.js-data').removeClass('hide')
    }
});
");
?>
