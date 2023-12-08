<?php

use common\models\Category;

/**
 * @var yii\web\View $this
 * @var Category     $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editing';
?>

<div class="text-page-update">

    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('_form', compact('model')) ?>
        </div>
    </div>

</div>
