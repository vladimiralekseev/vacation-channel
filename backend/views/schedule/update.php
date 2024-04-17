<?php

use common\models\BransonSchedule;

/**
 * @var yii\web\View    $this
 * @var BransonSchedule $model
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Schedule', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editing';
?>

<div class="text-page-update">

    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('_form', compact('model')) ?>
        </div>
    </div>

</div>
