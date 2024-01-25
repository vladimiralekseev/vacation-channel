<?php

use backend\models\forms\MetaDataForm;

/**
 * @var MetaDataForm $model
 */

$this->title = 'Editing Meta Data: ' . MetaDataForm::getTypeValue($model->type);
$this->params['breadcrumbs'][] = ['label' => 'Meta Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => MetaDataForm::getTypeValue($model->type),
    'url'   => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = 'Editing';
?>
<div class="attractions-update">
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('_form', compact('model')) ?>
        </div>
    </div>
</div>