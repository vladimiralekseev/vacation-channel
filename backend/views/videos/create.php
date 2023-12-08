<?php

use common\models\Video;

/**
 * @var yii\web\View $this
 * @var Video        $model
 */

$this->title = 'Video creation';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="text-page-create">
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('_form', compact('model')) ?>
        </div>
    </div>
</div>
