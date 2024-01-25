<?php

use common\models\MetaData;

/**
 * @var MetaData $model
 */

$this->title = 'Creation Meta Data';
$this->params['breadcrumbs'][] = ['label' => 'Meta Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="text-page-create">
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('_form', compact('model')) ?>
        </div>
    </div>
</div>
