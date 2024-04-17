<?php

/**
 * @var yii\web\View $this
 */

$this->title = 'Schedule creation';
$this->params['breadcrumbs'][] = ['label' => 'Schedule', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="text-page-create">
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('_form', compact('model')) ?>
        </div>
    </div>
</div>
