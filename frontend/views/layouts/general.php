<?php

use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

AppAsset::register($this);

$this->title = str_replace('&nbsp;', ' ', $this->title);
$this->beginPage() ?><!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" itemscope itemtype="http://schema.org/WebPage">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="<?= $this->title ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?= Yii::$app->request->absoluteUrl ?>"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapper-main">
    <?= $this->render('header') ?>
    <main>
        <?= $content ?>
    </main>
    <?= $this->render('footer') ?>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
